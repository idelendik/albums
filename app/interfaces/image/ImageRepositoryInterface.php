<?php

declare(strict_types=1);

namespace Albums\interfaces\image;

interface ImageRepositoryInterface
{
    public function create_image(string $image_name, string $image_description, string $album_id, string $image_link_full, string $image_link_thumbnail): false|string;

    public function get_image(string $image_id): mixed;

    public function get_image_from_album_by_id(string $album_id, string $image_id): array;

    public function delete_image(string $image_id): void;

    public function update_image(string $image_name, string $image_description, string $image_id): void;

    public function get_comments(string $image_id): array;

    public function add_comment(string $image_id, string $comment_text): string;

    public function update_image_reactions(string $image_id, array $actions_to_apply): void;
}