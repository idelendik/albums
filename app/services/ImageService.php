<?php

declare(strict_types=1);

namespace Albums\services;

use Albums\core\AppContainer;
use Albums\core\ImageUploader;
use Albums\core\Response;
use Albums\core\ThumbnailGenerator;
use Albums\core\Validator;
use Albums\interfaces\image\ImageRepositoryInterface;
use Albums\interfaces\image\ImageServiceInterface;
use Albums\models\Image;
use Albums\models\Thumbnail;

class ImageService implements ImageServiceInterface
{
    public function upload_image($album_id, $image_file, $image_name, $image_description): void
    {
        $isFileValid = Validator::image($image_file);
        $isNameValid = Validator::string($image_name, 1);
        $isDescriptionValid = Validator::string($image_description);

        $errors = [];

        if (!$isFileValid) {
            //store errors and input values somewhere to pass them over to prepopulate form fields and validation messages
            $errors['image-file'] = 'An error occurred while loading the file. Please try again';
        }

        if (!is_null($isNameValid)) {
            //store errors and input values somewhere to pass them over to prepopulate form fields and validation messages
            $errors['image-name'] = 'Image name should be between 1 and 255 chars long';
        }

        if (!is_null($isDescriptionValid)) {
            //store errors and input values somewhere to pass them over to prepopulate form fields and validation messages
            $errors['image-description'] = 'Image description should be between 0 and 255 chars long';
        }

        if (!empty($errors)) {
            redirectTo($_SERVER['HTTP_REFERER'], 400);
        }

        $image = new Image($image_file);
        $thumbnail = (new ThumbnailGenerator(clone $image))->generate(500);

        $imageUploader = new ImageUploader();
        $image_link_full = $imageUploader->upload($image);
        $image_link_thumbnail = $imageUploader->upload($thumbnail);

        try {
            $image_id = AppContainer::instance()
                ->get(ImageRepositoryInterface::class)
                ->create_image($image_name, $image_description, $album_id, $image_link_full, $image_link_thumbnail);

            (new Response(
                success: true,
                statusCode: 201,
                body: ['redirect_url' => $_ENV['BASE_URL'] . "/albums/" . $album_id . "/" . $image_id]
            ))->send();
        } catch (\PDOException $e) {
            // TODO: send $e->getMessage() to internal dev logs

            (new Response(
                success: false,
                statusCode: 500,
                errors: ["Cannot store the image in the database. Please try again"]
            ))->send();
        }
    }

    public function delete_image($image_id): void
    {
        // process the result
        $image = AppContainer::instance()->get(ImageRepositoryInterface::class)->get_image($image_id);
//        $image = static::$models[Image::class]::get_image($image_id);

        if (!is_array($image) || empty($image)) {
            // The image we are going to delete does not exist
            return;
        }

        // return something to process the result
        AppContainer::instance()->get(ImageRepositoryInterface::class)->delete_image($image_id);
        //static::$models[Image::class]::delete_image($image_id);

        unlink(PATH_BASE . $image['image_link_full']);
        unlink(PATH_BASE . $image['image_link_thumbnail']);

        redirectTo('/albums/' . $image['album_id']);
    }

    public function update_image(string $image_name, string $image_description, string $image_id): void
    {
        /**
         * @var ImageRepositoryInterface $imageRepository
         */
        $imageRepository = AppContainer::instance()->get(ImageRepositoryInterface::class);

        $imageRepository->update_image($image_name, $image_description, $image_id);

//        redirectTo($_SERVER['HTTP_REFERER']);
    }

    public function add_comment(string $image_id, string $comment_text): void
    {
        $textValidationMessage = Validator::string($comment_text, 1);

        $errors = [];

        if (!is_null($textValidationMessage)) {
            $errors["comment-text"] = $textValidationMessage;
        }

        if (!empty($errors)) {
            (new Response(
                success: false,
                statusCode: 422,
                errors: [
                    "validation_errors" => $errors
                ]
            ))->send();
        }

        $error_message = AppContainer::instance()->get(ImageRepositoryInterface::class)->add_comment($image_id, $comment_text);

        if ($error_message) {
            /** @var $s \Albums\interfaces\core\SessionStorageInterface */
            $s = AppContainer::instance()->get(\Albums\interfaces\core\SessionStorageInterface::class);
            $s->put('message', $error_message);

            redirectTo($_SERVER['HTTP_REFERER'], 500);
        }

        $newCommentMarkup = requireComponentWithParams(PATH_COMPONENTS . "/comments-list/item.php", [
            'comment' => [
                'text' => $comment_text,
                'created_at' => time()
            ]
        ], true);

        (new Response(
            success: true,
            statusCode: 201,
            body: $newCommentMarkup,
        ))->send();
    }

    public function update_image_reactions(string $image_id, mixed $actions_to_apply): void
    {
        AppContainer::instance()->get(ImageRepositoryInterface::class)->update_image_reactions($image_id, $actions_to_apply);
    }
}