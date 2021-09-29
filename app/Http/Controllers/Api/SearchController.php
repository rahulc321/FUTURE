<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\TalentCatagory;
use App\Models\Metatags;
use App\Models\Talents;
use Response;

class SearchController extends ApiController
{

	public function index(Request $request)
    { 
    	try {
    		$per_page = $request->per_page ? $request->per_page : 10 ;
            $data['catagories'] = TalentCatagory::paginate($per_page);
            foreach($data['catagories'] as $cat){
                $cat->catagory_desc = strip_tags($cat->catagory_desc);
            }
            
            return $this->respond([
                'status' => 'success',
                'status_code' => $this->getStatusCode(),
                'message' => 'Get Star Search',
                'file_url' => env('APP_FILE_URL'),
                'data' =>  $data,
            ]);  
        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }	

    }

    public function show($slug){
    	try {
	    	$data['catagory'] = TalentCatagory::where('slug','=',$slug)->first();

			return $this->respond([
                'status' => 'success',
                'status_code' => $this->getStatusCode(),
                'message' => 'Get Star Search Details',
                'file_url' => env('APP_FILE_URL'),
                'data' =>  $data,
            ]);            

        } catch (Exception $e) {
            return $this->respondWithError($e->getMessage());
        }
    }

}
