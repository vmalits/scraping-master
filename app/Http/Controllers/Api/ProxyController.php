<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProxyRequest;
use App\Http\Resources\ProxyResource;
use App\Models\Proxy;
use App\QueryFilters\ProxyFilter;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProxyController extends Controller
{
    /**
     * @OA\Get(
     *      path="/proxies",
     *      operationId="getProxyList",
     *      tags={"Proxy"},
     *      summary="Get proxy list",
     *      description="Returns proxy list",
     *      security={
     *          {"bearer": {}}
     *      },
     *      @OA\Parameter(
     *       name="type",
     *       in="query",
     *      @OA\Schema(
     *          type="string"
     *        )
     *      ),
     *      @OA\Parameter(
     *       name="ip",
     *       in="query",
     *      @OA\Schema(
     *          type="string"
     *        )
     *      ),
     *      @OA\Parameter(
     *       name="port",
     *       in="query",
     *      @OA\Schema(
     *          type="string"
     *        )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/ProxyResource")
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
    public function index(ProxyFilter $filters)
    {
        return ProxyResource::collection(Proxy::filter($filters)->paginate(5));
    }

    /**
     * @OA\Post(
     *      path="/proxies",
     *      operationId="storeProxy",
     *      tags={"Proxy"},
     *      summary="Store new proxy",
     *      description="Returns proxy data",
     *      security={
     *          {"bearer": {}}
     *      },
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/ProxyRequest")
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/Proxy")
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     * )
     */
    public function store(ProxyRequest $request)
    {
        $proxy = Proxy::firstOrCreate($request->validated());
        return (new ProxyResource($proxy))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * @OA\Get(
     *      path="/proxy/{id}",
     *      operationId="getProxyById",
     *      tags={"Proxy"},
     *      summary="Get proxy information",
     *      description="Returns proxy data",
     *      security={
     *          {"bearer": {}}
     *      },
     *      @OA\Parameter(
     *          name="id",
     *          description="Proxy id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/Proxy")
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     * )
     */
    public function show(Proxy $proxy)
    {
        return new ProxyResource($proxy);
    }


    /**
     * @OA\Put(
     *      path="/proxy/{id}",
     *      operationId="updateProxy",
     *      tags={"Proxy"},
     *      summary="Update existing proxy",
     *      description="Returns updated proxy data",
     *      security={
     *          {"bearer": {}}
     *      },
     *      @OA\Parameter(
     *          name="id",
     *          description="Proxy id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/ProxyRequest")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/Proxy")
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Resource Not Found"
     *      )
     * )
     */
    public function update(ProxyRequest $request, Proxy $proxy)
    {
        $proxy->update($request->validated());
        return (new ProxyResource($proxy))
            ->response()
            ->setStatusCode(Response::HTTP_OK);
    }

    /**
     * @OA\Delete(
     *      path="/proxies/{id}",
     *      operationId="deleteProxy",
     *      tags={"Proxy"},
     *      summary="Delete existing proxy",
     *      description="Deletes a record and returns no content",
     *      security={
     *          {"bearer": {}}
     *      },
     *      @OA\Parameter(
     *          name="id",
     *          description="Proxy id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=204,
     *          description="Successful operation",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Resource Not Found"
     *      )
     * )
     */
    public function destroy(Proxy $proxy)
    {
        $proxy->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }


    /**
     * @OA\Get(
     *      path="/proxies/available-types",
     *      operationId="getProxyTypes",
     *      tags={"Proxy"},
     *      summary="Get types list",
     *      description="Returns types list",
     *      security={
     *          {"bearer": {}}
     *      },
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
    public function availableTypes(): JsonResponse
    {
        return \response()
            ->json(Proxy::TYPES)
            ->setStatusCode(Response::HTTP_OK);
    }
}
