<?php

namespace User\TestTaskPhpDownloadFiles\services;

use User\TestTaskPhpDownloadFiles\models\FileMetadata;
use User\TestTaskPhpDownloadFiles\repository\UploadFilesRepository;


/**
 * Class UploadFilesService
 *
 * This class is responsible for handling the uploading of files and their associated metadata.
 * It utilizes a provided UploadFilesRepository to manage file storage.
 *
 * @package User\TestTaskPhpDownloadFiles\services
 */
class UploadFilesService
{
    /**
     * @var UploadFilesRepository The repository used for file storage.
     */
    private UploadFilesRepository $fileRepository;


    /**
     * UploadFilesService constructor.
     *
     * @param UploadFilesRepository $fileRepository The repository used for file storage.
     */
    public function __construct(UploadFilesRepository $fileRepository)
    {
        $this->fileRepository = $fileRepository;
    }

    /**
     * Upload multiple files and their associated metadata.
     *
     * @param int $userId The user ID associated with the uploaded files.
     * @param array $uploadedFiles An array of file data to be uploaded.
     *
     * @return bool Returns true if all files were successfully uploaded, or false if any failed.
     */
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