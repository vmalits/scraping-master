<?php


namespace App\Virtual;

/**
 * @OA\Schema(
 *      title="Campaign request",
 *      description="request body data",
 *      type="object",
 * )
 */
class CampaignRequest
{
    /**
     * @OA\Property(
     *      title="name",
     *      example="Test campaign"
     * )
     *
     * @var string
     */
    public $name;

}
