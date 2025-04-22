<?php
    // register.php
    use App\Models\Database;
    
    session_start();
    
    require_once __DIR__ . '/config.php';
    require_once MODEL_PATH . 'Database.php';
    require_once VIEW_PATH . 'header.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Fetch PDO instance from Database class
        $pdo = Database::getConnection();
        
        // Filter incoming data (optional - sanitize if needed)
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        
        // Prepare and execute the query
        $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (:username, :email, :password)");
        $stmt->execute(['username' => $username, 'email' => $email, 'password' => $password]);
        
        // Store user ID in session and redirect to index
        $_SESSION['user_id'] = $pdo->lastInsertId();
        header("Location: index.php");
        exit();
    }
?>

<main>
    <h1>Register New Social Tweet Account</h1>
    <form method="POST" action="register.php">
        <label >
            <input type="text" name="username" placeholder="Username" required>
        </label >
        <label >
            <input type="email" name="email" placeholder="Email" required>
        </label >
        <label >
            <input type="password" name="password" placeholder="Password" required>
        </label >
        <button type="submit" formtarget="_blank">Register</button>
    </form>
</main>

<?php
    require_once VIEW_PATH . 'footer.php';
    ?>
