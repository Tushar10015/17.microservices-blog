<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class ApiException extends Exception
{
    /**
     * HTTP status code for the response
     *
     * @var int
     */
    protected $statusCode;

    /**
     * Additional error data
     *
     * @var array
     */
    protected $errors = [];

    /**
     * Create a new API exception instance.
     *
     * @param string $message
     * @param int $statusCode
     * @param array $errors
     * @param int $code
     * @param \Throwable|null $previous
     * @return void
     */
    public function __construct(
        string $message = 'An error occurred',
        int $statusCode = Response::HTTP_INTERNAL_SERVER_ERROR,
        array $errors = [],
        int $code = 0,
        \Throwable $previous = null
    ) {
        $this->statusCode = $statusCode;
        $this->errors = $errors;

        parent::__construct($message, $code, $previous);
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
            'status' => $this->statusCode,
        ];

        if (!empty($this->errors)) {
            $response['errors'] = $this->errors;
        }

        if (config('app.debug')) {
            $response['debug'] = [
                'exception' => get_class($this),
                'file' => $this->getFile(),
                'line' => $this->getLine(),
                'trace' => $this->getTrace(),
            ];
        }

        return response()->json($response, $this->statusCode);
    }

    /**
     * Get the HTTP status code
     *
     * @return int
     */
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    /**
     * Get the errors
     *
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }

    /**
     * Create a 400 Bad Request exception.
     *
     * @param string $message
     * @param array $errors
     * @return static
     */
    public static function badRequest(string $message = 'Bad Request', array $errors = []): self
    {
        return new static($message, Response::HTTP_BAD_REQUEST, $errors);
    }

    /**
     * Create a 401 Unauthorized exception.
     *
     * @param string $message
     * @param array $errors
     * @return static
     */
    public static function unauthorized(string $message = 'Unauthorized', array $errors = []): self
    {
        return new static($message, Response::HTTP_UNAUTHORIZED, $errors);
    }

    /**
     * Create a 403 Forbidden exception.
     *
     * @param string $message
     * @param array $errors
     * @return static
     */
    public static function forbidden(string $message = 'Forbidden', array $errors = []): self
    {
        return new static($message, Response::HTTP_FORBIDDEN, $errors);
    }

    /**
     * Create a 404 Not Found exception.
     *
     * @param string $message
     * @param array $errors
     * @return static
     */
    public static function notFound(string $message = 'Not Found', array $errors = []): self
    {
        return new static($message, Response::HTTP_NOT_FOUND, $errors);
    }

    /**
     * Create a 422 Unprocessable Entity exception.
     *
     * @param string $message
     * @param array $errors
     * @return static
     */
    public static function unprocessableEntity(string $message = 'Unprocessable Entity', array $errors = []): self
    {
        return new static($message, Response::HTTP_UNPROCESSABLE_ENTITY, $errors);
    }

    /**
     * Create a 500 Internal Server Error exception.
     *
     * @param string $message
     * @param array $errors
     * @return static
     */
    public static function internalServerError(string $message = 'Internal Server Error', array $errors = []): self
    {
        return new static($message, Response::HTTP_INTERNAL_SERVER_ERROR, $errors);
    }
}



// Throw a simple exception
// throw new ApiException('Resource not found', 404);

// Use helper methods
// throw ApiException::notFound('User not found');

// With additional error details
// throw ApiException::badRequest('Invalid input', ['email' => 'Email is invalid']);

// In a try-catch block
/* try {
    
} catch (Exception $e) {
    throw new ApiException($e->getMessage(), 500);
} */