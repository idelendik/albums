<?php

declare(strict_types=1);

namespace Albums\services;

use Albums\core\AppContainer;
use Albums\core\HttpStatusCode\HttpStatusCode;
use Albums\core\Validator;
use Albums\interfaces\album\AlbumRepositoryInterface;
use Albums\interfaces\album\AlbumServiceInterface;
use Albums\interfaces\DatabaseInterface;

class AlbumService implements AlbumServiceInterface
{
    // TODO: shouldn't be shared
    private static array $errors; // TODO: should be an array of arrays, a field may be invalid for multiple reasons

    public function get_album(string $album_id): array
    {
        return AppContainer::instance()->get(AlbumRepositoryInterface::class)->get_album($album_id);
    }

    public function get_albums(): array
    {
        /**
         * @var AlbumRepositoryInterface $albumRepository
         */
        $albumRepository = AppContainer::instance()->get(AlbumRepositoryInterface::class);

        return $albumRepository->get_albums();
    }

    public function create_album(string $album_name, string $album_description): void
    {
        $nameValidationErrorMessage = Validator::string($album_name, 1);
        $descriptionValidationErrorMessage = Validator::string($album_description);

        if (!is_null($nameValidationErrorMessage)) {
            //store errors and input values somewhere to pass them over to prepopulate form fields and validation messages
            self::$errors['album-name'] = "${nameValidationErrorMessage}";
        }

        if (!is_null($descriptionValidationErrorMessage)) {
            //store errors and input values somewhere to pass them over to prepopulate form fields and validation messages
            self::$errors['album-description'] = "${descriptionValidationErrorMessage}";
        }

        if (!empty(self::$errors)) {
            // pass errors to the front and highlight invalid fields
//            redirectTo('/', 400);

            http_response_code(422);
            header("Content-Type: application/json");
            echo json_encode(self::$errors);
            exit();
        }

        $lastInsertedId = AppContainer::instance()
            ->get(AlbumRepositoryInterface::class)
            ->create_album($album_name, $album_description);

        if (!is_string($lastInsertedId)) {
            // Exception
            exit();
        }

//        redirectTo("/albums/{$lastInsertedId}");
        http_response_code(HttpStatusCode::SUCCESS::CREATED);
        header('Content-Type: application/json');
        echo json_encode(["album-id" => $lastInsertedId]);
    }

    public function delete_album(string $album_id): void
    {
        // TODO: move to repository
        // TODO: replace with AlbumRepository->get_album($album_id) !!!BUT they differ by ->fetch and ->fetchAll
        $album = AppContainer::instance()
            ->get(DatabaseInterface::class)
            ->query('SELECT * FROM albums WHERE id = :id', [
                ':id' => $album_id
            ])->fetch();

        if ($album === false) {
            // Exception
            exit();
        }

        if (!count($album)) {
            // The album doesn't exist. Nothing to do here
            return;
        }

        // TODO: move to repository
        $images = AppContainer::instance()
            ->get(DatabaseInterface::class)
            ->query('SELECT * FROM images where album_id = :album_id', [
                ':album_id' => $album_id
            ])->fetchAll();

        // The album should be removed before unlinking its images
        AppContainer::instance()->get(AlbumRepositoryInterface::class)->delete_album($album_id);

        if (!is_array($images)) {
            // Exception
            exit();
        }

        if (!count($images)) {
            // No images found. Nothing to do here
            return;
        }

        foreach ($images as $image) {
            unlink(PATH_BASE . $image['image_link_full']);
            unlink(PATH_BASE . $image['image_link_thumbnail']);
        }

        redirectTo('/');
    }
}