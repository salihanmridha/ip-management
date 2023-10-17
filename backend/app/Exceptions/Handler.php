<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use Symfony\Component\ErrorHandler\Error\FatalError;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\Routing\Exception\RouteNotFoundException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->renderable(function (NotFoundHttpException $exception, Request $request) {
            if ($request->wantsJson()) {
                return response()->json([
                    'status'  => Response::HTTP_NOT_FOUND,
                    'success' => false,
                    'message' => $exception->getMessage(),
                ], Response::HTTP_NOT_FOUND);
            }
        });

        $this->renderable(function (\Error $exception, Request $request) {
            if ($request->wantsJson()) {
                return response()->json([
                    'status'  => Response::HTTP_INTERNAL_SERVER_ERROR,
                    'success' => false,
                    'message' => "Sorry! We are unable to process your request at this moment. Try again later",
                ], Response::HTTP_INTERNAL_SERVER_ERROR);
            }
        });

        $this->renderable(function (\ErrorException $exception, Request $request) {
            if ($request->wantsJson()) {
                return response()->json([
                    'status'  => Response::HTTP_INTERNAL_SERVER_ERROR,
                    'success' => false,
                    'message' => "Sorry! We are unable to process your request at this moment. Try again later",
                ], Response::HTTP_INTERNAL_SERVER_ERROR);
            }
        });

        $this->renderable(function (FatalError $exception, Request $request) {
            if ($request->wantsJson()) {
                return response()->json([
                    'status'  => Response::HTTP_INTERNAL_SERVER_ERROR,
                    'success' => false,
                    'message' => "Sorry! We are unable to process your request at this moment. Try again later",
                ], Response::HTTP_INTERNAL_SERVER_ERROR);
            }
        });

        $this->renderable(function (QueryException $exception, Request $request) {
            if ($request->wantsJson()) {
                return response()->json([
                    'status'  => Response::HTTP_INTERNAL_SERVER_ERROR,
                    'success' => false,
                    'message' => "A database query error occurred. Please check your data or try again later.",
                ], Response::HTTP_INTERNAL_SERVER_ERROR);
            }
        });

        $this->renderable(function (ValidationException $exception, Request $request) {
            if ($request->wantsJson()) {
                return response()->json([
                    'status'  => Response::HTTP_UNPROCESSABLE_ENTITY,
                    'success' => false,
                    'message' => $exception->getMessage(),
                    'errors'  => $exception->errors()
                ], Response::HTTP_UNPROCESSABLE_ENTITY);
            }
        });

        $this->renderable(function (ModelNotFoundException $exception, Request $request) {
            if ($request->wantsJson()) {
                return response()->json([
                    'status'  => Response::HTTP_NOT_FOUND,
                    'success' => false,
                    'message' => "Resource not found!",
                ], Response::HTTP_NOT_FOUND);
            }
        });

        $this->renderable(function (\BadMethodCallException $exception, Request $request) {
            if ($request->wantsJson()) {
                return response()->json([
                    'status'  => Response::HTTP_INTERNAL_SERVER_ERROR,
                    'success' => false,
                    'message' => "Method not found!",
                ], Response::HTTP_INTERNAL_SERVER_ERROR);
            }
        });
    }
}
