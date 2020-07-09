<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * @OA\Post(
 *      path="/auth/logout",
 *      operationId="logout",
 *      tags={"Auth"},
 *      summary="Log out",
 *      description="Log Out",
 *      security={
 *          {"bearer": {}}
 *      },
 *      @OA\RequestBody(
 *      ),
 *      @OA\Response(
 *          response=204,
 *          description="Successful operation",
 *       ),
 *      @OA\Response(
 *          response=400,
 *          description="Bad Request"
 *       ),
 *      @OA\Response(
 *          response=401,
 *          description="Unauthenticated",
 *      ),
 *      @OA\Response(
 *          response=403,
 *          description="Forbidden"
 *      )
 * )
 * Class LogOutController
 * @package App\Http\Controllers\Api\Auth
 */
class LogOutController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function __invoke(Request $request): JsonResponse
    {
        auth()->user()->tokens()->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
