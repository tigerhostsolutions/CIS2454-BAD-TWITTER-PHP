<?php
    // profile.php
    use App\Controllers\UserController;
    
    require_once MODEL_PATH . 'Database.php';
    require_once CONTROLLER_PATH . 'UserController.php';
    
    UserController::handleRequest();