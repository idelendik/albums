<?php

declare(strict_types=1);

namespace Albums\controllers;

use Albums\core\AppContainer;
use Albums\interfaces\image\ImageServiceInterface;

class AddCommentController
{
    public static function index(): void
    {
        $image_id = $_POST['image-id'];
        $comment_text = $_POST['comment-text'];

        AppContainer::instance()->get(ImageServiceInterface::class)->add_comment($image_id, $comment_text);
    }
}