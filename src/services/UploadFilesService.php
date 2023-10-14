<?php

namespace User\TestTaskPhpDownloadFiles\services;

use User\TestTaskPhpDownloadFiles\models\FileMetadata;
use User\TestTaskPhpDownloadFiles\repository\UploadFilesRepository;

class UploadFilesService
{
    private UploadFilesRepository $fileRepository;

    public function __construct(UploadFilesRepository $fileRepository)
    {
        $this->fileRepository = $fileRepository;
    }

    public function uploadFiles(int $userId, array $uploadedFiles): bool
    {
        foreach ($uploadedFiles as $fileData) {
            $metadata = new FileMetadata();
            $metadata->setUserId($userId);
            $metadata->setFileName($fileData['name']);
            $metadata->setFileType($fileData['type']);
            $metadata->setSize($fileData['size']);
            $metadata->setTimestamp(time());
            $isFilesSaved = $this->fileRepository->save($fileData['tmp_name'], $metadata);
            if (!$isFilesSaved) {
                return false;
            }
        }
        return true;
    }
}