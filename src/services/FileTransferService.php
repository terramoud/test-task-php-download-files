<?php

namespace User\TestTaskPhpDownloadFiles\services;

use CURLFile;
use User\TestTaskPhpDownloadFiles\Paths;
use User\TestTaskPhpDownloadFiles\utils\Logger;

/**
 * Class FileTransferService
 *
 * This class handles file transfers and provides methods
 * to upload files securely using cURL.
 */
class FileTransferService
{
    private const MAX_NUMBER_DOCUMENTS = 3;
    private const MAX_NUMBER_IMAGES = 4;
    private const MAX_NUMBER_DOCUMENTS_ERROR_MESSAGE = 'The maximum number of documents that can be downloaded has been exceeded!';
    private const MAX_NUMBER_IMAGES_ERROR_MESSAGE = 'The maximum number of images that can be downloaded has been exceeded!';
    private const INVALID_FILE_TYPE = "Invalid file type. Only the following file types are allowed: PDF, DOC, DOCX, TXT, JPG, JPEG, PNG, GIF.";
    private const UPLOAD_ERROR_MESSAGE = 'Error during uploading files. Try again.';
    private Logger $logger;

    /**
     * FileTransferService constructor.
     *
     * Initializes a new FileTransferService instance.
     */
    public function __construct()
    {
        $this->logger = new Logger(__CLASS__);
    }

    /**
     * Transfer files securely to the server using cURL.
     * This method checks if the user is authorized, validates the uploaded files,
     * and transfers them securely to the server using cURL.
     *
     * @param int $userId The user ID for the file transfer.
     * @param array $listDocuments An array of uploaded document files.
     * @param array $listImages An array of uploaded image files.
     *
     * @return false|string JSON-encoded response indicating success or an error message.
     */
    public function transferFilesByCurl(int $userId, array $listDocuments, array $listImages): false|string
    {
        if (count($listDocuments['tmp_name']) > self::MAX_NUMBER_DOCUMENTS) {
            $this->logger->log(self::MAX_NUMBER_DOCUMENTS_ERROR_MESSAGE);
            return json_encode(['success' => false, 'message' => self::MAX_NUMBER_DOCUMENTS_ERROR_MESSAGE]);
        }
        if (count($listImages['tmp_name']) > self::MAX_NUMBER_IMAGES) {
            $this->logger->log(self::MAX_NUMBER_IMAGES_ERROR_MESSAGE);
            return json_encode(['success' => false, 'message' => self::MAX_NUMBER_IMAGES_ERROR_MESSAGE]);
        }
        $files = $this->convertListFilesToCURLFilesObjects($listDocuments);
        $files = array_merge($files, $this->convertListFilesToCURLFilesObjects($listImages));
        if (!$this->isFilesValidByType($files)) {
            $this->logger->log(self::INVALID_FILE_TYPE);
            return json_encode(['success' => false, 'message' => self::INVALID_FILE_TYPE]);
        }
        $ch = curl_init();
        $url = "http://{$_SERVER['HTTP_HOST']}" . Paths::HANDLE_UPLOAD_ROUTE . "?user_id=$userId";
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $files);
        curl_setopt($ch, CURLOPT_TIMEOUT, 2);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 1);
        $response = curl_exec($ch);
        if (curl_errno($ch)) {
            $this->logger->log(self::UPLOAD_ERROR_MESSAGE);
            return json_encode(['success' => false, 'message' => self::UPLOAD_ERROR_MESSAGE]);
        }
        curl_close($ch);
        return $response;
    }

    /**
     * Validate uploaded files by MIME type.
     * This method checks if the uploaded files are of valid MIME types.
     *
     * @param array $files An array of cURL file objects.
     *
     * @return bool True if all files are of valid MIME types, false otherwise.
     */
    private function isFilesValidByType(array $files): bool
    {
        foreach ($files as $file) {
            if ($file->mime !== 'application/pdf' &&
                $file->mime !== 'application/msword' &&
                $file->mime !== 'application/vnd.openxmlformats-officedocument.wordprocessingml.document' &&
                $file->mime !== 'text/plain' &&
                $file->mime !== 'image/jpeg' &&
                $file->mime !== 'image/jpg' &&
                $file->mime !== 'image/png' &&
                $file->mime !== 'image/gif') {
                return false;
            }
        }
        return true;
    }

    /**
     * Convert a list of uploaded files to cURL file objects.
     * This method converts a list of uploaded files to cURL file
     * objects for use in cURL POST requests.
     *
     * @param array $listFiles An array of uploaded files.
     *
     * @return array An array of cURL file objects.
     */
    private function convertListFilesToCURLFilesObjects(array $listFiles): array
    {
        $curlObjects = [];
        foreach ($listFiles['name'] as $key => $value) {
            $tmp_name = $listFiles['tmp_name'][$key];
            $type = $listFiles['type'][$key];
            $name = $listFiles['name'][$key];
            $curlObjects[] = new CURLFile($tmp_name, $type, $name);
        }
        return $curlObjects;
    }
}