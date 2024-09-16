<?php
/**
 * @var $modal
 */
?>

<div class="modal js-modal-create-image" tabindex="-1" id="<?= $modal['id']; ?>">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="js-form-errors"></div>
                <form id="js-form-create-image"
                      class="needs-validation"
                      novalidate>
                    <input type="hidden" name="album_id" value="<?= $modal['album_id'] ?>">
                    <div class="mb-3">
                        <label for="image-file" class="form-label">Image File</label>
                        <input type="file" accept=".jpg, .jpeg, .png" class="form-control"
                               id="image-file"
                               name="image-file" required>
                        <div class="invalid-feedback">
                            The field is cannot be empty.
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="image-name" class="form-label">Image Name</label>
                        <input type="text" class="form-control has-validation" id="image-name" name="image-name"
                               required>
                        <div class="invalid-feedback">
                            The field is cannot be empty.
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="image-description" class="form-label">Image Description</label>
                        <textarea class="form-control" id="image-description" name="image-description"></textarea>
                    </div>
                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" id="js-btn-create-image">
                    Upload
                </button>
            </div>
        </div>
    </div>
</div>