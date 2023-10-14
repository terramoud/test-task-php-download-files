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
 * The UserService class provides user authentication functionality
 * and interacts with the UserRepository.
 *
 * @package User\TestTaskPhpDownloadFiles\services
 */
class UserService
{
    /**
     * @var UserRepository The user repository for database interactions.
     */
    private UserRepository $userRepository;

    /**
     * @var Logger The logger instance for logging information.
     */
    private Logger $logger;

    /**
     * UserService constructor.
     *
     * Initializes a new instance of the UserService and sets up the logger and user repository.
     *
     * @param UserRepository $userRepository The user repository for database interactions.
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->logger = new Logger(__CLASS__);
        $this->userRepository = $userRepository;
    }

    /**
     * Authenticate a user based on the provided user authentication data.
     *
     * @param UserAuthDTO $userDTO The user authentication data.
     *
     * @return User|null Returns a User instance if authentication is successful, or null if authentication fails.
     */
    public function authenticateUser(UserAuthDTO $userDTO): ?User
    {
        try {
            if (filter_var($userDTO->getEmail(), FILTER_VALIDATE_EMAIL)) {
                $this->logger->log("Email is invalid");
                return null;
            }
            $user = $this->userRepository->findByEmail($userDTO->getEmail());
//        if (password_verify($userDTO->getPassword(), $user->getPassword())) {
            if ($userDTO->getPassword() !== $user->getPassword()) {
                $this->logger->log("Password is invalid");
                return null;
            }
            $this->logger->log("The user is successfully authorized");
            return $user;
        } catch (DatabaseException $e) {
            $this->logger->log('Error with user authorization: ' . $e->getMessage());
            return null;
        } catch (\Exception $e) {
            $this->logger->log($e);
            return null;
        }
    }
}
