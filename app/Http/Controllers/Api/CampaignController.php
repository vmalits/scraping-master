<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\CampaignRequest;
use App\Http\Resources\CampaignResource;
use App\Models\Campaign;
use Illuminate\Http\Response;


class CampaignController extends Controller
{
    /**
     * @OA\Get(
     *      path="/campaigns",
     *      operationId="getCampaignsList",
     *      tags={"Campaigns"},
     *      summary="Get list of campaigns",
     *      description="Returns list of campaigns",
     *      security={
     *          {"bearer": {}}
     *      },
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/CampaignResource")
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
    public function index()
    {
        return CampaignResource::collection(Campaign::latest()->paginate(5));
    }

    /**
     * @OA\Post(
     *      path="/campaigns",
     *      operationId="storeCampaign",
     *      tags={"Campaigns"},
     *      summary="Store new campaign",
     *      description="Returns campaign data",
     *      security={
     *          {"bearer": {}}
     *      },
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/CampaignRequest")
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/Campaign")
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
    public function store(CampaignRequest $request)
    {
        $campaign = Campaign::firstOrCreate([
            'user_id' => request()->user()->id,
            'name' => $request->name
        ]);
        return (new CampaignResource($campaign))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * @OA\Get(
     *      path="/campaigns/{id}",
     *      operationId="getCampaignById",
     *      tags={"Campaigns"},
     *      summary="Get campaign information",
     *      description="Returns campaign data",
     *      security={
     *          {"bearer": {}}
     *      },
     *      @OA\Parameter(
     *          name="id",
     *          description="Campaign id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/Campaign")
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
    public function show(Campaign $campaign)
    {
        return new CampaignResource($campaign);
    }

    /**
     * @OA\Put(
     *      path="/campaigns/{id}",
     *      operationId="updateCampaign",
     *      tags={"Campaigns"},
     *      summary="Update existing campaign",
     *      description="Returns updated campaign data",
     *      security={
     *          {"bearer": {}}
     *      },
     *      @OA\Parameter(
     *          name="id",
     *          description="Campaign id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/CampaignRequest")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/Campaign")
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
    public function update(CampaignRequest $request, Campaign $campaign)
    {
        $campaign->update($request->validated());
        return (new CampaignResource($campaign))
            ->response()
            ->setStatusCode(Response::HTTP_OK);
    }

    /**
     * @OA\Delete(
     *      path="/campaigns/{id}",
     *      operationId="deleteCampaign",
     *      tags={"Campaigns"},
     *      summary="Delete existing campaign",
     *      description="Deletes a record and returns no content",
     *      security={
     *          {"bearer": {}}
     *      },
     *      @OA\Parameter(
     *          name="id",
     *          description="Campaign id",
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
    public function destroy(Campaign $campaign)
    {
        $campaign->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }
}
