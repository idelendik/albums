<form id="js-form-edit-image-details" class="needs-validation" novalidate>
    <input type="hidden" name="_method" value="UPDATE">
    <input type="hidden" name="image-id" value="<?= $args['image']['id'] ?>">
    <input type="hidden" name="album-id" value="<?= $args['image']['album_id'] ?>">
    <div class="mb-3">
        <label for="image-name" class="form-label">Image Name</label>
        <input type="text" class="form-control has-validation" id="image-name" name="image-name"
               value="<?= $args['image']['name'] ?>" required>
        <div class="invalid-feedback">
            The field is cannot be empty.
        </div>
    </div>
    <div class="mb-3">
        <label for="image-description" class="form-label">Image Description</label>
        <textarea class="form-control" id="image-description"
                  name="image-description"><?= $args['image']['description'] ?></textarea>
    </div>
    <button type="submit" class="btn btn-success">Update details</button>
</form>

<!-- a form for adding a new image (imagefile, imagename, image descr) - check whether a file is an image -->