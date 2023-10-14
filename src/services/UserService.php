<?php

namespace User\TestTaskPhpDownloadFiles\services;

use User\TestTaskPhpDownloadFiles\exceptions\DatabaseException;
use User\TestTaskPhpDownloadFiles\dto\UserAuthDTO;
use User\TestTaskPhpDownloadFiles\models\User;
use User\TestTaskPhpDownloadFiles\repository\UserRepository;
use User\TestTaskPhpDownloadFiles\utils\Logger;

/**
 * Class UserService
 *
 * This class provides services for user registration and retrieval.
 */
class UserService
{
    private UserRepository $userRepository;
    private Logger $logger;

    /**
     * UserService constructor.
     *
     * Initializes the UserService with a UserRepository and a Logger.
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->logger = new Logger(__CLASS__);
        $this->userRepository = $userRepository;
    }

    public function authenticateUser(UserAuthDTO $userDTO): ?User
    {
        if (filter_var($userDTO->getEmail(), FILTER_VALIDATE_EMAIL)) {
            $this->logger->log("Email is invalid");
            return null;
        }
        try {
            $user = $this->userRepository->findByEmail($userDTO->getEmail());
        } catch (DatabaseException $e) {
            $this->logger->log('Error with user authorization: ' . $e->getMessage());
            return null;
        }
//        if (password_verify($userDTO->getPassword(), $user->getPassword())) {
        if ($userDTO->getPassword() !== $user->getPassword()) {
            $this->logger->log("Password is invalid");
            return null;
        }
        $this->logger->log("The user is successfully authorized");
        return $user;
    }
}
