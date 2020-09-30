<?php


namespace App\Virtual\Models;

/**
 * @OA\Schema(
 *     title="Proxy",
 *     description="Proxy model",
 * )
 */
class Proxy
{
    /**
     * @OA\Property(
     *     title="ID",
     *     description="ID",
     *     format="int64",
     *     example=1
     * )
     *
     * @var integer
     */
    private $id;

    /**
     * @OA\Property(
     *     title="ip",
     *     description="ip",
     * )
     *
     * @var string
     */
    private $ip;

    /**
     * @OA\Property(
     *     title="port",
     *     description="port",
     * )
     *
     * @var string
     */
    private $port;

    /**
     * @OA\Property(
     *     title="type",
     *     description="type",
     * )
     *
     * @var string
     */
    private $type;

    /**
     * @OA\Property(
     *     title="active",
     *     description="active",
     * )
     *
     * @var bool
     */
    private $active;
}
