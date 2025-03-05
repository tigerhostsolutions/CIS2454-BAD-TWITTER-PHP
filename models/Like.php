<?php
    // Like.php
    namespace App\Models;
    
    use PDOException;
    
    require_once __DIR__ . '/../config.php';
    require_once BASE_DIR . '/models/Database.php';
    
    class Like
    {
        public static function add($userId, $tweetId)
        {
            try {
                $pdo = Database::getConnection();
                $stmt = $pdo->prepare("INSERT INTO likes (user_id, tweet_id) VALUES (:user_id, :tweet_id)");
                $stmt->execute(['user_id' => $userId, 'tweet_id' => $tweetId]);
                return true; // Indicate success
            } catch (PDOException $e) {
                error_log("Error in Like::add: " . $e->getMessage()); // Log the error
                return false; // Indicate failure for debugging
            }
        }
        
        public static function remove($userId, $tweetId)
        {
            try {
                $pdo = Database::getConnection();
                $stmt = $pdo->prepare("DELETE FROM likes WHERE user_id = :user_id AND tweet_id = :tweet_id");
                $stmt->execute(['user_id' => $userId, 'tweet_id' => $tweetId]);
                return true; // Indicate success
            } catch (PDOException $e) {
                error_log("Error in Like::remove: " . $e->getMessage()); // Log the error
                return false; // Indicate failure for debugging
            }
        }
    }