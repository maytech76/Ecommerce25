<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * @OA\Info(
 *     title="MAYDEV Servicio de ingenieria",
 *     version="1.0.0",
 *     description="Documentación de la API E-comerce 2025",
 *     @OA\Contact(
 *         email="soport@maydev.tech"
 *     )
 * )
 *
 * @OA\Server(
 *     url=L5_SWAGGER_CONST_HOST,
 *     description="Servidor local"
 * )
 *
 * @OA\SecurityScheme(
 *     type="http",
 *     description="Usa el token generado tras el login. Formato: Bearer {token}",
 *     name="Authorization",
 *     in="header",
 *     scheme="bearer",
 *     bearerFormat="JWT",
 *     securityScheme="sanctum"
 * )
 */

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
}
