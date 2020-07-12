<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Api\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerificationController extends Controller
{
    /**
     * @OA\Get(
     *      path="/auth/email/verify",
     *      operationId="getProjectsList",
     *      tags={"Auth"},
     *      summary="Verify email",
     *      description="Verify email",
     *      @OA\Parameter(
     *          name="id",
     *          description="User id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="expires",
     *          description="expires",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="hash",
     *          description="hash",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="signature",
     *          description="signature",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *     )
     */
    public function verify(int $id, Request $request): JsonResponse
    {
        if (!$request->hasValidSignature()) {
            return response()->json([
                'message' => 'Email validation failed!'
            ], Response::HTTP_UNAUTHORIZED);
        }
        $user = User::findOrFail($id);
        if (!$user->hasVerifiedEmail()) {
            $user->markEmailAsVerified();
            return response()->json([
                'message' => 'The email confirmed!'
            ], Response::HTTP_OK);
        }

        return response()->json([
            'message' => 'The email already confirmed!'
        ], Response::HTTP_OK);
    }

    /**
     * @OA\Get(
     *      path="/auth/email/resend",
     *      operationId="Resend",
     *      tags={"Auth"},
     *      summary="Resend email",
     *      description="Resend email",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *     )
     */
    public function resend(): JsonResponse
    {
        if (auth()->user()->hasVerifiedEmail()) {
            return response()->json([
                'message' => 'The email already verified!'
            ], Response::HTTP_OK);
        }

        auth()->user()->sendEmailVerificationNotification();
        return response()->json([
            'message' => 'Email verification link was send on you email!'
        ], Response::HTTP_OK);
    }
}
