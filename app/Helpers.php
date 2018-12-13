<?php
/**
 * Created by PhpStorm.
 * User: timothy
 * Date: 12/11/18
 * Time: 2:21 PM
 */

function apiSuccess($data, $msg = "Success", $status = 200)
{
    $responder = config('app.apiResponse');
    $responder['status'] = $status;
    $responder['message'] = $msg;
    $responder['data'] = $data;
//    $responder['meta'] = $meta;

    return response()->json($responder);
}

function apiFailure($data, $msg = "An Error Occurred",  $code = 404)
{
    $responder = config('app.apiResponse');
    $responder['status'] =  $code;
    $responder['message'] = $msg;
    $responder['data'] = $data;

    return response()->json($responder);
}

function OptimiseImage ($image,$identification_no){
    $extension = $image->getClientOriginalExtension();
    $imageName = $identification_no.'.'.$extension;

    $newImage = Image::make($image->getRealPath())->resize(600,600);
    $newImage->save(public_path('/images/').$imageName, 60);

    return $imageName;

}
