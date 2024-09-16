<?php

declare(strict_types=1);

/**
 * @var string $label
 * @var int $minlength
 * @var int $maxlength
 * @var bool $required
 * @var string $id
 * @var string $name
 * @var string $has_validation
 */

?>

<label for="<?= $name ?>" class="form-label"><?= $label ?></label>

<textarea
        minlength="<?= $minlength ?>"
        maxlength="<?= $maxlength ?>"
        class="form-control<?= $has_validation ? " has-validation" : "" ?>"
        id="<?= $id ?>"
        name="<?= $name ?>"
        <?= $required ? "required" : "" ?>
></textarea>

<div class="invalid-feedback">
    <?= $validation_errors["comment-text"] ?? "The field cannot be empty." ?>
</div>
