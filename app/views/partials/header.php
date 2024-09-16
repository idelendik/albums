<!DOCTYPE html>
<html lang="en" class="h-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Albums App</title>

    <link href="<?= PATH_STYLES . '/bootstrap.min.css' ?>" rel="stylesheet">
    <link href="<?= PATH_STYLES . '/lightbox.min.css' ?>" rel="stylesheet">

    <?php foreach ($args['before-closing-head'] ?? [] as $item) { ?>
        <?= $item ?>
    <?php } ?>

</head>
<body class="d-flex flex-column h-100">
<header class="bg-secondary-subtle">
    <div class="container">
        <div class="row justify-content-between py-2">
            <div class="col-auto text-start">
                <a href="/" class="d-flex align-items-center gap-1 text-decoration-none">
                    <img src="<?= PATH_IMAGES . '/icons/logo.svg' ?>" alt="" class="" width="32" height="32"/>
                    <span class="fw-bold fs-4 text-uppercase text-primary-emphasis">Albums</span>
                </a>
            </div>
        </div>
    </div>
</header>
<main class="flex-shrink-0">
    <div class="content container py-4 flex-grow-1">