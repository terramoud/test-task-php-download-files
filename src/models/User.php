<?php

namespace User\TestTaskPhpDownloadFiles\models;

/**
 * Class User
 *
 * This class represents a user in the application.
 */
class User
{
    private int $id;
    private string $email;
    private string $password;

    /**
     * @param int $id
     * @param string $email
     * @param string $password
     */
    public function __construct(int $id = 0, string $email = '', string $password = '')
    {
        $this->id = $id;
        $this->email = $email;
        $this->password = $password;
    }


    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }
}