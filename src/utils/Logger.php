<?php

namespace User\TestTaskPhpDownloadFiles\utils;


use User\TestTaskPhpDownloadFiles\Paths;

/**
 * Class Logger
 *
 * This class provides logging functionality for the application.
 */
class Logger
{
    private string $logFilePath;
    private string $className;

    /**
     * Logger constructor.
     *
     * @param string $className The name of the class or component using the logger.
     */
    public function __construct(string $className)
    {
        $this->className = $className;
        $this->logFilePath = Paths::LOG_FILE;
        $this->createLogDirectory();
    }

    /**
     * Log a message.
     *
     * @param mixed $message The message to be logged.
     * @param int $level The log level (default is 3).
     */
    public function log(string $message, int $level = 3): void
    {
        $formattedMessage = $this->formatLogMessage($message);
        error_log($formattedMessage, $level, $this->logFilePath);
    }

    /**
     * Format a log message with a timestamp and class name.
     *
     * @param mixed $message The message to be formatted.
     *
     * @return string The formatted log message.
     */
    protected function formatLogMessage(string $message): string
    {
        return date('Y-m-d H:i:s') . ' [' . $this->className . ']: ' . $message . PHP_EOL;
    }

    /**
     * Create the log directory if it doesn't exist.
     */
    private function createLogDirectory(): void
    {
        $logDirectory = dirname($this->logFilePath);
        if (!is_dir($logDirectory)) {
            mkdir($logDirectory, 0777, true);
        }
    }
}
