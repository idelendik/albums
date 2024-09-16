<?php

/**
 * @var array $albums
 */

require_once PATH_PARTIALS . '/header.php';
?>

    <div class="container pt-5">
        <ul class="row row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 row-cols-xxl-5 g-3 list-unstyled justify-content-center">
            <li class="grid">
                <div class="card text-center">
                    <div class="p-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor"
                             class="bi bi-plus-circle" viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
                        </svg>
                    </div>
                    <div class="card-body">
                        <button type="button" class="btn text-nowrap stretched-link" data-bs-toggle="modal"
                                data-bs-target="#js-modal-create-album">
                            Create album
                        </button>

                    </div>
                </div>

                <?php
                requireComponentWithParams(PATH_MODALS . "/add-album.php", [
                    "modal" => [
                        "id" => "js-modal-create-album",
                    ]
                ]);
                ?>
            </li>

            <?php foreach ($albums as $album) { ?>
                <li class="grid">
                    <div class="card text-center">
                        <div class="p-3">
                            <img src="<?= PATH_IMAGES . '/icons/album.svg' ?>" class="card-img-top w-25"
                                 alt="album-preview">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title"><?= $album['name'] ?></h5>
                            <p class="card-text"><?= $album['description'] ?></p>

                            <div class="row">
                                <div class="col">
                                    <a href="/albums/<?= $album['id'] ?>" class="btn btn-primary">View</a>
                                </div>
                                <div class="col">
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#testModal<?= $album['id'] ?>">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="20"
                                             fill="currentColor"
                                             class="bi bi-trash3-fill" viewBox="0 0 16 20">
                                            <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5"/>
                                        </svg>
                                    </button>

                                    <?php
                                    requireComponentWithParams(PATH_MODALS . "/default.php", [
                                        "modal" => [
                                            "id" => "testModal" . $album['id'],
                                            "title" => "Album delete",
                                            "description" => "Could you confirm that you want to delete the album?",
                                            "album_id" => $album['id']
                                        ]
                                    ]);
                                    ?>
                                </div>
                            </div>

                        </div>
                    </div>
                </li>
            <?php } ?>
        </ul>
    </div>

<?php
require_once PATH_PARTIALS . '/footer.php';
