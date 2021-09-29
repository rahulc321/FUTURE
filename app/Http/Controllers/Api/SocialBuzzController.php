<?php 

namespace App\Http\Controllers\Api;

use App\Http\Requests;
use Illuminate\Support\Str;
use Mail;
use Illuminate\Http\Request;
use JWTAuth;
use Response;
use \Illuminate\Http\Response as Res;
use Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use PhpParser\Node\Stmt\TryCatch;
use PHPUnit\Framework\Exception;
use URL;
use File;
use Auth;
use App\Traits\MailsendTrait;

use App\Models\TalentCatagory;
use App\Models\SocialBuzz;
use App\Models\SocialBuzzComments;
use App\Models\SocialBuzzReplies;
use App\Models\SocialBuzzRiders;
use App\Models\SocialBuzzAwards;
use App\Models\SocialBuzzReports;
use App\Models\CommercialAds;
use App\Models\Fanbase;
use App\Models\Talents;
use App\User;

class SocialBuzzController extends ApiController
{

     use MailsendTrait;


    public function socialBuzz(Request $request) {

        try {
            
            $per_page = $request->per_page ? $request->per_page : 10;
            $socialBuzzList = array();
            $whereArr = array('category_id' => $request->category_id, 'active' => 1);
            $socialBuzzList = SocialBuzz::withCount(['getSocialBuzzComments', 'getSocialBuzzRiders', 'getSocialBuzzAwards', 'totalPurchase'])->with(['getUserData'])->where($whereArr)->orderBy('id', 'DESC')->paginate($per_page);

            return $this->respond([
                'status' => 'success',
                'status_code' => $this->getStatusCode(),
                'message' => 'Social Buzz Listing!',
                'file_url' => env('APP_FILE_URL'),
                'data' =>  $socialBuzzList,
            ]);

        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }
    
    /*
    *
    * Create Social Buzz  post
    *
    */

    public function postSocialBuzz(Request $request) {

        try {

            $rules = array(
                'comment'      => 'required',
                'category_id'  => 'required',
                'media_file'   => 'sometimes|mimes:jpeg,jpg,png,mp4,wav,mp3,mpeg|required',

            );
          
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return $this->respondValidationError('Fields Validation Failed.', $validator);
            } else {
                    $posted_by = Auth::user()->id;
                    if ($request->hasFile('media_file')) {
                        $image = $request->file('media_file');
                        $name = time() . '.' . $image->getClientOriginalName();
                        
                        $fpath = env('APP_FILE_UPLOAD');
                        $destinationPath = $fpath.'/public/uploads/social-buzz/';
                       
                        chmod($image->move($destinationPath, $name),0777);
                        $imageName = 'uploads/social-buzz/' . $name;
                    } else {
                         $imageName = '';
                    }
                   
                    $table_array  = [ 
                        'user_id' => $posted_by, 
                        'category_id' => $request->category_id, 
                        'comment' => $request->comment, 
                        'product_link' => $request->product_link, 
                        'product_img_path' => $imageName, 
                        'posted_by' => $posted_by, 
                        'updated_by' => $posted_by, 
                        'media_type' => $request->media_type
                    ];
                    
                    SocialBuzz::create($table_array);
                    return $this->respond([
                        'status' => 'success',
                        'status_code' => $this->getStatusCode(),
                        'message' => 'Social Buzz posted saved successfully!',
                    ]);
                
            }
        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }

    /*
    *
    * Update Social Buzz  post
    *
    */

    public function updateSocialBuzz(Request $request) {

        try {
            $rules = array(                
                'social_buzz_id' => 'required',
                'comment'        => 'required',
                'category_id'    => 'required',
                'media_file'     => 'sometimes|mimes:jpeg,jpg,png,mp4,wav,mp3,mpeg|required',
            );
            
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return $this->respondValidationError('Fields Validation Failed.', $validator);
            } else {
                $posted_by = Auth::user()->id; 
                if($request->has('media_file')) {
                    $image = $request->file('media_file');
                    $name = time() . '.' . $image->getClientOriginalName();
                    
                    $fpath = env('APP_FILE_UPLOAD');
                    $destinationPath = $fpath.'/public/uploads/social-buzz/';
                    
                    chmod($image->move($destinationPath, $name),0777);
                    $imageName = 'uploads/social-buzz/' . $name;

                    if($request['previous_file'] !='' && file_exists($request['previous_file'])){
                            $file_path = public_path().'/'.$request['previous_file'];
                            unlink($file_path);
                    }       
                } else {
                    $imageName = $request['previous_file'];
                }                
                    $table_array  = [ 
                        'user_id' => $posted_by, 
                        'category_id' => $request->category_id, 
                        'comment' => $request->comment, 
                        'product_link' => $request->product_link, 
                        'product_img_path' => $imageName, 
                        'posted_by' =>$posted_by, 
                        'updated_by' => $posted_by, 
                        'media_type' => $request->media_type
                    ];
                
                $updateCondition = ['id'=> $request->social_buzz_id, 'user_id' => $posted_by ];
                $updated = SocialBuzz::where($updateCondition)->update($table_array);

                return $this->respond([
                    'status' => 'success',
                    'status_code' => $this->getStatusCode(),
                    'message' => 'Social Buzz posted update successfully!',
                ]);
                
            }
        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }


    /*
    *
    * Social Buzz Comments get and post functions
    *
    */

    public function postSocialBuzzComment(Request $request) {

           try {
                $rules = array(
                    'comment'      => 'required',
                    'social_buzz_id' => 'required'
                );
                // return $request->all();
                $validator = Validator::make($request->all(), $rules);

                if ($validator->fails()) {
                    return $this->respondValidationError('Fields Validation Failed.', $validator);
                } else {
                    $posted_by = Auth::user()->id;
                    $table_array = array(
                        'user_id' => $posted_by,
                        'post_id' => $request->social_buzz_id,
                        'post_comment' => $request->comment,
                        'posted_by' => $posted_by,
                        'created_by' => $posted_by,
                        'updated_by' => $posted_by

                     );

                    SocialBuzzComments::create($table_array);

                    return $this->respond([
                        'status' => 'success',
                        'status_code' => $this->getStatusCode(),
                        'message' => 'Comment posted successfully!',
                    ]);
                    
                }
            } catch (Exception $e) {
                return $this->respondWithError($e->getMessage());
            }
    }

    public function getSocailBuzzComments(Request $request) 
    {
        
        try {
        
            $socialBuzzComments = array();
            $per_page = $request->per_page ? $request->per_page : 10;
            $socialBuzzComments = SocialBuzzComments::with(['commentBy'])->where('post_id', $request->post_id)->paginate($per_page);

            return $this->respond([
                'status' => 'success',
                'status_code' => $this->getStatusCode(),
                'message' => 'Social Buzz Comments!',
                'file_url' => env('APP_FILE_URL'),
                'data' => $socialBuzzComments,
            ]);

        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    } 

    /*
    *
    * Social Buzz rider get and post functions
    *
    */

    public function postSocialBuzzRider(Request $request) 
    {
        try {
            $rules = array(
                // 'posted_by'    => 'required',
                'social_buzz_id' => 'required'
            );
            
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return $this->respondValidationError('Fields Validation Failed.', $validator);
            } 

            $posted_by = SocialBuzz::where('id', $request->social_buzz_id)->pluck('user_id')->first();
            $oLd  = SocialBuzzRiders::Where('post_id', $request->social_buzz_id)
                ->where('social_buzz_by', $posted_by)
                ->where('user_id', Auth::user()->id)->first();
            if ($oLd  != null) {
                return $this->respond([
                    'status' => 'success',
                    'status_code' => $this->getStatusCode(),
                    'message' => 'Rider already added.',
                ]);
            }
            $rider = 1;
            $rider_data = new SocialBuzzRiders();
            $rider_data->post_id = $request->social_buzz_id;
            $rider_data->user_id = Auth::user()->id;
            $rider_data->social_buzz_by = $posted_by;
            $rider_data->platform = 'SocialBuzz';
            $rider_data->save();
            $insertedId = $rider_data->id;

            if (!empty($insertedId)) {
                $fan_where =  ['follower' => Auth::user()->id, 'following' => $posted_by ];
                $checkFanbase = Fanbase::where($fan_where)->first();
                
                if(empty($checkFanbase)){
                    $fanbase = ['follower' => Auth::user()->id, 'following' => $posted_by ];
                    $insert = Fanbase::create($fanbase);
                }

                $user = User::where('id', $posted_by)->first();
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
                    'message' => 'Something went wrong.',
                ]);
            }            
        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }

