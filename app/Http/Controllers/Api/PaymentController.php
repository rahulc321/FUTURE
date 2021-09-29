<?php 

namespace App\Http\Controllers\Api;

use App\User;
use App\Models\Plans;
use App\Models\SellerPlans;
use App\Models\CustomPlans;
use App\Models\CommercialAds;
use App\Models\BuyerProducts;
use App\Models\PurchasedProduct;
use Auth;
use Illuminate\Http\Request;
use App\Models\Talents;
use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;
use App\Traits\MailsendTrait;
use Validator;


class PaymentController extends ApiController
{
	private $conn = [
	    'environment' => 'sandbox',
	    'merchantId' => 'sg59229q38wtqcnn',
	    'publicKey' => 'bz6k8m56ntww44js',
	    'privateKey' => 'e882bf9a4c4b992df1c6c9b52c6898ab'
	];


	public function paypal(Request $request){
		try {
			$gateway = new \Braintree\Gateway($this->conn);
			$clientToken = $gateway->clientToken()->generate();

			return $this->respond([
                'status' => 'success',
                'status_code' => $this->getStatusCode(),
                'message' => 'Paypal Client Token',
                'token' =>  $clientToken,
            ]);            

        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
	}


	public function storePaypal(Request $request){
		try {

			$gateway = new \Braintree\Gateway($this->conn);

			$result = $gateway->transaction()->sale([
			  	'amount' => $request->amount,
			  	'paymentMethodNonce' => $request->nonce,
			  	'deviceData' => $request->device_data,
			  	'options' => [
			    	'submitForSettlement' => True
			  	]
			]);

			return $this->respond([
                'status' => 'success',
                'status_code' => $this->getStatusCode(),
                'message' => 'Paypal Response',
                'data' =>  $result,
            ]);            

        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        } 
	}


	public function paypalTest(Request $request){
		// return $request->all();

	}


	public function stripe(Request $request){
		try {
			\Stripe\Stripe::setApiKey(config('stripe.stripe_key'));

			$stripe_customer_id = Auth::user()->stripe_customer_id;
			if(!$stripe_customer_id) {
				$customer = \Stripe\Customer::create([
					'email' => Auth::user()->email,
				]);
				$stripe_customer_id = $customer->id;
			}

			$setup_intent = \Stripe\SetupIntent::create([
			  'customer' => $stripe_customer_id
			]);

			// $paymentMethod = \Stripe\PaymentMethod::all([
			//   'customer' => $stripe_customer_id,
			//   'type' => 'card',
			// ]);
			// $data['paymentMethod'] = $paymentMethod;

			$data['client_secret'] = $setup_intent->client_secret; 

			return $this->respond([
                'status' => 'success',
                'status_code' => $this->getStatusCode(),
                'message' => 'Stripe Secret Key Response',
                'data' =>  $data,
            ]);  
                    

        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        } 
	}

	public function stripeCallbackStatus(Request $request){
		$stripe = new \Stripe\StripeClient(config('stripe.stripe_key'));

		// $resp = json_encode($request->all());
 	// 	$myfile = file_put_contents('stripe-callback.txt', $resp.PHP_EOL , FILE_APPEND | LOCK_EX);
 		$user = User::where('stripe_customer_id', $request->data['object']['customer'])->first();
 		if ($request->type == 'charge.succeeded' && 
 			$request->data['object']['status'] == "succeeded") {

			$cartData = [];
			$condition = [
				'purchased_products.user_id' => $user->id, 
				'purchased_products.delete_flag' => 0,
				'purchased_products.purchased'	=>	null,
			];
			$purchasedProducts = PurchasedProduct::with('getTalent', 'getCommercial', 'getSampleMedia', 'getSellerDetail')->where($condition)->get();


			if ($purchasedProducts->isNotEmpty()) {
				$cartData = [];
				foreach ($purchasedProducts as $key => $value) {
					$cartData[$value->getTalent['user_id']][] = $value;
					$group = 'cart_'.$value->cart_id;
				}
			}else{
				return $this->respond([
	                'status' => 'info',
	                'status_code' => $this->getStatusCode(),
	                'message' => 'No Product In Cart',
	            ]);
			}

			$totalAmount = $purchasedProducts->sum('total_amount');
			$totalItems = $purchasedProducts->sum('quantity');
			
			$amount = $totalAmount;
			$amount *= 100;
			$amount = (int) $amount;
			$application_fee = (int) $amount * 0.7;

			// $transfer = $stripe->transfers->create([
			//   	'amount' => $application_fee,
			//   	'currency' => 'usd',
			//   	'destination' => 'acct_1EeMQHDDEqW93OvQ',
			//   	'transfer_group' => $group,
			//   	"source_transaction" => $request->data['object']['id'],
			// ]);
			
			$pps = PurchasedProduct::where($condition)->get();
			foreach ($pps as $key => $pp) {
				$bp 	=	new BuyerProducts;
				$bp->user_id	=	Talents::find($pp->talent_id)
									->first()->user_id;
				$bp->buyer_id	=	$user->id;
				$bp->talent_id	=	$pp->talent_id;
				$bp->active 	=	1;
				$bp->date 		=	date('Y-m-d');
				$bp->created_by	=	$user->id;
				$bp->updated_by	=	$user->id;
				$bp->pp_id		=	$pp->id;
				$bp->save();
			}
			PurchasedProduct::where($condition)->update([
				'purchased'	=>	1,
			]);

 		}
	}
	
	public function storeStripe(Request $request){

		try{
			$stripe = new \Stripe\StripeClient(config('stripe.stripe_key'));

			$userId = !empty(Auth::user()->id) ? Auth::user()->id : '';
			$cartData = [];
			$condition = [
				'purchased_products.user_id' => $userId, 
				'purchased_products.delete_flag' => 0,
				'purchased_products.purchased'	=>	null,
			];
			$purchasedProducts = PurchasedProduct::with('getTalent', 'getCommercial', 'getSampleMedia', 'getSellerDetail')->where($condition)->get();


			if ($purchasedProducts->isNotEmpty()) {
				$cartData = [];
				foreach ($purchasedProducts as $key => $value) {
					$cartData[$value->getTalent['user_id']][] = $value;
					$group = 'cart_'.$value->cart_id;
				}
			}else{
				return $this->respond([
	                'status' => 'info',
	                'status_code' => $this->getStatusCode(),
	                'message' => 'No Product In Cart',
	            ]);
			}

			$totalAmount = $purchasedProducts->sum('total_amount');
			$totalItems = $purchasedProducts->sum('quantity');
			
			$amount = $totalAmount;
			$amount *= 100;
			$amount = (int) $amount;
			$application_fee = (int) $amount * 0.7;

			$stripe_customer_id = Auth::user()->stripe_customer_id;
			if(!$stripe_customer_id) {
				$customer = $stripe->customers->create([
					'email' => Auth::user()->email,
				]);
				$stripe_customer_id = $customer->id;
			}

			try {
			  	$PaymentIntent = $stripe->paymentIntents->create([
			  		// 'client_secret' => $request->client_secret,
				    'amount' => $amount,
				    'currency' => 'usd',
				    'customer' => $stripe_customer_id,
				    'payment_method' => $request->method_id,
				    // 'off_session' => false,
				    'confirm' => true,
			  	]);
				$data['pay'] = $PaymentIntent;
			  	if ($PaymentIntent->status == "succeeded") {
			  		$transfer = $stripe->transfers->create([
					  	'amount' => $application_fee,
					  	'currency' => 'usd',
					  	'destination' => 'acct_1EeMQHDDEqW93OvQ',
					  	'transfer_group' => $group,
					  	"source_transaction" => $PaymentIntent->charges->data[0]->id,
					]);
					$pps = PurchasedProduct::where($condition)->get();
					foreach ($pps as $key => $pp) {
						$bp 	=	new BuyerProducts;
						$bp->user_id	=	Talents::find($pp->talent_id)
											->first()->user_id;
						$bp->buyer_id	=	Auth::id();
						$bp->talent_id	=	$pp->talent_id;
						$bp->active 	=	1;
						$bp->date 		=	date('Y-m-d');
						$bp->created_by	=	Auth::id();
						$bp->updated_by	=	Auth::id();
						$bp->pp_id		=	$pp->id;
						$bp->save();
					}
					PurchasedProduct::where($condition)->update([
						'purchased'	=>	1,
					]);
			  	}			  
			} catch (\Stripe\Exception\CardException $e) {
			  // Error code will be authentication_required if authentication is needed
				echo 'Error code is:' . $e->getError()->code;
				$payment_intent_id = $e->getError()->payment_intent->id;
				$payment_intent = \Stripe\PaymentIntent::retrieve($payment_intent_id);
			}

			return $this->respond([
                'status' => 'success',
                'status_code' => $this->getStatusCode(),
                'message' => 'Product Purchased Successfully',
                'data' =>  $data,
            ]);  
        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
	}

	public function confirmStripePayment(Request $request){
	  	try{
	  		$stripe = new \Stripe\StripeClient(config('stripe.stripe_key'));

	  		$userId = !empty(Auth::user()->id) ? Auth::user()->id : '';
			$cartData = [];
			$condition = [
				'purchased_products.user_id' => $userId, 
				'purchased_products.delete_flag' => 0,
				'purchased_products.purchased'	=>	null,
			];
			$purchasedProducts = PurchasedProduct::with('getTalent', 'getCommercial', 'getSampleMedia', 'getSellerDetail')->where($condition)->get();

			if ($purchasedProducts->isNotEmpty()) {
				$cartData = [];
				foreach ($purchasedProducts as $key => $value) {
					$cartData[$value->getTalent['user_id']][] = $value;
					$group = 'cart_'.$value->cart_id;
				}
			}else{
				return $this->respond([
	                'status' => 'info',
	                'status_code' => $this->getStatusCode(),
	                'message' => 'No Product In Cart',
	            ]);
			}

			$totalAmount = $purchasedProducts->sum('total_amount');
			$totalItems = $purchasedProducts->sum('quantity');
			
			$amount = $totalAmount;
			$amount *= 100;
			$amount = (int) $amount;
			$application_fee = (int) $amount * 0.7;

			$stripe_customer_id = Auth::user()->stripe_customer_id;
			if(!$stripe_customer_id) {
				$customer = $stripe->customers->create([
					'email' => Auth::user()->email,
				]);
				$stripe_customer_id = $customer->id;
			}

		  	if ($request->status == "succeeded") {
			 //  	$transfer = $stripe->transfers->create([
				//   	'amount' => $application_fee,
				//   	'currency' => 'usd',
				//   	'destination' => 'acct_1EeMQHDDEqW93OvQ',
				//   	'transfer_group' => $group,
				//   	"source_transaction" => $request->charge_id,
				// ]);
				// $data['trans'] = $transfer;

				$pps = PurchasedProduct::where($condition)->get();
				foreach ($pps as $key => $pp) {
					$bp 	=	new BuyerProducts;
					$bp->user_id	=	Talents::find($pp->talent_id)
										->first()->user_id;
					$bp->buyer_id	=	Auth::id();
					$bp->talent_id	=	$pp->talent_id;
					$bp->active 	=	1;
					$bp->date 		=	date('Y-m-d');
					$bp->created_by	=	Auth::id();
					$bp->updated_by	=	Auth::id();
					$bp->pp_id		=	$pp->id;
					$bp->save();
				}
				PurchasedProduct::where($condition)->update([
					'purchased'	=>	1,
				]);
		  	}
		  	return $this->respond([
                'status' => 'success',
                'status_code' => $this->getStatusCode(),
                'message' => 'Product Purchased Confirm Successfully',
                // 'data' =>  $data,
            ]);  
	  	} catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
	}
	public function hotPayStripe(Request $request){

		try{
			$stripe = new \Stripe\StripeClient(config('stripe.stripe_key'));
			// return $stripe;

			$userId = !empty(Auth::user()->id) ? Auth::user()->id : '';
			$cartData = [];
			$condition = [
				'purchased_products.user_id' => $userId, 
				'purchased_products.delete_flag' => 0,
				'purchased_products.purchased'	=>	null,
			];
			$purchasedProducts = PurchasedProduct::with('getTalent', 'getCommercial', 'getSampleMedia', 'getSellerDetail')->where($condition)->get();
			if ($purchasedProducts->isNotEmpty()) {
				$cartData = [];
				foreach ($purchasedProducts as $key => $value) {
					$cartData[$value->getTalent['user_id']][] = $value;
					$group = 'cart_'.$value->cart_id;
				}
			}else{
				return $this->respond([
	                'status' => 'info',
	                'status_code' => $this->getStatusCode(),
	                'message' => 'No Product In Cart',
	            ]);
			}

			$totalAmount = $purchasedProducts->sum('total_amount');
			$totalItems = $purchasedProducts->sum('quantity');
			
			$amount = $totalAmount;
			$amount *= 100;
			$amount = (int) $amount;
			$application_fee = (int) $amount * 0.7;

			$stripe_customer_id = Auth::user()->stripe_customer_id;
			if(!$stripe_customer_id) {
				$customer = $stripe->customers->create([
					'email' => Auth::user()->email,
				]);
				$stripe_customer_id = $customer->id;
			}

			try {
			  	$PaymentIntent = $stripe->paymentIntents->create([
			  		// 'client_secret' => $request->client_secret,
				    'amount' => $amount,
				    'currency' => 'usd',
				    'customer' => $stripe_customer_id,
				    'payment_method' => $request->method_id,
				    // 'off_session' => false,
				    'confirm' => true,
			  	]);
			  	if ($PaymentIntent->status == "succeeded") {
			  		$transfer = $stripe->transfers->create([
					  	'amount' => $application_fee,
					  	'currency' => 'usd',
					  	'destination' => 'acct_1EeMQHDDEqW93OvQ',
					  	'transfer_group' => $group,
					  	"source_transaction" => $PaymentIntent->charges->data[0]->id,
					]);
					$pps = PurchasedProduct::where($condition)->get();
					foreach ($pps as $key => $pp) {
						$bp 	=	new BuyerProducts;
						$bp->user_id	=	Talents::find($pp->talent_id)
											->first()->user_id;
						$bp->buyer_id	=	Auth::id();
						$bp->talent_id	=	$pp->talent_id;
						$bp->active 	=	1;
						$bp->date 		=	date('Y-m-d');
						$bp->created_by	=	Auth::id();
						$bp->updated_by	=	Auth::id();
						$bp->pp_id		=	$pp->id;
						$bp->save();
					}
					PurchasedProduct::where($condition)->update([
						'purchased'	=>	1,
					]);
			  	}else{
				  	$card = $stripe->paymentMethods->retrieve(
		              	$request->method_id,
		              	[]
		            );
				  	// return $card;
				  	$confirm = $stripe->paymentIntents->confirm(
						$PaymentIntent->id,
						[
							'payment_method' => 'pm_card_'.$card->card->brand
						]
					);			

				  	// $data['pay'] = $PaymentIntent;
				  	// $data['confirm'] = $confirm;
				  	if ($confirm->status == "succeeded") {
					  	$transfer = $stripe->transfers->create([
						  	'amount' => $application_fee,
						  	'currency' => 'usd',
						  	'destination' => 'acct_1EeMQHDDEqW93OvQ',
						  	'transfer_group' => $group,
						  	"source_transaction" => $confirm->charges->data[0]->id,
						]);
						$data['trans'] = $transfer;

						$pps = PurchasedProduct::where($condition)->get();
						foreach ($pps as $key => $pp) {
							$bp 	=	new BuyerProducts;
							$bp->user_id	=	Talents::find($pp->talent_id)
												->first()->user_id;
							$bp->buyer_id	=	Auth::id();
							$bp->talent_id	=	$pp->talent_id;
							$bp->active 	=	1;
							$bp->date 		=	date('Y-m-d');
							$bp->created_by	=	Auth::id();
							$bp->updated_by	=	Auth::id();
							$bp->pp_id		=	$pp->id;
							$bp->save();
						}
						PurchasedProduct::where($condition)->update([
							'purchased'	=>	1,
						]);
				  	}
			  	}
			} catch (\Stripe\Exception\CardException $e) {
			  // Error code will be authentication_required if authentication is needed
				echo 'Error code is:' . $e->getError()->code;
				$payment_intent_id = $e->getError()->payment_intent->id;
				$payment_intent = \Stripe\PaymentIntent::retrieve($payment_intent_id);
			}

			return $this->respond([
                'status' => 'success',
                'status_code' => $this->getStatusCode(),
                'message' => 'Product Purchased Successfully',
                'data' =>  $data,
            ]);  
        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
	}
}