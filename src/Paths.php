<?php

namespace User\TestTaskPhpDownloadFiles;

/**
 * Class Paths
 *
 * This class defines various file paths used in the application.
 */
class Paths
{
    /**
     * Path to the register view.
     */
    const HOME_VIEW = PROJECT_ROOT . '/src/views/home.php';

    /**
     * Path to the list users view.
     */
    const LOGIN_VIEW = PROJECT_ROOT . '/src/views/login.php';

    /**
     * Path to the log file.
     */
    const LOG_FILE = PROJECT_ROOT . '/logs/file.log';

    const METADATA_PATH = PROJECT_ROOT . '/storage/metadata.json';
    const FILE_STORAGE_DIR = PROJECT_ROOT . '/storage/files/';

    const ROOT_ROUTE = '/';
    const HOME_ROUTE = '/home';
    const LOGIN_ROUTE = '/login';
    const SEND_DATA_ROUTE = "/send-data";
    const HANDLE_UPLOAD_ROUTE = "/handle-upload";
}