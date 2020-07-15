<?php

namespace App\Virtual\Resources;


/**
 * @OA\Schema(
 *     title="CampaignResource",
 *     description="Campaign resource",
 *     @OA\Xml(
 *         name="CampaignResource"
 *     )
 * )
 */
class CampaignResource
{
    /**
     * @OA\Property(
     *     title="Data",
     *     description="Data wrapper"
     * )
     *
     * @var \App\Virtual\Models\Campaign[]
     */
    private $data;
}
