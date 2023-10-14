<?php

namespace User\TestTaskPhpDownloadFiles\controllers;

use User\TestTaskPhpDownloadFiles\services\UploadFilesService;
use User\TestTaskPhpDownloadFiles\utils\Logger;

class UploadFilesController
{
    private const NO_FILES_SELECTED_FOR_UPLOAD = 'No files selected for upload.';
    private const FILES_UPLOADED_SUCCESSFULLY = "Files uploaded successfully";
    private const ERROR_UPLOADING_FILES = "Error uploading files";
    private const USER_IS_NOT_AUTHORIZED = 'User is not logged in. Please log in before uploading files.';
    private Logger $logger;
    private UploadFilesService $uploadFilesService;

    public function __construct(UploadFilesService $uploadFilesService)
    {
        $this->logger = new Logger(__CLASS__);
        $this->uploadFilesService = $uploadFilesService;
    }

    public function uploadFiles(): void
    {
        if (!isset($_GET['user_id']) || !$_GET['user_id']) {
            $this->logger->log(self::USER_IS_NOT_AUTHORIZED);
            echo json_encode(['success' => false, 'message' => self::USER_IS_NOT_AUTHORIZED]);
            return;
        }
        $this->logger->log("SESSION " . print_r($_SESSION, true));
        if (empty($_FILES)) {
            $this->logger->log(self::NO_FILES_SELECTED_FOR_UPLOAD);
            echo json_encode(['success' => false, 'message' => self::NO_FILES_SELECTED_FOR_UPLOAD]);
            return;
        }
        if ($this->uploadFilesService->uploadFiles($_GET['user_id'], $_FILES)) {
            $this->logger->log(self::FILES_UPLOADED_SUCCESSFULLY);
            echo json_encode(['success' => true, 'message' => self::FILES_UPLOADED_SUCCESSFULLY]);
            return;
        }
        $this->logger->log(self::ERROR_UPLOADING_FILES);
        echo json_encode(['success' => false, 'message' => self::ERROR_UPLOADING_FILES]);
    }
}