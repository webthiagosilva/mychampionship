<?php

namespace App\Helpers;

use Illuminate\Http\JsonResponse;

class ResponseHelper
{
	public static function success(array $data = null, string $message = null, int $code = 200): JsonResponse
	{
		return response()->json([
			'status' => 'success',
			'message' => $message,
			'data' => $data
		], $code);
	}

	public static function error(string $message = null, int $code = 400): JsonResponse
	{
		return response()->json([
			'status' => 'error',
			'message' => $message
		], $code);
	}
}
