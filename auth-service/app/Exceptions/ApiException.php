<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class ApiException extends Exception
{
    /**
     * The error code for the response.
     *
     * @var string
     */
    protected $errorCode;

    /**
     * The HTTP status code for the response.
     *
     * @var int
     */
    protected $statusCode;

    /**
     * Additional error data.
     *
     * @var array
     */
    protected $errors = [];

    /**
     * Create a new API exception instance.
     *
     * @param string $message
     * @param string $errorCode
     * @param int $statusCode
     * @param array $errors
     * @param \Throwable|null $previous
     */
    public function __construct(
        string $message = 'An error occurred',
        string $errorCode = 'internal_error',
        int $statusCode = Response::HTTP_INTERNAL_SERVER_ERROR,
        array $errors = [],
        ?\Throwable $previous = null
    ) {
        parent::__construct($message, $statusCode, $previous);
        $this->errorCode = $errorCode;
        $this->statusCode = $statusCode;
        $this->errors = $errors;
    }

    /**
     * Render the exception as an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function render($request): JsonResponse
    {
        $response = [
            'success' => false,
            'message' => $this->getMessage(),
            'error_code' => $this->errorCode,
        ];

        if (config('app.debug')) {
            $response['debug'] = [
                'exception' => get_class($this),
                'file' => $this->getFile(),
                'line' => $this->getLine(),
                'trace' => $this->getTrace(),
            ];
        }

        if (!empty($this->errors)) {
            $response['errors'] = $this->errors;
        }

        return response()->json($response, $this->getStatusCode());
    }

    /**
     * Get the error code.
     *
     * @return string
     */
    public function getErrorCode(): string
    {
        return $this->errorCode;
    }

    /**
     * Get the HTTP status code.
     *
     * @return int
     */
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    /**
     * Get the errors.
     *
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }

    /**
     * Report the exception.
     *
     * @return void
     */
    public function report()
    {
        Log::error($this->getMessage(), [
            'exception' => get_class($this),
            'error_code' => $this->errorCode,
            'status_code' => $this->statusCode,
            'file' => $this->getFile(),
            'line' => $this->getLine(),
            'trace' => $this->getTraceAsString(),
        ]);
    }

    /**
     * Create a validation error response.
     *
     * @param array $errors
     * @param string $message
     * @return static
     */
    public static function validationError(array $errors, string $message = 'Validation failed'): self
    {
        return new static(
            $message,
            'validation_error',
            Response::HTTP_UNPROCESSABLE_ENTITY,
            $errors
        );
    }

    /**
     * Create a not found error response.
     *
     * @param string $message
     * @return static
     */
    public static function notFound(string $message = 'Resource not found'): self
    {
        return new static($message, 'not_found', Response::HTTP_NOT_FOUND);
    }

    /**
     * Create an unauthorized error response.
     *
     * @param string $message
     * @return static
     */
    public static function unauthorized(string $message = 'Unauthorized'): self
    {
        return new static($message, 'unauthorized', Response::HTTP_UNAUTHORIZED);
    }

    /**
     * Create a forbidden error response.
     *
     * @param string $message
     * @return static
     */
    public static function forbidden(string $message = 'Forbidden'): self
    {
        return new static($message, 'forbidden', Response::HTTP_FORBIDDEN);
    }

    /**
     * Create a bad request error response.
     *
     * @param string $message
     * @param array $errors
     * @return static
     */
    public static function badRequest(string $message = 'Bad request', array $errors = []): self
    {
        return new static($message, 'bad_request', Response::HTTP_BAD_REQUEST, $errors);
    }
}
