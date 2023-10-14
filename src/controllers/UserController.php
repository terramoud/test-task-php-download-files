<?php

namespace User\TestTaskPhpDownloadFiles\controllers;


use User\TestTaskPhpDownloadFiles\dto\UserAuthDTO;
use User\TestTaskPhpDownloadFiles\Paths;
use User\TestTaskPhpDownloadFiles\services\UserService;
use User\TestTaskPhpDownloadFiles\utils\Logger;

/**
 * Class UserController
 *
 * This class handles user-related actions in the application.
 */
class UserController
{
    const AUTHENTICATION_FAILED_MESSAGE = 'Authentication failed. Please try again.';
    private UserService $userService;
    private Logger $logger;

    /**
     * UserController constructor.
     *
     * Initializes the UserController with a UserService and a Logger.
     */
    public function __construct(UserService $userService)
    {
        $this->logger = new Logger(__CLASS__);
        $this->userService = $userService;
    }

    /**
     * Handle user authorization.
     */
    public function login(): void
    {
        if (isset($_SESSION['user_id'])) {
            header("Location: ". Paths::HOME_ROUTE);
            return;
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userAuthDTO = new UserAuthDTO(
                $_POST['email'],
                $_POST['password'],
            );
            $user = $this->userService->authenticateUser($userAuthDTO);
            $this->logger->log(print_r($user, true));
            if ($user) {
                $_SESSION['user_id'] = $user->getId();
            }
            $this->renderView((bool) $user);
            exit();
        }
        require_once(Paths::LOGIN_VIEW);
    }

    /**
     * Send an authorization response.
     *
     * @param bool $isSuccess True if registration was successful, false otherwise.
     */
    private function renderView(bool $isSuccess): void
    {
        if ($isSuccess) {
            $this->logger->log('Login successful');
            header("Location: " . Paths::HOME_ROUTE);
            return;
        }
        $this->logger->log('Login failed');
        $submitLoginFormMessage = self::AUTHENTICATION_FAILED_MESSAGE;
        header("Location: " . Paths::LOGIN_ROUTE);
    }
}

