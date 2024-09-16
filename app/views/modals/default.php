<?php
/**
 * @var $modal
 */
?>

<div class="modal" tabindex="-1" id="<?= $modal['id']; ?>">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?= $modal['title']; ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><?= $modal['description'] ?></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Discard</button>
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal"
                        data-album-id="<?= $modal['album_id']; ?>" id="js-delete-album-<?= $modal['album_id'] ?>">
                    Confirm
                </button>
            </div>
        </div>
    </div>
</div>