    /**
     * @description: Api To follow Followings
     * @param: following
     * @return: Json String Response
     */
    public function followUser(Request $request) 
    {
        try {
            $rules = array(
                'posted_by'    => 'required',
            );
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return $this->respondValidationError('Fields Validation Failed.', $validator->errors());
            } else {
                $ride_by = Auth::user()->id;
                $posted_by = $request->posted_by;
                $user = User::find($posted_by);
                if(!$user){
                    return $this->respondWithOtherError("User is not available.", Res::HTTP_BAD_REQUEST);
                }
                if($user && $user->role_id == '1' || $ride_by == $user->id){
                    return $this->respondWithOtherError("You can not be a rider of Admin/Yourself.", Res::HTTP_BAD_REQUEST);
                }else{
                    $fan_where =  ['follower' => $ride_by, 'following' => $posted_by ];
                    $checkFanbase = Fanbase::where($fan_where)->first();
                    if(empty($checkFanbase)){
                        $fanbase = ['follower' => $ride_by, 'following' => $posted_by ];
                        Fanbase::create($fanbase);
                        return $this->respond([
                            'status' => 'success',
                            'status_code' => $this->getStatusCode(),
                            'message' => 'Rider added successfully!',
                        ]);
                    }else{
                        return $this->respond([
                            'status' => 'success',
                            'status_code' => $this->getStatusCode(),
                            'message' => 'You are already a rider!',
                        ]);
                    }
                }
            }
        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }

