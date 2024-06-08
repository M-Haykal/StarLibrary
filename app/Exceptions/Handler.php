<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $exception)
    {
        if ($this->isHttpException($exception)) {
            $statusCode = $exception->getStatusCode();
            $message = $this->getErrorMessage($statusCode);
            if (view()->exists("errors.error")) {
                return response()->view("errors.error", [
                    'statusCode' => $statusCode,
                    'message' => $message
                ], $statusCode);
            }
        }
        return parent::render($request, $exception);
    }

    protected function getErrorMessage($statusCode)
    {
        switch ($statusCode) {
            case 404:
                return "you_spelt_it_wrong";
            case 403:
                return "do_not_have_permission";
            case 500:
                return "unexpected_error_has_occurred_on_the_server.";
            case 405:
                return "the_requested_method_is_not_allowed.";
            default:
                return "an_error_has_occurred.";
        }
    }
}
