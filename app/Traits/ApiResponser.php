<?php

namespace App\Traits;

use Illuminate\Http\Response;

trait ApiResponser
{
  /**
   * [successResponse description]
   *
   * @param   [type]    $data  [$data description]
   * @param   [type]    $code  [$code description]
   * @param   Response         [ description]
   * @param   HTTP_OK          [ description]
   *
   * @return  [type]           [return description]
   */
  public function successResponse($data, $code = Response::HTTP_OK)
  {
    return response($data, $code)->header('content-Type', 'application/json');
  }

  /**
   * [errorResponse Build error]
   *
   * @param   [type]  $message  [$message description]
   * @param   [type]  $code     [$code description]
   *
   * @return  [type]            [return description]
   */
  public function errorResponse($message, $code)
  {
    return response()->json(['error' => $message, 'code' => $code], $code);
  }

  /**
   * [errorMessage description]
   *
   * @param   [type]  $message  [$message description]
   * @param   [type]  $code     [$code description]
   *
   * @return  [type]            [return description]
   */
  public function errorMessage($message, $code)
  {
    return response($message, $code)->header('content-Type', 'application/json');
  }
}