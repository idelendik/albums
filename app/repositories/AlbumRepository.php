<?php

declare(strict_types=1);

namespace Albums\repositories;

use Albums\core\AppContainer;
use Albums\interfaces\album\AlbumRepositoryInterface;
use Albums\interfaces\DatabaseInterface;

class AlbumRepository implements AlbumRepositoryInterface
{
    public function get_album(string $album_id): array
    {
        try {
            $album = AppContainer::instance()
                ->get(DatabaseInterface::class)
                ->query("SELECT * FROM albums where id = :album_id", [
                    ":album_id" => $album_id
                ])->fetchAll();

            return $album;
        } catch (\Exception $e) {
            var_dump($e->getMessage());

            return [];
        }
    }

    public function get_albums(): array
    {
        try {
            // TODO: replace * with 'id, LEFT(name, 60) as name, LEFT(description, 60) as description'
            return AppContainer::instance()
                ->get(DatabaseInterface::class)
                ->query("SELECT * FROM albums ORDER BY created_at DESC")
                ->fetchAll();
        } catch (\Exception $exception) {
            var_dump($exception->getMessage());

            return [];
        }
    }

    public function create_album(string $album_name, string $album_description): false|string
    {
        AppContainer::instance()->get(DatabaseInterface::class)
            ->query('INSERT INTO albums (name, description) VALUES (:name, :description)', [
                'name' => $album_name,
                'description' => $album_description,
            ]);

        return AppContainer::instance()
            ->get(DatabaseInterface::class)
            ->lastInsertId();
    }

    public function delete_album(string $album_id): void
    {
        AppContainer::instance()
            ->get(DatabaseInterface::class)
            ->query('DELETE FROM albums WHERE id = :id', [
                ':id' => $album_id
            ]);
    }
}