<?php
    // profile.php
    use App\Controllers\UserController;
    
    require_once 'models/Database.php';
    require_once 'controllers/UserController.php';
    
    UserController::handleRequest();