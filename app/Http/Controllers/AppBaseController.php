<?php

namespace App\Http\Controllers;

use App\Http\Resources\ResponseUtil;
use Illuminate\Support\Facades\Response;

class AppBaseController extends Controller
{
  public function sendResponse($result, $message)
  {
    return Response::json(ResponseUtil::makeResponse($message, $result));
  }

  public function sendError($error, $code = 404)
  {
    return Response::json(ResponseUtil::makeError($error), $code);
  }

  public function sendSuccess($message)
  {
    return Response::json([
      'success' => true,
      'message' => $message
    ], 200);
  }
}
