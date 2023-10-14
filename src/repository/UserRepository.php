<?php

namespace User\TestTaskPhpDownloadFiles\repository;

use PDO;
use PDOException;
use User\TestTaskPhpDownloadFiles\exceptions\DatabaseException;
use User\TestTaskPhpDownloadFiles\models\User;
use User\TestTaskPhpDownloadFiles\utils\Logger;

/**
 * Class UserRepository
 *
 * A class for managing user data in a session-based database.
 *
 * @package User\TestTaskPhpDownloadFiles\repository
 */
class UserRepository
{
    const SQL_GET_USER_BY_EMAIL = 'SELECT id, email, password FROM users WHERE email = :email';
    private PDO $pdo;
    private Logger $logger;

    /**
     * UserRepository constructor.
     *
     * Initializes the UserRepository and creates a session if it doesn't exist.
     */
    public function __construct(PDO $pdo)
    {
        $this->logger = new Logger(__CLASS__);
        $this->pdo = $pdo;
    }

    /**
     * @throws DatabaseException
     */
    public function findByEmail(string $email): ?User
    {
        try {
            $stmt = $this->pdo->prepare(self::SQL_GET_USER_BY_EMAIL);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if (!$row) {
                $this->logger->log("Cannot find user with email: $email");
                throw new DatabaseException("Cannot find user with email: $email");
            }
            $user = new User();
            $user->setId($row['id']);
            $user->setEmail($row['email']);
            $user->setPassword($row['password']);
            return $user;
        } catch (PDOException $e) {
            $this->logger->log('Error fetching user data: ' . $e->getMessage());
            throw new DatabaseException('Error fetching user data: ' . $e->getMessage());
        }
    }
}