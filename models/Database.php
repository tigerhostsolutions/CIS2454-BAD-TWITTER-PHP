<?php
    // Database.php
    namespace App\Models;
    require_once __DIR__ . '/../vendor/autoload.php'; // Autoload for phpdotenv
    
    use Dotenv\Dotenv;
    use Exception;
    use PDO;
    use PDOException;
    
    class Database
    {
        private static $pdo;
        
        public static function getConnection()
        {
            if (self::$pdo === NULL) {
                // Load environment variables
                try {
                    // Explicitly create and load the .env file
                    $dotenv = Dotenv::createMutable(__DIR__ . '/../');
                    $dotenv->load();
                    
                    // Debugging - output all loaded environment variables
//                    echo "Loaded Environment Variables:\n";
//                    var_dump([
//                        'RDS_HOSTNAME' => getenv('RDS_HOSTNAME'),
//                        'RDS_USERNAME' => getenv('RDS_USERNAME'),
//                        'RDS_PASSWORD' => getenv('RDS_PASSWORD'),
//                        'RDS_DB_NAME' => getenv('RDS_DB_NAME'),
//                        'RDS_PORT' => getenv('RDS_PORT'),
//                    ]);
                } catch (Exception $e) {
                    die("Dotenv error: " . $e->getMessage());
                }
                
                // Fetch environment variables with fallback
                $dotenv = Dotenv::createMutable(__DIR__ . '/../');
                $dotenv->load();
                
                $dbhost = $_ENV['RDS_HOSTNAME'] ?? getenv('RDS_HOSTNAME') ?? 'badtwitterclone.c36iwsaw0x1s.us-east-1.rds.amazonaws.com';
                $dbport = $_ENV['RDS_PORT'] ?? getenv('RDS_PORT') ?? 3306;
                $dbname = $_ENV['RDS_DB_NAME'] ?? getenv('RDS_DB_NAME') ?? 'socialtweet';
                $username = $_ENV['RDS_USERNAME'] ?? getenv('RDS_USERNAME') ?? 'badtwitter';
                $password = $_ENV['RDS_PASSWORD'] ?? getenv('RDS_PASSWORD') ?? 'badtwitter';
                $charset = 'utf8mb4';
                
                // Debug - Output final connection details
//                echo "Debug Connection Info:\n";
//                echo "Host: {$dbhost}, Port: {$dbport}, DB: {$dbname}, User: {$username}\n";
                
                // Build DSN and connect to the database
                $dsn = "mysql:host={$dbhost};port={$dbport};dbname={$dbname};charset={$charset}";
                try {
                    self::$pdo = new PDO($dsn, $username, $password);
                    self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                } catch (PDOException $e) {
                    die("ERROR: Could not connect. Host: {$dbhost}, DB: {$dbname}, User: {$username}, Error: " . $e->getMessage());
                }
            }
            
            return self::$pdo;
        }
    }