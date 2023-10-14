<?php

namespace User\TestTaskPhpDownloadFiles\models;

/**
 * Class User
 * Represents a user entity.
 */
class User
{
    /**
     * @var int The user's ID.
     */
    private int $id;

    /**
     * @var string The user's email address.
     */
    private string $email;

    /**
     * @var string The user's password.
     */
    private string $password;

    /**
     * User constructor.
     *
     * @param int $id The user's ID (default is 0).
     * @param string $email The user's email address (default is an empty string).
     * @param string $password The user's password (default is an empty string).
     */
    public function __construct(int $id = 0, string $email = '', string $password = '')
    {
        $this->id = $id;
        $this->email = $email;
        $this->password = $password;
    }

    /**
     * Get the user's ID.
     *
     * @return int The user's ID.
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Set the user's ID.
     *
     * @param int $id The user's ID.
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * Get the user's email address.
     *
     * @return string The user's email address.
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * Set the user's email address.
     *
     * @param string $email The user's email address.
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * Get the user's password.
     *
     * @return string The user's password.
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * Set the user's password.
     *
     * @param string $password The user's password.
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }
}