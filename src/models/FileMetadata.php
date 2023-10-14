<?php

namespace User\TestTaskPhpDownloadFiles\models;

/**
 * Class FileMetadata
 * Represents metadata information for a file.
 */
class FileMetadata
{
    private int $userId;
    private string $fileName;
    private string $fileType;
    private string $size;
    private int $timestamp;

    /**
     * FileMetadata constructor.
     * Initializes a new instance of the FileMetadata class.
     */
    public function __construct()
    {
    }

    /**
     * Get the user ID associated with the file.
     *
     * @return int The user ID.
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * Set the user ID associated with the file.
     *
     * @param int $userId The user ID.
     */
    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }

    /**
     * Get the name of the file.
     *
     * @return string The file name.
     */
    public function getFileName(): string
    {
        return $this->fileName;
    }

    /**
     * Set the name of the file.
     *
     * @param string $fileName The file name.
     */
    public function setFileName(string $fileName): void
    {
        $this->fileName = $fileName;
    }

    /**
     * Get the file type or MIME type.
     *
     * @return string The file type.
     */
    public function getFileType(): string
    {
        return $this->fileType;
    }

    /**
     * Set the file type or MIME type.
     *
     * @param string $fileType The file type.
     */
    public function setFileType(string $fileType): void
    {
        $this->fileType = $fileType;
    }

    /**
     * Get the size of the file.
     *
     * @return string The file size.
     */
    public function getSize(): string
    {
        return $this->size;
    }

    /**
     * Set the size of the file.
     *
     * @param string $size The file size.
     */
    public function setSize(string $size): void
    {
        $this->size = $size;
    }

    /**
     * Get the timestamp of when the file was created or modified.
     *
     * @return int The file timestamp.
     */
    public function getTimestamp(): int
    {
        return $this->timestamp;
    }

    /**
     * Set the timestamp of when the file was created or modified.
     *
     * @param int $timestamp The file timestamp.
     */
    public function setTimestamp(int $timestamp): void
    {
        $this->timestamp = $timestamp;
    }
}
