<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * @OA\Info(
 *      version="1.0.0",
 *      title="IP Management OpenApi Documentation",
 *      description="IP Management application swagger/openapi documentation",
 *      @OA\Contact(
 *          email="salihanmridha@gmail.com"
 *      ),
 * )
 *
 * @OA\Server(
 *      url=L5_SWAGGER_CONST_HOST,
 *      description="IP Management Server For Common"
 * )
 * @OA\Server(
 *      url=L5_SWAGGER_CONST_HOST_COMMON_IP,
 *      description="IP Management Server For Common IP"
 * )
 * @OA\Server(
 *      url=L5_SWAGGER_CONST_HOST_COMMON,
 *      description="IP Management Server"
 * )
 *
 * @OA\SecurityScheme(
 *     securityScheme="sanctum",
 *     type="http",
 *     scheme="bearer",
 * )
 *
 */
class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
}
