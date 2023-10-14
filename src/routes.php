<?php

namespace User\TestTaskPhpDownloadFiles;


use PDO;
use PDOException;
use User\TestTaskPhpDownloadFiles\controllers\DefaultController;
use User\TestTaskPhpDownloadFiles\controllers\FileTransferController;
use User\TestTaskPhpDownloadFiles\controllers\UploadFilesController;
use User\TestTaskPhpDownloadFiles\controllers\UserController;
use User\TestTaskPhpDownloadFiles\repository\UploadFilesRepository;
use User\TestTaskPhpDownloadFiles\repository\UserRepository;
use User\TestTaskPhpDownloadFiles\services\FileTransferService;
use User\TestTaskPhpDownloadFiles\services\UploadFilesService;
use User\TestTaskPhpDownloadFiles\services\UserService;
use User\TestTaskPhpDownloadFiles\utils\Logger;

$logger = new Logger("routes.php");
$userController = initUserController();
$uploadFilesController = new UploadFilesController(new UploadFilesService(new UploadFilesRepository()));
$fileTransferController = new FileTransferController(new FileTransferService());

$routes = [
    Paths::ROOT_ROUTE => ['controller' => $userController, 'action' => 'login'],
    Paths::LOGIN_ROUTE => ['controller' => $userController, 'action' => 'login'],
    Paths::HOME_ROUTE => ['controller' => new DefaultController(), 'action' => 'homePage'],
    Paths::SEND_DATA_ROUTE => ['controller' => $fileTransferController, 'action' => 'transferFiles'],
    Paths::HANDLE_UPLOAD_ROUTE => ['controller' => $uploadFilesController, 'action' => 'uploadFiles'],
];
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
if (array_key_exists($path, $routes)) {
    $route = $routes[$path];
    $controller = $route['controller'];
    $action = $route['action'];
    $controller->$action();
    exit();
}
$logger->log("Route: '$path' response: 404 Page Not Found");
header('HTTP/1.1 404 Not Found');
echo '404 Page Not Found';

function initUserController()
{
    global $logger;
    try {
        $pdo = new PDO(MySQLConfig::DATA_SOURCE,MySQLConfig::USERNAME, MySQLConfig::PASSWORD);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        $logger->log($e);
        die("Connection failed: " . $e->getMessage());
    }
    $userRepository = new UserRepository($pdo);
    $userService = new UserService($userRepository);
    return new UserController($userService);
}

?>
