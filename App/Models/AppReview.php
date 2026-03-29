<?php

namespace App\Models;

class AppReview
{
    /**
     * Create or update a review for a user (one review per user).
     */
    public static function createOrUpdate(int $userId, int $rating, string $message): bool
    {
        $db = \Database::connect();
        $stmt = $db->prepare("
            INSERT INTO app_reviews (user_id, rating, message, created_at, updated_at)
            VALUES (:uid, :rating, :message, NOW(), NOW())
            ON DUPLICATE KEY UPDATE
                rating     = VALUES(rating),
                message    = VALUES(message),
                updated_at = NOW()
        ");
        return $stmt->execute([
            'uid'     => $userId,
            'rating'  => $rating,
            'message' => $message,
        ]);
    }

    /**
     * Get the N most recent reviews with user name.
     */
    public static function getLatest(int $limit = 3): array
    {
        $db   = \Database::connect();
        $stmt = $db->prepare("
            SELECT ar.*, u.name AS user_name
            FROM   app_reviews ar
            JOIN   users u ON ar.user_id = u.id
            ORDER  BY ar.created_at DESC
            LIMIT  :limit
        ");
        $stmt->bindValue(':limit', $limit, \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    /**
     * Get paginated list of all reviews.
     */
    public static function getPaginated(int $page = 1, int $perPage = 10): array
    {
        $db     = \Database::connect();
        $offset = ($page - 1) * $perPage;

        $stmt = $db->prepare("
            SELECT ar.*, u.name AS user_name
            FROM   app_reviews ar
            JOIN   users u ON ar.user_id = u.id
            ORDER  BY ar.created_at DESC
            LIMIT  :limit OFFSET :offset
        ");
        $stmt->bindValue(':limit',  $perPage, \PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset,  \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    /**
     * Total review count (for pagination).
     */
    public static function totalCount(): int
    {
        $db   = \Database::connect();
        $stmt = $db->query("SELECT COUNT(*) FROM app_reviews");
        return (int) $stmt->fetchColumn();
    }

    /**
     * Average rating (returns float, e.g. 4.7) and total count.
     */
    public static function stats(): array
    {
        $db   = \Database::connect();
        $stmt = $db->query("
            SELECT 
                ROUND(AVG(rating), 1) AS avg_rating,
                COUNT(*)              AS total
            FROM app_reviews
        ");
        $row = $stmt->fetch();
        return [
            'avg'   => $row['avg_rating'] ?? 0.0,
            'total' => (int) ($row['total'] ?? 0),
        ];
    }

    /**
     * Rating breakdown: how many reviews per star (1–5).
     */
    public static function breakdown(): array
    {
        $db   = \Database::connect();
        $stmt = $db->query("
            SELECT rating, COUNT(*) AS cnt
            FROM   app_reviews
            GROUP  BY rating
        ");
        $rows   = $stmt->fetchAll();
        $result = [5 => 0, 4 => 0, 3 => 0, 2 => 0, 1 => 0];
        foreach ($rows as $row) {
            $result[(int) $row['rating']] = (int) $row['cnt'];
        }
        return $result;
    }

    /**
     * Check whether a specific user already left a review.
     */
    public static function userHasReviewed(int $userId): bool
    {
        $db   = \Database::connect();
        $stmt = $db->prepare("SELECT id FROM app_reviews WHERE user_id = :uid LIMIT 1");
        $stmt->execute(['uid' => $userId]);
        return (bool) $stmt->fetch();
    }

    /**
     * Get the review of a specific user (or null).
     */
    public static function getUserReview(int $userId): ?array
    {
        $db   = \Database::connect();
        $stmt = $db->prepare("SELECT * FROM app_reviews WHERE user_id = :uid LIMIT 1");
        $stmt->execute(['uid' => $userId]);
        $row = $stmt->fetch();
        return $row ?: null;
    }
}
