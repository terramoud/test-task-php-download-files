<?php

namespace User\TestTaskPhpDownloadFiles\dto;

/**
 * Class UserAuthDTO
 * Data Transfer Object (DTO) for user authentication.
 */
class UserAuthDTO
{
    /**
     * @var string The user's email address.
     */
    private string $email;

    /**
     * @var string The user's password.
     */
    private string $password;

    /**
     * UserAuthDTO constructor.
     *
     * @param string $email The user's email address.
     * @param string $password The user's password.
     */
    public function __construct(string $email, string $password)
    {
        $this->email = $email;
        $this->password = $password;
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
