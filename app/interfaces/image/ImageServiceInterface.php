<?php

declare(strict_types=1);

namespace Albums\interfaces\image;

interface ImageServiceInterface
{
    public function upload_image(string $album_id, array $image_file, string $image_name, string $image_description): void;

    public function delete_image(string $image_id): void;

    public function update_image(string $image_name, string $image_description, string $image_id): void;

    public function add_comment(string $image_id, string $comment_text): void;

    public function update_image_reactions(string $image_id, mixed $actions_to_apply): void;
}