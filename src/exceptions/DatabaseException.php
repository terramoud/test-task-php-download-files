<?php

namespace User\TestTaskPhpDownloadFiles\exceptions;

use Exception;
use Throwable;

/**
 * Custom exception class for handling database-related errors.
 *
 * This exception can be used to catch and handle exceptions related to database operations.
 * It extends the base Exception class and provides a customizable message and error code.
 *
 * @package User\TestTaskPhpDownloadFiles\exceptions
 */
class DatabaseException extends Exception
{
    /**
     * Constructor for DatabaseException.
     *
     * @param string $message     A custom error message describing the database error.
     * @param int    $code        An optional error code. Default is 0.
     * @param Throwable|null $previous An optional previous exception for chaining. Default is null.
     */
    public function __construct($message = 'Database error', $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
