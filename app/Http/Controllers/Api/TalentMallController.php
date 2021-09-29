<?php 

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\TalentCatagory;
use App\Models\Talents;
use App\Models\TalentAwards;
use App\Models\TalentRiders;
use App\Models\BuyerProducts;
use App\Models\BuyerContacts;
use App\Models\TalentComments;
use App\Models\PurchasedProduct;
use App\Models\TalentView;
use App\Models\UserCarts;
use App\Models\ChatMessage;
use App\User;
use App\Models\Metatags;
use Auth;
use Response;
use Session;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\Models\Fanbase;
use DB;
use App\Traits\MailsendTrait;
use Illuminate\Support\Facades\Crypt;
use Symfony\Component\DomCrawler\Crawler;

class TalentMallController extends ApiController
{
	use MailsendTrait;

	public function index(Request $request){
		 try {
		 	$per_page = $request->per_page ? $request->per_page : 10 ;
		 	$data['categories'] = TalentCatagory::select('id', 'name', 'slug', 'catagory_image_path', 'catagory_main_banner', 'catagory_banner', 'catagory_detailed_banner', 'catagory_detailed_icon_img', 'tarending_catagory_sidebar_icon', 'category_read')->paginate($per_page);


            foreach ($data['categories'] as $key => $category) {
                # code...
                $category->category_read = strip_tags($category->category_read);
            }
            // $category = TalentCatagory::first();
            // // return $data['catagories'];
            // return $category;
            // // foreach ($data['catagories'] as $key => $category) {
            //     print_r($category->catagory_desc);
            //     $crawler = new Crawler($category->catagory_desc);
            //     $head = $crawler->filter('h1');
            //     // $p = $crawler->filter('p:nth-child(4)');
            //     // $p = $crawler->filter('p');

            //     print_r($head->text());
            //     echo '<br />';
            //     // // print_r($p->text());
            //     // 
            // // }
            //     $p = $crawler->filter('p')
            //     ->each(function (Crawler $node, $i) {
            //         return $node;
            //     });

            //     foreach ($p as $key => $value) {
            //         if ($value->text() == '') {
            //             echo '||||'.$key.'||||';
            //             $spn = $crawler->filter('p:nth-child(2) span');
            //             print_r($spn);
            //         }
            //         echo '||||';
            //         print_r($value->text());
            //     }
            return $this->respond([
                'status' => 'success',
                'status_code' => $this->getStatusCode(),
                'message' => 'Tallent Mall Categories',
                'file_url' => env('APP_FILE_URL'),
                'data' =>  $data,
            ]);
        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
	}


	public function show(Request $request){
		try {
		 // if(!empty($request->all()) && $request->has('page') == '') {            
            $talentList = '';
            $talentListArr = [];
            $per_page = $request->per_page ? $request->per_page : 10;
            $price = $request['price']?$request['price']:0;
            $categories = $request['cat']?explode(',', $request['cat']):0;
            $star = $request['star']?explode(',', $request['star']):0;
            $min_price = 0;
            $max_price = $price;
            $condition = ['approved' => 1 , 'active' =>'Active'];
            // return $star;
            if(empty($price) && empty($star)) {
                
                //DB::enableQueryLog();
                $talents = Talents::withCount('talentComments', 'getTalentAwards')->with('user','commercialMedia','sampleMedia')->where($condition);
                if ($categories != 0) {
                	$talents->WhereIn('talent_category_id',$categories);
                }
                $talents = $talents->orderBy('id', 'DESC')->paginate($per_page);

                $totalCount = Talents::where($condition);
                if ($categories != 0) {
	                $totalCount->WhereIn('talent_category_id',$categories);
	            }
                $totalCount = $totalCount->get();
        
             } else if(!empty($price) && empty($star)) {
                
                //DB::enableQueryLog();
                $talents = Talents::withCount('talentComments', 'getTalentAwards')->with('user','commercialMedia','sampleMedia')->where($condition);
                if ($categories != 0) {
                	$talents->WhereIn('talent_category_id',$categories);
                }
                $talents = $talents->whereBetween('price', [$min_price, $max_price])->orderBy('id', 'DESC')->paginate($per_page);

                $totalCount = Talents::where($condition);
                if ($categories != 0) {
	                $totalCount->WhereIn('talent_category_id',$categories);
	            }
                $totalCount = $totalCount->whereBetween('price', [$min_price, $max_price])->get();


             } else if(empty($price) && !empty($star)) {
                 
                 //DB::enableQueryLog();
                 $talents = Talents::withCount('talentComments', 'getTalentAwards');
                 if ($star != 0) {
                	// $talents->having('get_talent_awards_count', $star);
                	$talents->WhereIn('award',$star);
                	// $talents->having('get_talent_awards_count')->whereIn('get_talent_awards_count', $star);
            	 }
                 $talents->with('user','commercialMedia','sampleMedia')->where($condition);
                 if ($categories != 0) {
	                 $talents->WhereIn('talent_category_id',$categories);
	             }
	             // if ($star != 0) {
	             // 	$talents->WhereIn('avg_rating', $star);
	             // }                 
                 $talents = $talents->orderBy('id', 'DESC')->paginate($per_page);
                //$query = DB::getQueryLog();
                //dd($query);
                $totalCount = Talents::where($condition);
                if ($categories != 0) {
	                $totalCount->WhereIn('talent_category_id',$categories);
	            }
               $totalCount = $totalCount ->WhereIn('award', $star)->get();

             } else {
                
                $talents = Talents::withCount('talentComments', 'getTalentAwards');
                if ($star != 0) {
                	// $talents->having('get_talent_awards_count', $star);
                	$talents->WhereIn('award',$star);
                }
                $talents->with('user','commercialMedia','sampleMedia')->where($condition);
                if ($categories != 0) {
	                 $talents->WhereIn('talent_category_id',$categories);
	            }
	            
	            // $talents->WhereIn('avg_rating', $star);
	             
                $talents = $talents->whereBetween('price', [$min_price, $max_price])->orderBy('id', 'DESC')->paginate($per_page);
               
               $totalCount = Talents::where($condition);
               if ($categories != 0) {
	                 $totalCount->WhereIn('talent_category_id',$categories);
	           }
	           if ($star != 0) {
	             	$totalCount->WhereIn('award', $star);
	           } 
               $totalCount = $totalCount->whereBetween('price', [$min_price, $max_price])->get();
                
             }
           
            $data['talents'] = $talents;
            // $data['totalCount'] = $totalCount;
            // $data['catagories'] = TalentCatagory::all();

	        return $this->respond([
	            'status' => 'success',
	            'status_code' => $this->getStatusCode(),
	            'message' => 'Tallent Mall Search By Category',
	            'file_url' => env('APP_FILE_URL'),
	            'data' =>  $data,
	        ]);

        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
          
	}


	public function productInfo(Request $request, $id){
        try {

            $checkItemInCart = 0;
            $isPurchase = false;
            $talent  = Talents::where('slug', $id)->first();           
            if(empty($talent)) {
                return redirect('/talent-mall', 301); 
            }

            /******** update product view's ********/
            
		  	$ip = (isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['HTTP_CLIENT_IP'] : isset($_SERVER['HTTP_X_FORWARDED_FOR']) ) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];

            $whereCondition = ['ip_address' => $ip, 'talent_id' => $talent['id'] ];
            $talentView = TalentView::where($whereCondition)->first();
            
            if(empty($talentView)) {
                  $talentViewArray = ['talent_id' => $talent['id'] , 'ip_address' => $ip ];
                  $talentUpdated = TalentView::insert($talentViewArray);

                  $viewCount = $talent['view'];
                  $updatedCount = $viewCount + 1; 
                  $talentArray = ['view' => $updatedCount];
                  $updated = Talents::where('id', $talent['id'])->update($talentArray);
            }

            //$id = Crypt::decryptString($id);
            $condition = ['slug' => $id ,'approved' => 1 ,'active' =>'Active'];

            $talent = Talents::withCount(['talentComments', 'getTalentAwards', 'getTalentRiders', 'getDownloads', 'isAwarded'])->with('commercialMedia','sampleMedia', 'productMedia', 'getUserData','alreadyAwarded','selfRider')->where($condition)->first();

            if(!empty($talent)) {
                $talentInformation = $talent;
            } else {
                return redirect('/talent-mall', 301);
            }

            $similarTalentCondition = ['talent_category_id' => $talentInformation['talent_category_id'], 'approved' => '1', 'active' =>'Active' ];
            $similarTalent = Talents::withCount('talentComments', 'getTalentAwards')->with('commercialMedia','sampleMedia')->where($similarTalentCondition)->where('slug','!=',$id)->whereHas('commercialMedia', function ($query) {
                $query->where('commercial_media.talent_id', '!=', '');})->inRandomOrder()->limit(6)->get();
           // dd($similarTalent);
            if(!empty(Auth::check())) {               
               $cartCondition = ['talent_id'=> $talentInformation['id'], 'user_id'=> Auth::user()->id, 'delete_flag'=> 0, 'purchased' => null];
               $checkItemInCart = PurchasedProduct::where($cartCondition)->count();
               $buyerProducts = BuyerProducts::where('buyer_id',Auth::user()->id)->where('talent_id',$talent->id)->first();
               // return $buyerProducts;
               if ($buyerProducts != null) {
                   $isPurchase = true;
               }
               else{
                    $isPurchase = false;
               }
            }
            
            // $metaTags = [];
            // $metaTags = [
            //     'title'       => $talentInformation['title'], 
            //     'description' => $talentInformation['product_info'], 
            //     'keywords'    => $talentInformation['title'], 
            //     'og_image'    => asset($talentInformation['commercialMedia'][0]->image_path)
            // ];

            // return view('frontend.talentmall.product-info', compact('talentInformation','similarTalent','checkItemInCart', 'metaTags'));
            $data['talentInformation'] = $talentInformation;
            // $data['similarTalent']	=	$similarTalent;
            $data['checkItemInCart'] = $checkItemInCart;
            $data['isPurchase'] = $isPurchase;

        	return $this->respond([
	            'status' => 'success',
	            'status_code' => $this->getStatusCode(),
	            'message' => 'Tallent Mall Product Info',
	            'file_url' => env('APP_FILE_URL'),
	            'data' =>  $data,
	        ]);

        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
        
    }


    public function similarProduct(Request $request, $id){

    	try{

    		
    		$per_page = $request->per_page ? $request->per_page : 10;

    		$talent  = Talents::where('slug', $id)->first();
    		$category_id = $talent['talent_category_id'];
    		$similarTalentCondition = ['talent_category_id' => $category_id, 'approved' => '1', 'active' =>'Active' ];
            $similarTalent = Talents::withCount('talentComments', 'getTalentAwards')->with('commercialMedia','sampleMedia')->where($similarTalentCondition)->where('slug','!=',$id)->whereHas('commercialMedia', function ($query) {
                $query->where('commercial_media.talent_id', '!=', '');})->inRandomOrder()->paginate($per_page);

            $data['similarTalent']	=	$similarTalent;
        	return $this->respond([
	            'status' => 'success',
	            'status_code' => $this->getStatusCode(),
	            'message' => 'Tallent Mall Similar Product',
	            'file_url' => env('APP_FILE_URL'),
	            'data' =>  $data,
	        ]);

        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }


    public function giveTalentAward(Request $request) {
          try{
            $rules = array(
                'talent_id' => 'required',
            );

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return $this->respondValidationError('Fields Validation Failed.', $validator);
            }

            $awardArray = [
                       'talent_id' => $request['talent_id'], 
                       'user_id' => Auth::user()->id, 
                       'awards' =>  1, 
                   ];
            $condition = ['user_id' => Auth::user()->id,'talent_id' => $request['talent_id']];
            $checkExist = TalentAwards::where($condition)->first();
            if(empty($checkExist)) {
                $insertedId  = TalentAwards::create($awardArray);
                if(!empty($insertedId)){
                	$award = TalentAwards::where('talent_id', $request->talent_id)->count();
                	if ($award > 5) {
                		$award = 5;
                	}
		            $tt = Talents::where('id', $request->talent_id)->first();
		            $tt->award = $award;
		            $tt->save();
                    return $this->respond([
                        'status' => 'success',
                        'status_code' => $this->getStatusCode(),
                        'message' => 'Award Added Successfully.',
                    ]);
                } else {
                    return $this->respond([
                        'status' => 'error',
                        'status_code' => $this->getStatusCode(),
                        'message' => 'Something went wrong.',
                    ]);
                }
            } else {
            	$award = TalentAwards::where('talent_id', $request->talent_id)->count();
            	if ($award > 5) {
            		$award = 5;
            	}
	            $tt = Talents::where('id', $request->talent_id)->first();
	            $tt->award = $award;
	            $tt->save();

                 return $this->respond([
                    'status' => 'success',
                    'status_code' => $this->getStatusCode(),
                    'message' => 'You have already awarded this talent.',
                ]);
            }

         
        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }

    public function addTalentToCart(Request $request) {
		try {
			$rules = array(
                'talent_id' => 'required',
            );

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return $this->respondValidationError('Fields Validation Failed.', $validator);
            }

             $talent = Talents::where('id','=',$request['talent_id'])->first();
             $title = $talent['title'];
             $amount = $talent['price'];
             $condition = ['buyer_id' => Auth::user()->id, 'talent_id'=> $request['talent_id'], 'active'=> 1];
             $checkAlreadyPurhased = BuyerProducts::where($condition)->count();

             if(!empty($checkAlreadyPurhased)) {
                return $this->respond([
		            'status' => 'success',
		            'status_code' => $this->getStatusCode(),
		            'message' => 'You have already purchased this product.',
		        ]);

             } else {

                $cartCondition = ['status_id'=>1, 'user_id'=>Auth::user()->id, 'active'=>0];
                $checkCart = UserCarts::where($cartCondition)->where('status_id','<>','3')->get();
               
                if(count($checkCart)==0) {
                    
                    $userCartArray = ['user_id'=> Auth::user()->id, 'title'=>'cart_'.Auth::user()->id,'quantity'=>1, 'total_amount'=>$amount, 'created_by'=> Auth::user()->id, 'updated_by'=> Auth::user()->id];
                    $checkUserCart = UserCarts::create($userCartArray);

                    if(!empty($checkUserCart)) {

                      $whereCondition = ['talent_id' => $request['talent_id'],'user_id'=> Auth::user()->id, 'delete_flag'=>0];
                      $purchasedProductCart = PurchasedProduct::where($whereCondition)->get();

                      if(empty($purchasedProductCart)) {

                           $purchasedProductArray = ['user_id'=>Auth::user()->id, 'cart_id'=> $checkUserCart['id'], 'title'=> $title,'unit_price'=> $amount, 'quantity'=>1, 'total_amount' =>$amount];
                           $created = PurchasedProduct::create($purchasedProductArray);
                      }
                    }
                }

                /************ check cart again *********/
                $cartCondition = ['status_id'=>1, 'user_id'=>Auth::user()->id, 'active'=>0];
                $checkCart = UserCarts::where($cartCondition)->first();
                if(!empty($checkCart)){

                    $whereCondition = ['talent_id' => $request['talent_id'],'user_id'=> Auth::user()->id, 'delete_flag'=>0, 'purchased' => null];
                    $purchasedProductCart = PurchasedProduct::where($whereCondition)->count();

                    if(empty($purchasedProductCart)) {

                       $createArray = ['talent_id' => $request['talent_id'], 'user_id'=> Auth::user()->id, 'cart_id'=> $checkCart['id'], 'title'=> $title, 'unit_price'=> $amount, 'quantity'=> 1, 'total_amount'=> $amount];

                       $addedToCart = PurchasedProduct::insertGetId($createArray);

                       if(!empty($addedToCart)) {
                        
                          $condition = ['user_id'=>Auth::user()->id, 'delete_flag'=>'0'];
                          $data = PurchasedProduct::where($condition)->get();
                          $total_amount = $data->sum('total_amount');
                          $quantity = $data->sum('quantity');
                          $updateArray = ['quantity' =>$quantity, 'total_amount'=>$total_amount, 'updated_at' =>Carbon::now()];
                          $whereCondition = ['id' => $data[0]->cart_id, 'user_id'=>Auth::user()->id, 'active'=> 0];
                          $update = UserCarts::where($whereCondition)->where('status_id','<>',3)->update($updateArray);
                          return $this->respond([
				            	'status' => 'success',
				            	'status_code' => $this->getStatusCode(),
				            	'message' => 'Product added to cart.',
				        	]);
                       }
                    } else {
                          return $this->respond([
				            'status' => 'success',
				            'status_code' => $this->getStatusCode(),
				            'message' => 'Product already in cart.',
				        ]);
                    }
                } 
             }

        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }


    public function talentComment(Request $request){
    	try{
    		$rules = array(
                'talent_id' => 'required',
            );

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return $this->respondValidationError('Fields Validation Failed.', $validator);
            }

            $per_page = $request->per_page ? $request->per_page : 10;
    		$data['comments'] = TalentComments::with('commentBy')->where('talent_id', $request->talent_id)->paginate($per_page);

    		return $this->respond([
	            'status' => 'success',
	            'status_code' => $this->getStatusCode(),
	            'message' => 'Product Comment',
	            'data' =>  $data,
	        ]);

        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }


    public function TalentAwards(Request $request){
    	try{
    		$rules = array(
                'talent_id' => 'required',
            );

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return $this->respondValidationError('Fields Validation Failed.', $validator);
            }

            $per_page = $request->per_page ? $request->per_page : 10;
    		$data['comments'] = TalentAwards::with('getUsers')->where('talent_id', $request->talent_id)->paginate($per_page);

    		return $this->respond([
	            'status' => 'success',
	            'status_code' => $this->getStatusCode(),
	            'message' => 'Talent Awards',
	            'data' =>  $data,
	        ]);

        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }

    public function cartProducts(Request $request){
    	try {
	    	$condition = [
				'purchased_products.user_id' => Auth::id(), 
				'purchased_products.delete_flag' => 0,
				'purchased_products.purchased'	=>	null,
			];
			$per_page = $request->per_page ? $request->per_page : 10;

			$data['products'] = PurchasedProduct::with('getTalent', 'getCommercial', 'getSampleMedia', 'getSellerDetail')->where($condition)->paginate($per_page);
			$data['total'] = PurchasedProduct::where($condition)->get()->pluck('total_amount')->sum();
			$data['quantity'] = PurchasedProduct::where($condition)->get()->pluck('quantity')->sum();

			return $this->respond([
	            'status' => 'success',
	            'status_code' => $this->getStatusCode(),
	            'message' => 'Get cart products',
	            'file_url' => env('APP_FILE_URL'),
	            'data' =>  $data,
	        ]);

        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }


    public function deleteCartItem(Request $request) {
		
		try {
				$cartItemId = $request['id'];
				$condition = ['id' => $cartItemId];
				$updateArray = ['delete_flag' => 1];
				$update = PurchasedProduct::where($condition)->update($updateArray);
				$cart_id = PurchasedProduct::where($condition)->first()->cart_id;
				$product_price = PurchasedProduct::where('cart_id', $cart_id);
		 		$product_price->where('delete_flag', 0)->where('purchased', null);
		 		// $data['products'] = $product_price->get();
				$data['total'] = $product_price->get()->pluck('total_amount')->sum();
				$data['quantity'] = $product_price->get()->pluck('quantity')->sum();

				 
				 UserCarts::where('id', $cart_id)->update([
				 	'total_amount'	=>	$data['total'],
				 	'quantity'		=>	$data['quantity'],
				 ]); 

				 if(!empty($update)) {
				 	return $this->respond([
			            'status' => 'success',
			            'status_code' => $this->getStatusCode(),
			            'message' => 'Product removed from the cart.',
			            'file_url' => env('APP_FILE_URL'),
			            'data' =>  $data,
			        ]);
				 } else {
				 	return $this->respond([
			            'status' => 'error',
			            'status_code' => $this->getStatusCode(),
			            'message' => 'Unable to remove the product from the cart.',
			            'file_url' => env('APP_FILE_URL'),
			            'data' =>  $data,
			        ]);
				 }
			

        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
	}



	public function addRiderToTalent(Request $request) {

		try{

			$rules = array(
                'talent_id' => 'required',
            );

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return $this->respondValidationError('Fields Validation Failed.', $validator);
            }
                
            $talent_by = Talents::where('id', $request['talent_id'])->pluck('user_id')->first();
            
            $riderArray = [
               'talent_id' => $request['talent_id'],
               'talent_by' => $talent_by, 
               'user_id' => Auth::user()->id, 
               'rider' =>  1, 
             ];
             
            $condition = ['user_id' => Auth::user()->id,'talent_id' => $request['talent_id']];

            $checkExist = TalentRiders::where($condition)->first();

            if(empty($checkExist)) {
                $insertedId  = TalentRiders::create($riderArray);
               

                if(!empty($insertedId)){
                    
                    $posted_by = Talents::where('id', $request['talent_id'])->pluck('user_id')->first();

                    $fan_where =  ['follower' => Auth::user()->id, 'following' => $posted_by ];
                    $checkFanbase = Fanbase::where($fan_where)->first();

                    if(empty($checkFanbase)) {
                        $fanbase = ['follower' => Auth::user()->id, 'following' => $posted_by ];
                        $insert = Fanbase::create($fanbase);

                    }

                    $user = User::where('id', $talent_by)->first();
                    $message = [];
                    $name = $user->first_name.' '.$user->last_name;
                    $sender = Auth::user()->first_name.' '.Auth::user()->last_name;
                    $message = ['sender'=> $sender, 'name' => $name, 'email' => $user->email, 'content' => ''];
                    $sendOrfail = $this->triggerRiderEmail($message);

                    return $this->respond([
			            'status' => 'success',
			            'status_code' => $this->getStatusCode(),
			            'message' => 'Rider Added Successfully.',
			        ]);
                } else {
                	return $this->respond([
			            'status' => 'error',
			            'status_code' => $this->getStatusCode(),
			            'message' => 'Something went wrong.'
			        ]);
                }
            } else  {
            	return $this->respond([
		            'status' => 'success',
		            'status_code' => $this->getStatusCode(),
		            'message' => 'You are already a rider to this talent.',
		        ]);
            }			

        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
 
    }



    public function getRider(Request $request){
    	try{

    		$per_page = $request->per_page ? $request->per_page : 10;
            $data['riders'] = TalentRiders::with('rideBy')->where('talent_id', $request->talent_id)->withCount('isRider')->paginate($per_page);

    		return $this->respond([
	            'status' => 'success',
	            'status_code' => $this->getStatusCode(),
	            'message' => 'You are already a rider to this talent.',
	            'data' => $data
	        ]);
        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }
}

