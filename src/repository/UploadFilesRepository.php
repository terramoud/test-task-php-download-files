<?php

namespace User\TestTaskPhpDownloadFiles\repository;

use User\TestTaskPhpDownloadFiles\models\FileMetadata;
use User\TestTaskPhpDownloadFiles\Paths;
use User\TestTaskPhpDownloadFiles\utils\Logger;

class UploadFilesRepository
{
    private Logger $logger;

    public function __construct()
    {
        $this->logger = new Logger(__CLASS__);
    }

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

    public function updateMetadata(FileMetadata $fileMetadata): bool
    {
        try {
            $userId = $fileMetadata->getUserId();
            $metadata = json_decode(file_get_contents(Paths::METADATA_PATH), true);
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