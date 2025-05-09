<?php
    // profile.php
    // This file handles the profile page of the application.
    use App\Controllers\UserController;
    
    require_once __DIR__ . '/config.php';
    require_once MODEL_PATH . 'Database.php';
    require_once CONTROLLER_PATH . 'UserController.php';
    UserController::handleRequest();