    public function getSocailBuzzRiders(Request $request) 
    {
        // return Auth::user();
        try {
            
            $per_page = $request->per_page ? $request->per_page : 10;
            // $socialBuzzRiders = array();
            
            $data['riders'] = SocialBuzzRiders::with(['rideBy'])->where('post_id', $request->post_id)->paginate($per_page);

            $socialBuzzRiders = SocialBuzzRiders::with(['rideBy'])
                ->where('post_id', $request->post_id)
                ->where('user_id', Auth::id())
                ->first();
            if ($socialBuzzRiders == null) {
                $data['isRider'] = false;
            }else{
                $data['isRider'] = true;
            }

            return $this->respond([
                'status' => 'success',
                'status_code' => $this->getStatusCode(),
                'message' => 'Social Buzz Riders!',
                'file_url' => env('APP_FILE_URL'),
                'data' => $data,
            ]);

        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    } 
    

    /*
    *
    * Social Buzz award get and post functions
    *
    */

    public function postSocialBuzzAward(Request $request)
    {
        try {
            $rules = array(                
                'social_buzz_id' => 'required'
            );
          
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return $this->respondValidationError('Fields Validation Failed.', $validator);
            } else {
                $ride_by = Auth::user()->id;
                $checkCondition = ['user_id' => $ride_by, 'post_id' => $request->social_buzz_id ];
                $checkAlreadyExist = SocialBuzzAwards::where($checkCondition)->first();

                if(!empty($checkAlreadyExist)) {
                   
                    return $this->respond([
                        'status' => 'success',
                        'status_code' => $this->getStatusCode(),
                        'message' => 'Already awarded the SocialBuzz.',
                    ]);

                } else {
                
                    $award = 1;
                    $table_array = array(

                        'user_id' => $ride_by,
                        'post_id' => $request->social_buzz_id,
                        'award'   => $award            
                     );
                    
                    $awarded = SocialBuzzAwards::create($table_array);
                   
                    return $this->respond([
                        'status' => 'success',
                        'status_code' => $this->getStatusCode(),
                        'message' => 'Award Added Successfully.',
                    ]);
                }
                
            }
        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }

    public function getSocialBuzzAwards(Request $request) 
    {
        
        try {
        
            $per_page = $request->per_page ? $request->per_page : 10;
            // $getSocialBuzzAwards = array();
            
            $data['awards'] = SocialBuzzAwards::with(['awardBy'])->where('post_id', $request->post_id)->paginate($per_page);
            $checkAward = SocialBuzzAwards::where('post_id', $request->post_id)->where('user_id', Auth::id())->first();
            if ($checkAward == null) {
                $data['isAwarded'] = false;
            }else{
                $data['isAwarded'] = true;
            }

            return $this->respond([
                'status' => 'success',
                'status_code' => $this->getStatusCode(),
                'message' => 'Social Buzz Awards!',
                'file_url' => env('APP_FILE_URL'),
                'data' => $data,
            ]);

        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    } 

    public function socialBuzzReport(Request $request)  {
       
        try {
            $rules = array(                
                'social_buzz_id' => 'required'
            );
          
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return $this->respondValidationError('Fields Validation Failed.', $validator->errors());
            } else {
                $user_id = Auth::user()->id;
                $checkCondition = ['post_id' => $request->social_buzz_id, 'user_id' => $user_id];
                $checkAlreadyExist = SocialBuzzReports::where($checkCondition)->first();

                if(!empty($checkAlreadyExist)) {
                
                    return $this->respond([
                        'status' => 'success',
                        'status_code' => $this->getStatusCode(),
                        'message' => 'Already Reported!.',
                    ]);

                } else {

                    $table_array = array (
                       'post_id' => $request->social_buzz_id,
                        'user_id' => $user_id
                    );

                    $saved = SocialBuzzReports::create($table_array);
                    /*** REPORTER DATA START*******/
                    $reporter = User::find($user_id);

                    $report_name = $reporter['first_name'] . ' ' . $reporter['last_name'];
                    $report_email = $reporter['email'];
                    /*** REPORTER DATA END*******/
                    /*** REPORT DATA START ******/
                    $whereArr = array('id' => $request['social_buzz_id'], 'active' => 1);
                    $reportData = SocialBuzz::with('getUserData')->where($whereArr)->first();
                    $email = $reportData->getUserData['email'];
                    $name = $reportData->getUserData['first_name'] . ' ' . $reportData->getUserData['last_name'];
                    $comment = $reportData['comment'];
                    $created_at = $reportData->getUserData['created_at'];
                    /** REPORT DATA END **/
                   
                    /** EMAIL FUNCTION **/
                    $mail = $this->sendReportRequestMailToAdmin($email, $name, $comment, $report_name, $report_email);
                    /** EMAIL FUNCTION END **/

                    return $this->respond([
                        'status' => 'success',
                        'status_code' => $this->getStatusCode(),
                        'message' => 'Reported Successfully!.',
                    ]);
                }

            }          
            
        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }

    }

    public function socialBuzzProductListing(Request $request) {
         
        try {
        
            $productListng = array();
            $user_id = Auth::user()->id;
            $talentCondition = ['user_id' => $user_id, 'active'=>'Active'];
            $productListng  = Talents::where($talentCondition)->get();

            return $this->respond([
                'status' => 'success',
                'status_code' => $this->getStatusCode(),
                'message' => 'Social Buzz Product Listing!',
                'file_url' => env('APP_FILE_URL'),
                'data' => $productListng,
            ]);

        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }

    public function getAds(Request $request){
        try {
        
            $ads = getAds($request->category_id);
            foreach ($ads as $key => $ad) {
                 $t = Talents::where('id', $ad->product_id)->first();
                 if ($t != null) {
                    $ad->slug = $t->slug;
                 }else{
                    $ad->slug = null;
                 }
                 
            }

            return $this->respond([
                'status' => 'success',
                'status_code' => $this->getStatusCode(),
                'message' => 'Social Buzz Product Listing!',
                'file_url' => env('APP_FILE_URL'),
                'data' => $ads,
            ]);

        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }

}
