<?php

/**
 * @var array $image
 * @var array $comments
 */

use Albums\core\AppContainer;

require PATH_PARTIALS . '/header.php';
?>

    <div>
        <?php
        requireComponentWithParams(PATH_COMPONENTS . "/breadcrumbs.php", [
            "items" => [
                "/albums/${image['album_id']}" => [
                    "title" => "album " . $image['album_id']
                ],
                "/albums/${image['album_id']}/${image['id']}" => [
                    "title" => "image " . $image['id']
                ]
            ]
        ]);
        ?>
    </div>

    <div class="row mb-5">
        <div class="col-5">
            <div class="row mb-5">
                <h3>Image Details:</h3>
                <?php requireComponentWithParams(PATH_COMPONENTS . '/edit-image-form.php', [
                    'image' => $image,
                ]) ?>
            </div>
        </div>
        <div class="col-7">
            <a href="<?= $image['image_link_full'] ?>" data-lightbox="image-1">
                <div class="row d-flex position-relative justify-content-center align-items-center">
                    <img src="<?= $image['image_link_thumbnail'] ?>" alt="" class="w-100">
                    <span class="w-auto px-4 py-3 bg-black bg-opacity-50 position-absolute text-white text-decoration-none d-flex gap-2 align-items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                             class="bi bi-zoom-in" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                  d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11M13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0"/>
                            <path d="M10.344 11.742q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1 6.5 6.5 0 0 1-1.398 1.4z"/>
                            <path fill-rule="evenodd"
                                  d="M6.5 3a.5.5 0 0 1 .5.5V6h2.5a.5.5 0 0 1 0 1H7v2.5a.5.5 0 0 1-1 0V7H3.5a.5.5 0 0 1 0-1H6V3.5a.5.5 0 0 1 .5-.5"/>
                        </svg>
                        Enlarge
                    </span>
                </div>
            </a>
            <div class="row mt-2 mx-auto">
                <div class="col d-flex justify-content-start">
                    <div class="row">
                        <div class="col text-center">
                            <button type="button" class="btn btn-outline-dark" id="btn-reaction-dislike"
                                    name="dislike" data-image-id="<?= $image['id'] ?>">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                     class="bi bi-hand-thumbs-down-fill" viewBox="0 0 16 16">
                                    <path d="M6.956 14.534c.065.936.952 1.659 1.908 1.42l.261-.065a1.38 1.38 0 0 0 1.012-.965c.22-.816.533-2.512.062-4.51q.205.03.443.051c.713.065 1.669.071 2.516-.211.518-.173.994-.68 1.2-1.272a1.9 1.9 0 0 0-.234-1.734c.058-.118.103-.242.138-.362.077-.27.113-.568.113-.856 0-.29-.036-.586-.113-.857a2 2 0 0 0-.16-.403c.169-.387.107-.82-.003-1.149a3.2 3.2 0 0 0-.488-.9c.054-.153.076-.313.076-.465a1.86 1.86 0 0 0-.253-.912C13.1.757 12.437.28 11.5.28H8c-.605 0-1.07.08-1.466.217a4.8 4.8 0 0 0-.97.485l-.048.029c-.504.308-.999.61-2.068.723C2.682 1.815 2 2.434 2 3.279v4c0 .851.685 1.433 1.357 1.616.849.232 1.574.787 2.132 1.41.56.626.914 1.28 1.039 1.638.199.575.356 1.54.428 2.591"/>
                                </svg>
                            </button>
                        </div>
                        <div class="col text-center">
                            <button type="button" class="btn btn-outline-dark" id="btn-reaction-like" name="like"
                                    data-image-id="<?= $image['id'] ?>">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                     class="bi bi-hand-thumbs-up-fill" viewBox="0 0 16 16">
                                    <path d="M6.956 1.745C7.021.81 7.908.087 8.864.325l.261.066c.463.116.874.456 1.012.965.22.816.533 2.511.062 4.51a10 10 0 0 1 .443-.051c.713-.065 1.669-.072 2.516.21.518.173.994.681 1.2 1.273.184.532.16 1.162-.234 1.733q.086.18.138.363c.077.27.113.567.113.856s-.036.586-.113.856c-.039.135-.09.273-.16.404.169.387.107.819-.003 1.148a3.2 3.2 0 0 1-.488.901c.054.152.076.312.076.465 0 .305-.089.625-.253.912C13.1 15.522 12.437 16 11.5 16H8c-.605 0-1.07-.081-1.466-.218a4.8 4.8 0 0 1-.97-.484l-.048-.03c-.504-.307-.999-.609-2.068-.722C2.682 14.464 2 13.846 2 13V9c0-.85.685-1.432 1.357-1.615.849-.232 1.574-.787 2.132-1.41.56-.627.914-1.28 1.039-1.639.199-.575.356-1.539.428-2.59z"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col d-flex justify-content-end">
                    <div class="row">
                        <div class="col">
                            <!--                            <form method="POST" action="/images/delete">-->
                            <!--                                <input type="hidden" name="_method" value="DELETE">-->
                            <!--                                <input type="hidden" name="image_id" value="-->
                            <?php //= $image['id'] ?><!--">-->
                            <!--                                <button type="submit" class="btn btn-danger">-->
                            <!--                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="20"-->
                            <!--                                         fill="currentColor"-->
                            <!--                                         class="bi bi-trash3-fill" viewBox="0 0 16 20">-->
                            <!--                                        <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5"/>-->
                            <!--                                    </svg>-->
                            <!--                                </button>-->
                            <!--                            </form>-->
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#deleteImageModal">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="20"
                                     fill="currentColor"
                                     class="bi bi-trash3-fill" viewBox="0 0 16 20">
                                    <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5"/>
                                </svg>
                            </button>

                            <?php
                            requireComponentWithParams(PATH_MODALS . "/delete-image.php", [
                                "modal" => [
                                    "id" => "deleteImageModal",
                                    "title" => "Image delete",
                                    "description" => "Could you confirm that you want to delete the image?",
                                    "image_id" => $image['id']
                                ]
                            ]);
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="row mb-5">
                <?php
                /** @var $s \Albums\interfaces\core\SessionStorageInterface */
                $s = AppContainer::instance()->get(\Albums\interfaces\core\SessionStorageInterface::class);
                $validationErrors = $s->get('validation_errors');
                ?>
                <?php requireComponentWithParams(PATH_COMPONENTS . '/add-comment-form.php', [
                    'image_id' => $image['id'],
                    'validation_errors' => $validationErrors,
                    // pass $_SESSION['message'] from AddCommentController as a validation error
                    // and then clear $_SESSION['message']
                ]) ?>
            </div>

            <div class="row">
                <?php requireComponentWithParams(PATH_COMPONENTS . '/comments-list.php', [
                    'comments' => $comments,
                ]) ?>
            </div>
        </div>
    </div>

<?php
require PATH_PARTIALS . '/footer.php';
