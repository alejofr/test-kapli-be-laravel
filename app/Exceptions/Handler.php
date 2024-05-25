<?php

namespace App\Exceptions;

use App\Traits\ApiResponse;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Client\RequestException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    use ApiResponse;
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
        $this->reportable(function (Throwable $e) {
            //
        });
    }

      /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        if( $exception instanceof HttpException ){
            $code = $exception->getStatusCode();
            $message = Response::$statusTexts[$code];

            return $this->errorResponse($message, $code);
        }

        if( $exception instanceof ModelNotFoundException ){
            $model = strtolower(class_basename($exception->getModel()));

            return $this->errorResponse("Does not exit any instance of {$model} with the give id", Response::HTTP_NOT_FOUND);
        }

        if( $exception instanceof AuthorizationException ){
            return $this->errorResponse($exception->getMessage(), Response::HTTP_FORBIDDEN);
        }

        if( $exception instanceof AuthenticationException ){
            return $this->errorResponse($exception->getMessage(), Response::HTTP_UNAUTHORIZED);
        }

        if( $exception instanceof ValidationException ){
            $errors = $exception->validator->errors();

            return $this->errorResponse($errors, Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        if( $exception instanceof RequestException){
            $errors = $exception->response->json();

            return $this->errorResponse($errors, $exception->getCode());
        }

        if( env('APP_DEBUG', false) ){
            return parent::render($request, $exception);
        }


        return $this->errorResponse('Unexpected error. Try later', Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}
