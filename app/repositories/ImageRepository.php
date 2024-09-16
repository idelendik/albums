<?php

declare(strict_types=1);

namespace Albums\repositories;

use Albums\core\AppContainer;
use Albums\interfaces\DatabaseInterface;
use Albums\interfaces\image\ImageRepositoryInterface;

class ImageRepository implements ImageRepositoryInterface
{
    public function create_image(string $image_name, string $image_description, string $album_id, string $image_link_full, string $image_link_thumbnail): false|string
    {
        /**
         * @var $db DatabaseInterface
         */
        $db = AppContainer::instance()->get(DatabaseInterface::class);

        try {
            if (!$db->inTransaction()) {
                $db->beginTransaction();
            }

            $db->query('INSERT INTO images (name, description, album_id, image_link_full, image_link_thumbnail) VALUES (:name, :description, :album_id, :image_link_full, :image_link_thumbnail)', [
                ':name' => $image_name,
                ':description' => $image_description,
                ':album_id' => $album_id,
                ':image_link_full' => $image_link_full,
                ':image_link_thumbnail' => $image_link_thumbnail,
            ]);

            $last_insert_id = $db->lastInsertId();

            $db->query('INSERT INTO images_meta (image_id, likes_count, dislikes_count) VALUES (:image_id, :likes_count, :dislikes_count)', [
                ':image_id' => $last_insert_id,
                ':likes_count' => 0,
                ':dislikes_count' => 0
            ]);

            $db->commit();

            return $last_insert_id;
        } catch (\PDOException $e) {
            $db->rollBack();

            throw $e;
        }
    }

    public function get_image(string $image_id): mixed
    {
        try {
            $image = AppContainer::instance()
                ->get(DatabaseInterface::class)
                ->query('SELECT * FROM images WHERE id = :id', [
                    ':id' => $image_id,
                ])->fetch();
        } catch (\Exception $exception) {
            var_dump($exception->getMessage());

            redirectTo('/'); // redirect to HTTP_REFERRER or album page e.g. /albums/{album_id}
            return [];
        }

        if (!is_array($image)) {
            redirectTo('/'); // redirect to HTTP_REFERRER or album page e.g. /albums/{album_id}
        }

        if (empty($image)) {
            redirectTo('/'); // redirect to HTTP_REFERRER or album page e.g. /albums/{album_id}
        }

        return $image;
    }

    public function delete_image(string $image_id): void
    {
        AppContainer::instance()
            ->get(DatabaseInterface::class)
            ->query('DELETE FROM images WHERE id = :id', [
                ':id' => $image_id,
            ]);
    }

    public function get_image_from_album_by_id(string $album_id, string $image_id): array
    {
        try {
            $image = AppContainer::instance()
                ->get(DatabaseInterface::class)
                ->query('SELECT * FROM images WHERE id = :id AND album_id = :album_id', [
                    ':id' => $image_id,
                    ':album_id' => $album_id,
                ])->fetch();
        } catch (\Exception $exception) {
            var_dump($exception->getMessage());

            return [];
        }

        if (!is_array($image)) { // TODO: move to a service
            redirectTo('/'); // redirect to HTTP_REFERRER or album page e.g. /albums/{album_id}
        }

        return $image;
    }

    public function update_image(string $image_name, string $image_description, string $image_id): void
    {
        AppContainer::instance()
            ->get(DatabaseInterface::class)
            ->query('UPDATE images SET name = :name, description = :description, updated_at = :updated_at WHERE id = :id', [
                ':name' => $image_name,
                ':description' => $image_description,
                ':id' => $image_id,
                ':updated_at' => date("Y-m-d H:i:s")
            ]);
    }

    public function get_comments(string $image_id): array
    {
        try {
            return AppContainer::instance()
                ->get(DatabaseInterface::class)
                ->query('SELECT text, image_id, UNIX_TIMESTAMP(created_at) as created_at FROM comments WHERE image_id = :image_id ORDER BY `created_at` DESC', [
                    ':image_id' => $image_id,
                ])->fetchAll();
        } catch (\Exception $exception) {
            var_dump($exception->getMessage());

            return [];
        }
    }

    public function add_comment(string $image_id, string $comment_text): string
    {
        try {
            AppContainer::instance()
                ->get(DatabaseInterface::class)
                ->query('INSERT INTO comments (text, image_id) VALUES (:text, :image_id)', [
                    ':text' => $comment_text,
                    ':image_id' => $image_id
                ]);
        } catch (\Exception $exception) {
            // var_dump($exception->getMessage());
            return "An error occurred while adding a comment";
        }

        return "";
    }

    public function update_image_reactions(string $image_id, array $actions_to_apply): void
    {
        $likes_expression = 0;
        $dislikes_expression = 0;

        foreach ($actions_to_apply as $action) {
            switch ($action) {
                case 'like-add':
                    $likes_expression = 1;
                    break;
                case 'like-delete':
                    $likes_expression = -1;
                    break;
                case 'dislike-add':
                    $dislikes_expression = 1;
                    break;
                case 'dislike-delete':
                    $dislikes_expression = -1;
                    break;
            }
        }

        try {
            AppContainer::instance()
                ->get(DatabaseInterface::class)
                ->query("UPDATE images_meta SET likes_count = GREATEST(0, likes_count + :likes_expression), dislikes_count = GREATEST(0, dislikes_count + :dislikes_expression) WHERE image_id = :image_id", [
                    ':likes_expression' => $likes_expression,
                    ':dislikes_expression' => $dislikes_expression,
                    ':image_id' => $image_id
                ]);

            header('Content-type: application/json');
            http_response_code(201);
            echo json_encode(["image-id" => $image_id, "applied-actions" => $actions_to_apply]);

        } catch (\Exception $e) {
            var_dump($e->getMessage());
        }
    }
}