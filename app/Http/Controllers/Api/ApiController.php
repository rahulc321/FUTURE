<?php

namespace App\Http\Controllers\Api;

use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use Response;
use App\Http\Controllers\Controller;
use \Illuminate\Http\Response as Res;

/**
 * Class ApiController
 * @package App\Modules\Api\Lesson\Controllers
 */


/**
 * @OA\Info(
 *      version="1.0.0",
 *      title="FutureStarr API",
 *      description="FutureStar API Swagger Documentation. IF you want to use postman just import documetation json file",
 *      @OA\Contact(
 *          email="admin@admin.com"
 *      ),
 * )
 *
 *
 */
class ApiController extends Controller
{
    const DEFAULT_FILTER = array('criteria' => '', 'sort' => '', 'limit' => 10, 'offset' => 0);

    private $print = false;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->beforeFilter('auth', ['on' => 'post']);
    }

    /**
     * @var int
     */
    protected $statusCode = Res::HTTP_OK;

    /**
     * @return mixed
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * @param $message
     * @return json response
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;
        return $this;
    }

    public function respondCreated($message, $data = null)
    {
        $this->statusCode = Res::HTTP_CREATED;
        return $this->respond([
            'status' => 'success',
            'status_code' => $this->statusCode,
            'message' => $message,
            'data' => $data
        ]);
    }

    /**
     * @param Paginator $paginate
     * @param $data
     * @return mixed
     */
    protected function respondWithPagination(Paginator $paginate, $data, $message)
    {
        $this->statusCode = Res::HTTP_OK;
        $data = array_merge($data, [
            'paginator' => [
                'total_count'  => $paginate->total(),
                'total_pages' => ceil($paginate->total() / $paginate->perPage()),
                'current_page' => $paginate->currentPage(),
                'limit' => $paginate->perPage(),
            ]
        ]);

        return $this->respond([
            'status' => 'success',
            'status_code' => $this->statusCode,
            'message' => $message,
            'data' => $data
        ]);
    }

    public function respondNotFound($message = 'Not Found!')
    {
        $this->statusCode = Res::HTTP_NOT_FOUND;
        return $this->respond([
            'status' => 'error',
            'status_code' => $this->statusCode,
            'error' => $message,
        ]);
    }

    public function respondInternalError($message)
    {
        $this->statusCode = Res::HTTP_INTERNAL_SERVER_ERROR;
        return $this->respond([
            'status' => 'error',
            'status_code' => $this->statusCode,
            'error' => $message,
        ]);
    }

    public function respondValidationError($message, $validator)
    {
        $this->statusCode = Res::HTTP_UNPROCESSABLE_ENTITY;
        $messages = $validator->messages();
        $msg      = '';
        $i = 0;
        foreach ($messages->all() as $key => $value) {
            $msg .=  ($i > 0)? "\n".$value : $value;
            $i++;
        }
        return $this->respond([
            'status' => 'error',
            'status_code' => $this->statusCode,
            'message' => $message,
            'error' => $msg
        ]);
    }

    public function respond($data, $headers = [])
    {
        return Response::json($data, $this->getStatusCode(), $headers);
    }

    public function respondWithError($message)
    {
        $this->statusCode = Res::HTTP_UNAUTHORIZED;
        return $this->respond([
            'status' => 'error',
            'status_code' => $this->statusCode,
            'error' => $message,
        ]);
    }

    public function respondWithOtherError($message, $statusCode)
    {
        $this->statusCode = $statusCode;
        return $this->respond([
            'status' => 'error',
            'status_code' => $statusCode,
            'error' => $message,
        ]);
    }

    protected function clog($message)
    {
        if ($this->print) { 
            print $message;
        }
    }
}
