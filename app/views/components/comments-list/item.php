<?php

declare(strict_types=1);

/**
 * @var array $comment
 */

?>

<li class="border-top py-3">
    <div class="row justify-content-between">
        <div class="col-9">
            <?= $comment['text']; ?>
        </div>
        <div class="col-2 text-end fw-lighter text-secondary small">
            <?= date("H:i, d F Y", $comment['created_at']) ?>
        </div>
    </div>
</li>
