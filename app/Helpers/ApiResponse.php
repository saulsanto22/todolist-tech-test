<?php
namespace App\Helpers;
use Illuminate\Http\JsonResponse;

class ApiResponse
{
    public static function success($data = null, string $message = 'Success', int $code = 200): JsonResponse {
        return response()->json(['status'=>'success','message'=>$message,'data'=>$data], $code);
    }
    public static function error(string $message = 'Something went wrong', int $code = 500, $errors = null): JsonResponse {
        return response()->json(['status'=>'error','message'=>$message,'errors'=>$errors], $code);
    }
    public static function validationError($errors, string $message = 'Validation failed'): JsonResponse {
        return response()->json(['status'=>'error','message'=>$message,'errors'=>$errors], 422);
    }
    public static function notFound(string $message = 'Not found'): JsonResponse {
        return response()->json(['status'=>'error','message'=>$message], 404);
    }
}