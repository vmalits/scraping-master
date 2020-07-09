<?php


namespace App\Virtual;

/**
 * @OA\Schema(
 *      title="Register request",
 *      description="request body data",
 *      type="object",
 * )
 */
class RegisterRequest
{
    /**
     * @OA\Property(
     *      title="first_name",
     *      example="John"
     * )
     *
     * @var string
     */
    public $first_name;

    /**
     * @OA\Property(
     *      title="last_name",
     *      example="White"
     * )
     *
     * @var string
     */
    public $last_name;

    /**
     * @OA\Property(
     *      title="username",
     *      example="john_white"
     * )
     *
     * @var string
     */
    public $username;

    /**
     * @OA\Property(
     *      title="email",
     *      example="john_white@gmail.com"
     * )
     *
     * @var string
     */
    public $email;

    /**
     * @OA\Property(
     *      title="password",
     *      example="password"
     * )
     *
     * @var string
     */
    public $password;

    /**
     * @OA\Property(
     *      title="password_confirmation",
     *      example="password"
     * )
     *
     * @var string
     */
    public $password_confirmation;
}
