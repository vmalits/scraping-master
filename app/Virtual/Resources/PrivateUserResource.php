<?php


namespace App\Virtual\Resources;


/**
 * @OA\Schema(
 *     title="PrivateUserResource",
 *     description="Private user resource",
 *     @OA\Xml(
 *         name="PrivateUserResource"
 *     )
 * )
 */
class PrivateUserResource
{
    /**
     * @OA\Property(
     *     title="Data",
     *     description="Data wrapper"
     * )
     *
     * @var \App\Virtual\Models\User[]
     */
    private $data;
}
