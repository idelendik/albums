<?php

/**
 * @var string $image_id
 * @var array $validation_errors
 */

?>

<form class="needs-validation" id="js-form-add-comment" novalidate>
    <input type="hidden" name="image-id" value="<?= $image_id ?>">

    <?php
    requireComponentWithParams(PATH_COMPONENTS . "/form-fields/textarea.php", [
        'label' => "Comment text",
        'minlength' => 1,
        'maxlength' => 255,
        'required' => true,
        'id' => "comment-text",
        'name' => "comment-text",
        'has_validation' => true,
    ])
    ?>

    <button type="submit" class="btn btn-success mt-3">Add comment</button>
</form>