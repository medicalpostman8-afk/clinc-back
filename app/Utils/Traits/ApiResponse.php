<?php

namespace App\Utils\Traits;

use Illuminate\Http\JsonResponse;

trait ApiResponse
{
    protected function apiResponse(
        $data = null,
        array $message = ['ar' => '', 'en' => ''],
        bool $status = true,
        int $code = 200
    ): JsonResponse {
        $data = is_array($data) ? $data : ['payload' => $data];

        return response()->json([
            'status'  => $status,
            'message' => $message,
            ...$data,
        ], $code, [], JSON_UNESCAPED_UNICODE);
    }

    protected function successResponse($data = null, array $message = ['ar' => 'تم بنجاح', 'en' => 'Success']): JsonResponse
    {
        return $this->apiResponse($data, $message, true, 200);
    }

    protected function createdResponse($data = null, array $message = ['ar' => 'تم الإنشاء بنجاح', 'en' => 'Created successfully']): JsonResponse
    {
        return $this->apiResponse($data, $message, true, 201);
    }

    protected function badRequestResponse(array $message = ['ar' => 'طلب غير صالح', 'en' => 'Bad request']): JsonResponse
    {
        return $this->apiResponse(null, $message, false, 400);
    }

    protected function unauthorizedResponse(array $message = ['ar' => 'غير مصرح به', 'en' => 'Unauthorized']): JsonResponse
    {
        return $this->apiResponse(null, $message, false, 401);
    }

    protected function forbiddenResponse(array $message = ['ar' => 'ممنوع', 'en' => 'Forbidden']): JsonResponse
    {
        return $this->apiResponse(null, $message, false, 403);
    }

    protected function notFoundResponse(array $message = ['ar' => 'غير موجود', 'en' => 'Not found']): JsonResponse
    {
        return $this->apiResponse(null, $message, false, 404);
    }

    protected function validationErrorResponse(array $errors, array $message = ['ar' => 'فشل التحقق من صحة البيانات', 'en' => 'Validation failed']): JsonResponse
    {
        return response()->json([
            'status'  => false,
            'message' => $message,
            'errors'  => $errors
        ], 422,  [], JSON_UNESCAPED_UNICODE);
    }

    protected function serverErrorResponse(array $message = ['ar' => 'خطأ في الخادم', 'en' => 'Server error']): JsonResponse
    {
        return $this->apiResponse(null, $message, false, 500);
    }
}
