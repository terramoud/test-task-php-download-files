<?php

namespace User\TestTaskPhpDownloadFiles\repository;

use User\TestTaskPhpDownloadFiles\models\FileMetadata;
use User\TestTaskPhpDownloadFiles\Paths;
use User\TestTaskPhpDownloadFiles\utils\Logger;

/**
 * Class UploadFilesRepository
 *
 * This class is responsible for managing the storage of
 * uploaded files and their associated metadata.
 *
 * @package User\TestTaskPhpDownloadFiles\repository
 */

class UploadFilesRepository
{
    /**
     * @var Logger The logger instance for logging information.
     */
    private Logger $logger;

    /**
     * Initializes a new instance of the repository and sets up the logger.
     */
    public function __construct()
    {
        $this->logger = new Logger(__CLASS__);
    }

    /**
     * Save an uploaded file with its associated metadata.
     *
     * @param mixed $file The file to be saved.
     * @param FileMetadata $metadata The metadata associated with the file.
     *
     * @return bool Returns true if the file and metadata were successfully saved, or false on failure.
     */
    public function save(mixed $file, FileMetadata $metadata): bool
    {
        $userId = $metadata->getUserId();
        $targetDirectory = PATHS::FILE_STORAGE_DIR . $userId;
        if (!file_exists($targetDirectory)) {
            mkdir($targetDirectory, 0777, true);
        }
        $filename = $metadata->getFileName();
        $filePath = "$targetDirectory/$filename";
        if (move_uploaded_file($file, $filePath) && $this->updateMetadata($metadata)) {
            $this->logger->log("File '$filename' uploaded successfully");
            return true;
        }
        $this->logger->log("Upload of file '$filename' failed.");
        return false;
    }

    /**
     * Update the metadata information about a saved file.
     *
     * @param FileMetadata $fileMetadata The metadata for the saved file.
     *
     * @return bool Returns true if the metadata is successfully updated, or false on failure.
     */
    public function updateMetadata(FileMetadata $fileMetadata): bool
    {
        try {
            if (!file_exists(dirname(Paths::METADATA_PATH))) {
                mkdir(dirname(Paths::METADATA_PATH), 0777, true);
            }
            $userId = $fileMetadata->getUserId();
            $metadata = [];
            if (file_exists(Paths::METADATA_PATH)) {
                $metadata = json_decode(file_get_contents(Paths::METADATA_PATH), true);
            }
            if (!isset($metadata[$userId])) {
                $metadata[$userId] = [];
            }
            $fileName = $fileMetadata->getFileName();
            $metadata[$userId][$fileName] = [
                'user_id' => $fileMetadata->getUserId(),
                'file_name' => $fileName,
                'filetype' => $fileMetadata->getFileType(),
                'size' => $fileMetadata->getSize(),
                'timestamp' => $fileMetadata->getTimestamp(),
            ];
            file_put_contents(Paths::METADATA_PATH, json_encode($metadata, JSON_PRETTY_PRINT));
            return true;
        } catch (\Exception $e) {
            $this->logger->log("Unable to update data about saved files. $e");
            return false;
        }
    }
}