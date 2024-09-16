<?php
/**
 * @var $modal
 */
?>

<div class="modal fade" tabindex="-1" id="<?= $modal['id']; ?>">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form id="js-form-create-album" class="needs-validation"
                      novalidate>
                    <div class="mb-3">
                        <label for="album-name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="album-name"
                               name="album-name"
                               required>
                        <div class="invalid-feedback">
                            The field cannot be empty
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="album-description" class="form-label">Description</label>
                        <textarea class="form-control" id="album-description"
                                  name="album-description" maxlength="255"></textarea>
                    </div>
                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="js-btn-create-album">
                    Create
                </button>
            </div>
        </div>
    </div>
</div>