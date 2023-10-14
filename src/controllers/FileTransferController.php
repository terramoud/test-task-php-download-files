<?php

namespace User\TestTaskPhpDownloadFiles\controllers;

use User\TestTaskPhpDownloadFiles\services\FileTransferService;
use User\TestTaskPhpDownloadFiles\utils\Logger;

/**
 * Class FileTransferController
 *
 * This class handles file transfers and provides methods to upload files securely.
 */
class FileTransferController
{
    private const USER_IS_NOT_AUTHORIZED = 'User is not logged in. Please log in before uploading files.';
    private const NO_FILES_SELECTED_FOR_UPLOADS = 'No files selected for uploads.';
    private Logger $logger;
    private FileTransferService $fileTransferService;

    /**
     * FileTransferController constructor.
     *
     * @param FileTransferService $fileTransferService An instance of the FileTransferService for handling file transfers.
     */
    public function __construct(FileTransferService $fileTransferService)
    {
        $this->logger = new Logger(__CLASS__);
        $this->fileTransferService = $fileTransferService;
    }

    /**
     * Transfer files securely to the server.
     *
     * This method checks if the user is authorized, validates the uploaded files, and transfers them securely to the server.
     *
     * @return void
     */
    public function transferFiles(): void
    {
        if (!isset($_SESSION['user_id'])) {
            echo json_encode(['success' => false, 'message' => self::USER_IS_NOT_AUTHORIZED]);
            return;
        }
        if (!empty($_FILES['document_files']['name'][0])) {
            $documentFiles = $_FILES['document_files'];
            $imageFiles = $_FILES['image_files'];
            $this->logger->log('$imageFiles ' . print_r($imageFiles, true));
            echo $this->fileTransferService->transferFilesByCurl($_SESSION['user_id'], $documentFiles, $imageFiles);
            return;
        }
        echo json_encode(['success' => false, 'message' => self::NO_FILES_SELECTED_FOR_UPLOADS]);
    }
}
