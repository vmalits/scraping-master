<?php

namespace App\Virtual\Resources;


/**
 * @OA\Schema(
 *     title="ProxyResource",
 *     description="Proxy resource",
 *     @OA\Xml(
 *         name="ProxyResource"
 *     )
 * )
 */
class ProxyResource
{
    /**
     * @OA\Property(
     *     title="Data",
     *     description="Data wrapper"
     * )
     *
     * @var \App\Virtual\Models\Proxy[]
     */
    private $data;
}
