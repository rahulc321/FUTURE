<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Validator;

class StripeConnectController extends ApiController
{

	public function ConnectStripeAccount(Request $request){
		try{
			\Stripe\Stripe::setApiKey(config('stripe.stripe_key'));
			$account = \Stripe\Customer::create(
			  	[
			  		"email" => $request->email
			  	],
			  	[
			  		"stripe_account" => $request->account_connect_id
			  	]
			);

			return $this->respond([
                'status' => 'success',
                'status_code' => $this->getStatusCode(),
                'message' => 'Account connected successfully.',
                'data' => $account
            ]);
		} catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
		
	}

	public function LinkStripeAccount(Request $request){
		try{
			\Stripe\Stripe::setApiKey(config('stripe.stripe_key'));

			$account_links = \Stripe\AccountLink::create([
			  	'account' => $request->account_id,
			  	'refresh_url' => 'https://example.com/reauth',
			  	'return_url' => 'https://example.com/return',
			  	'type' => 'account_onboarding',
			]);

			return $this->respond([
                'status' => 'success',
                'status_code' => $this->getStatusCode(),
                'message' => 'Account connected successfully.',
                'data' => $account
            ]);
		} catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
	}

}