<?php


namespace App\Virtual;

/**
 * @OA\Schema(
 *      title="Proxy request",
 *      description="request body data",
 *      type="object",
 * )
 */
class ProxyRequest
{
    /**
     * @OA\Property(
     *      title="type",
     *      example="Socks5"
     * )
     *
     * @var string
     */
    public $type;

    /**
     * @OA\Property(
     *      title="ip",
     *      example="72.49.49.11"
     * )
     *
     * @var string
     */
    public $ip;

    /**
     * @OA\Property(
     *      title="port",
     *      example="3234"
     * )
     *
     * @var string
     */
    public $port;

}
