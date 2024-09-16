<?php

/**
 * @var array $images
 * @var string $album_id
 */

requireComponentWithParams(PATH_PARTIALS . '/header.php', [
    'before-closing-head' => [],
]);

?>

    <div>
        <?php
        requireComponentWithParams(PATH_COMPONENTS . "/breadcrumbs.php", [
            "items" => [
                "/albums/${album_id}" => [
                    "title" => "album " . $album_id
                ]
            ]
        ]);
        ?>
    </div>

    <div class="container pt-5">
        <ul class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3 list-unstyled justify-content-center">
            <li>
                <div class="card text-center">

                    <div class="card text-center">
                        <div class="p-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor"
                                 class="bi bi-plus-circle" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
                            </svg>
                        </div>
                        <div class="card-body">
                            <button class="btn text-nowrap stretched-link" data-bs-toggle="modal"
                                    data-bs-target="#addImageModal">
                                Upload image
                            </button>
                        </div>
                    </div>

                </div>
            </li>

            <?php
            requireComponentWithParams(PATH_MODALS . "/add-image.php", [
                "modal" => [
                    "id" => "addImageModal",
                    "album_id" => $album_id
                ]
            ]);
            ?>

            <?php foreach ($images as $image) { ?>
                <li>
                    <div class="card text-center">
                        <a href="/albums/<?= $album_id ?>/<?= $image['id'] ?>">
                            <div class="position-relative">
                                <img src="<?= $image['image_link_thumbnail'] ?>" alt="" class="w-100">
                                <div class="container position-absolute bottom-0 w-100">
                                    <ul class="row row-cols-3 list-unstyled bg-dark bg-opacity-50 py-2 text-white">
                                        <li class="d-flex justify-content-center gap-2">
                                            <img src="<?= PATH_ICONS ?>/dislike.svg" alt="dislike-icon"
                                                 style="width: 18px">
                                            <span><?= $image['dislikes_count'] ?? 0 ?></span>
                                        </li>
                                        <li class="d-flex justify-content-center gap-2">
                                            <img src="<?= PATH_ICONS ?>/like.svg" alt="like-icon"
                                                 style="width: 18px">
                                            <span><?= $image['likes_count'] ?? 0 ?></span>
                                        </li>
                                        <li class="d-flex justify-content-center gap-2">
                                            <img src="<?= PATH_ICONS ?>/comments.svg" alt="comments-icon"
                                                 style="width: 18px">
                                            <span><?= $image['comments_count'] ?? 0 ?></span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </a>
                        <div class="container py-3">
                            <h3 class="py-2"><?= $image['name'] ?></h3>

                            <a href="/albums/<?= $album_id ?>/<?= $image['id'] ?>" class="btn btn-primary">View
                                image details</a>
                        </div>
                    </div>
                </li>
            <?php } ?>
        </ul>
    </div>

<?php

requireComponentWithParams(PATH_PARTIALS . '/footer.php', [
    'before-closing-body' => [

    ],
]);
