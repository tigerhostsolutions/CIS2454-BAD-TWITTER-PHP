<?php
            namespace App\Models;
            
            require_once __DIR__ . '/../vendor/autoload.php'; // Composer autoload
            
            use Dotenv\Dotenv;
            use PDO;
            use PDOException;
            
            class Database
            {
                private static $connections = [];
            
                public static function getConnection($type = 'local')
                {
                    if (!isset(self::$connections[$type])) {
                        self::$connections[$type] = self::createConnection($type);
                    }
                    return self::$connections[$type];
                }
            
                private static function createConnection($type)
                {
                    // Load .env file only in local environments
                    if (file_exists(__DIR__ . '/../.env')) {
                        Dotenv::createImmutable(__DIR__ . '/../')->safeLoad();
                    }
            
                    // Fetch DB credentials
                    $username = getenv('DB_USER') ?: ($_ENV['DB_USER'] ?? '');
                    $password = getenv('DB_PASS') ?: ($_ENV['DB_PASS'] ?? '');
                    $dbname   = getenv('DB_NAME') ?: ($_ENV['DB_NAME'] ?? '');
                    $dbport   = getenv('DB_PORT') ?: ($_ENV['DB_PORT'] ?? '');
            
                    // Host selection
                    $dbhost = $type === 'remote'
                        ? (getenv('DB_REMOTE_HOST') ?: ($_ENV['DB_REMOTE_HOST'] ?? ''))
                        : (getenv('DB_LOCAL_HOST') ?: ($_ENV['DB_LOCAL_HOST'] ?? ''));
            
                    if (!$dbhost || !$username || !$password || !$dbname || !$dbport) {
                        die("Missing database configuration for {$type} environment.");
                    }
            
                    $charset = 'utf8mb4';
                    $dsn = "mysql:host={$dbhost};port={$dbport};dbname={$dbname};charset={$charset}";
            
                    try {
                        $pdo = new PDO($dsn, $username, $password);
                        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        return $pdo;
                    } catch (PDOException $e) {
                        if (getenv('ENVIRONMENT') === 'local') {
                            die("DB connection error: " . $e->getMessage());
                        } else {
                            error_log("Database connection failed: " . $e->getMessage());
                            die("Internal server error.");
                        }
                    }
                }
            }