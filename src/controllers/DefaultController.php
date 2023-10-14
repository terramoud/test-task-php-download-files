<?php

namespace User\TestTaskPhpDownloadFiles\controllers;

use User\TestTaskPhpDownloadFiles\Paths;

class DefaultController
{
    /**
     * Handle user's home page
     */
    public function homePage(): void
    {
        if (!isset($_SESSION['user_id'])) {
            header("Location: " . Paths::LOGIN_ROUTE);
            return;
        }
        require_once(Paths::HOME_VIEW);
    }
}