<?php


#use PDO;
use Ramsey\Uuid\Uuid;

require_once __DIR__ . '/Photo.php';

class Database
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = new PDO('sqlite:' . __DIR__ . '/../database/database.sqlite');

    }

    /**
     * @return void
     */
    public function createPhotosTable(): void
    {
        $this->pdo->query('CREATE TABLE IF NOT EXISTS photos (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            photo VARCHAR,
            owner VARCHAR
    )   ');
    }

    public function getPhoto(string $id): ?Photo
    {
        $stmt = $this->pdo->prepare(
            'SELECT * FROM photos WHERE id = :id'
        );
        $stmt->execute([
            'id' => $id,
        ]);

        $photo = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($photo === false) {
            return null;
        }

        return new Photo($photo['id'], $photo['photo'], $photo['owner']);

    }
}