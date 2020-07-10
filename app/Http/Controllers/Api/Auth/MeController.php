<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\PrivateUserResource;
use Illuminate\Http\Request;

/**
 * @OA\Get(
 *      path="/auth/me",
 *      operationId="Me",
 *      tags={"Auth"},
 *      summary="Get user data",
 *      description="Get user data",
 *      security={
 *          {"bearer": {}}
 *      },
 *      @OA\Response(
 *          response=200,
 *          description="Successful operation",
 *          @OA\JsonContent(ref="#/components/schemas/PrivateUserResource")
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
class MeController extends Controller
{
    /**
     * @param Request $request
     * @return PrivateUserResource
     */
    public function __invoke(Request $request): PrivateUserResource
    {
        return new PrivateUserResource($request->user());
    }
}
