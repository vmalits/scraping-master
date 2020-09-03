<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Api\Controller;
use App\Http\Requests\RegisterRequest;
use App\Services\AuthService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * @OA\Post(
 *      path="/auth/register",
 *      operationId="register",
 *      tags={"Auth"},
 *      summary="Register new user",
 *      description="Register new user",
 *      @OA\RequestBody(
 *          required=true,
 *          @OA\JsonContent(ref="#/components/schemas/RegisterRequest")
 *      ),
 *      @OA\Response(
 *          response=201,
 *          description="Successful operation",
 *          @OA\JsonContent(
 *              @OA\Property(property="message", type="string", example="Registration successfully!")
 *             )
 *          )
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
 * Class RegisterController
 * @package App\Http\Controllers\Api\Auth
 */
class RegisterController extends Controller
{
    public function __invoke(RegisterRequest $request, AuthService $authService): JsonResponse
    {
        $authService->register($request->validated());

        return response()->json([
            'message' => 'Please confirm yourself by clicking on verify user button sent to you on your email'
        ], Response::HTTP_CREATED);
    }
}
