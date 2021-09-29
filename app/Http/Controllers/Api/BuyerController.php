<?php 

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Models\BuyerProducts;
use App\Models\Talents;
use App\Models\CommercialMedia;
use App\Models\SampleMedia;
use App\Models\ProductMedia;
use App\Models\TalentRatings;
use App\Models\BuyerContacts;
use App\Models\TalentComments;
use App\Models\PurchasedProduct;
use App\Models\SocialBuzzRiders;
use App\Models\Fanbase;
use App\Models\TalentRiders;
use App\Models\ChatMessage;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\ProfileRequest;
use App\Models\Chats;
use App\Models\FavrioteUser;
use App\Models\SocialFacebookAccount;
use Illuminate\Support\Facades\Crypt;
use Session;
use Route;
use Response;
use Image as Image;
use Hash;
use DB;
use URL;
use App\Traits\MailsendTrait;

class BuyerController extends ApiController
{
	public function index(Request $request){
		try{
			$per_page = $request->per_page ? $request->per_page : 10;
	        $whereArr = array('buyer_id' => Auth::id(), 'active' => 1);
	        $data['products'] = BuyerProducts::where($whereArr)->with('getUserData', 'getTalent', 'getCommercila', 'getSampleMedia', 'getProductMedia')->whereHas('getUserData', function ($query) {
	            $query->where('users.id', '!=', '');
	        })->whereHas('getTalent', function ($query) {
	            $query->where('talents.id', '!=', '');
	        })->paginate($per_page);

	        $data['user'] = Auth::user();
	        return $this->respond([
		        'status' => 'success',
		        'status_code' => $this->getStatusCode(),
		        'message' => 'Get Product successfully.',
		        'data'	=>	$data
            ]);
        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
	}


	public function addCommentToTalent(Request $request){

       try {
       	    $rules = array(
                'comment' => 'required',
                'talent_id' => 'required'
            );

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return $this->respondValidationError('Fields Validation Failed.', $validator);
            }

               
            $id = !empty(Auth::user()->id) ? Auth::user()->id : '';
            $messageArray = ['talent_id' => $request['talent_id'],'buyer_id'=> $id, 'comment' => $request['comment'], 'created_by' => $id, 'updated_by' => $id];
            $data['comment'] = TalentComments::create($messageArray);

            return $this->respond([
		        'status' => 'success',
		        'status_code' => $this->getStatusCode(),
		        'message' => 'comment saved successfully.',
		        'data'	=>	$data
            ]);
        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }

    public function addBuyerRating(Request $request) {
		try {
            
            $rules = array(
            	'award_to_talent' => 'required',
                'comment' => 'required',
                'talent_id' => 'required'

            );

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return $this->respondValidationError('Fields Validation Failed.', $validator);
            }

            $id = isset(Auth::user()->id) ? Auth::user()->id : '';
            $now = Carbon::now();
            $whereCondition = ['talent_id' => $request['talent_id'], 'user_id' => $id];
            $talentRating = TalentRatings::where($whereCondition)->first();
            /* if rating not found */
            if (empty($talentRating)) {
                $ratingArray = ['user_id' => $id, 'talent_id' => $request['talent_id'], 'rating' => $request['award_to_talent'], 'buyer_comment' => $request['comment'], 'created_by' => $id, 'updated_by' => $id];
                $rating = TalentRatings::create($ratingArray);
                $talentRating = getTalentRating($request['talent_id']);
                $condition = ['id' => $request['talent_id']];
                $updateArray = ['avg_rating' => $talentRating];
                $ratingUpdate = Talents::where($condition)->update($updateArray);
                if (!empty($ratingUpdate)) {
                    return $this->respond([
				        'status' => 'success',
				        'status_code' => $this->getStatusCode(),
				        'message' => 'Rating add successfully.',
				        // 'data'	=>	$data
		            ]);
                }
                /* if rating Found */
            } else {

                $updateArray = ['rating' => $request['award_to_talent'], 'buyer_comment' => $request['comment'], 'updated_by' => $id, 'updated_at' => $now];
                $condition = ['talent_id' => $request['talent_id'], 'user_id' => $id];
                $updated = TalentRatings::where($condition)->update($updateArray);
                $talentRating = getTalentRating($request['talent_id']);
                $condition = ['id' => $request['talent_id']];
                $updateArray = ['avg_rating' => $talentRating];
                $ratingUpdate = Talents::where($condition)->update($updateArray);
                if (!empty($ratingUpdate)) {                    
		            return $this->respond([
				        'status' => 'success',
				        'status_code' => $this->getStatusCode(),
				        'message' => 'Rating update successfully.',
				        // 'data'	=>	$data
		            ]);
                }
            }
        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }


    public function deleteBuyerProduct(Request $request) {
        try {
        	$rules = array(
            	'id' => 'required',
                'talent_id' => 'required'

            );

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return $this->respondValidationError('Fields Validation Failed.', $validator);
            }

			$id = !empty(Auth::user()->id) ? Auth::user()->id : '';
            $condition = ['id' => $request['id'], 'buyer_id' => $id, 'talent_id' => $request['talent_id']];
            $checkProduct = BuyerProducts::where($condition)->first();
            if (!empty($checkProduct)) {
                $active = 0;
                $productArray = ['active' => $active];
                $updatedId = BuyerProducts::where($condition)->update($productArray);
                if (!empty($updatedId)) {
                    return $this->respond([
				        'status' => 'success',
				        'status_code' => $this->getStatusCode(),
				        'message' => 'Product delete successfully.',
				        // 'data'	=>	$data
		            ]);
                }
            }
            return $this->respond([
		        'status' => 'success',
		        'status_code' => $this->getStatusCode(),
		        'message' => 'Product unable to delete.',
		        // 'data'	=>	$data
            ]);
        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }


    public function downloadBuyerProduct(Request $request){

        try{
                
            $rules = array(
                'talent_id' => 'required'

            );

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return $this->respondValidationError('Fields Validation Failed.', $validator);
            }

    		$id = !empty(Auth::user()->id)?Auth::user()->id:'';
            $talent_ids_with_time  = $request['talent_id'].time();

            $allMedia = CommercialMedia::with('getProductMedia','getSampleMedia')->where('talent_id','=',$request['talent_id'])->get();

            $str_storage_path = 'assets/app/products/';
            
            if(!empty($allMedia))

            foreach ($allMedia as  $value) {
                
                if(!empty($value->image_path)) {

                    $filename = substr($value->image_path, strrpos($value->image_path, '/') + 1);

                    $copy_path = $str_storage_path.$talent_ids_with_time . '/commercial_product/';
                    File::makeDirectory($copy_path, 0777, true, true);
                    
                       if (file_exists($value->image_path)) {
                            if (copy($value->image_path, $copy_path . $filename)) {
                                
                            } 
                        } 
                }

                if(!empty($value->getProductMedia)) {
                   
                    $filename = substr($value->getProductMedia->pdf_path, strrpos($value->getProductMedia->pdf_path, '/') + 1);
                    $copy_path = $str_storage_path . $talent_ids_with_time . '/product_media/';

                    File::makeDirectory($copy_path, 0777, true, true);

                      if (file_exists($value->getProductMedia->pdf_path)) {
                           
                            if (copy($value->getProductMedia->pdf_path, $copy_path . $filename)) {
                                    
                            } 
                        }
                }
                    
                if(!empty($value->getSampleMedia)) {

                    $filename = substr($value->getSampleMedia->path_name, strrpos($value->getSampleMedia->path_name, '/') + 1);
                    $copy_path = $str_storage_path . $talent_ids_with_time . '/sample_media_arr/';
                  
                    File::makeDirectory($copy_path, 0777, true, true);
                    if (file_exists($value->getSampleMedia->path_name)) {
                        if (copy($value->getSampleMedia->path_name, $copy_path.$filename)) {
                        }
                    }
                }            
            }
             
           
            $files = glob($str_storage_path . $talent_ids_with_time);

            \Madzipper::make('assets/app/all_zip/talent_product' . $request['talent_id'] . '.zip')->add($files)->close();
            $download_url = array(
                "download_url" => URL::to('/') . "/assets/app/all_zip/talent_product" . $request['talent_id'] . ".zip",
            );

            File::deleteDirectory($str_storage_path . $talent_ids_with_time);
            $data['zip'] = $download_url;
            
            return $this->respond([
		        'status' => 'success',
		        'status_code' => $this->getStatusCode(),
		        'message' => 'Zipped product',
		        'data'	=>	$data
            ]);
        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }
}