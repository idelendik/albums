<?php

/**
 * @var array $comments
 */

?>

<div class="row" id="js-comment-list">
    <h3 class="pb-3">Comments:</h3>

    <ul class="list-unstyled">
        <?php foreach ($comments as $comment) : ?>

            <?php requireComponentWithParams(PATH_COMPONENTS . "/comments-list/item.php", [
                "comment" => $comment
            ]); ?>

        <?php endforeach; ?>
    </ul>
</div>