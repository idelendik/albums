import $ from "jquery";

(() => {
    'use strict';

    const $modal = $(".js-modal-create-image");
    if ($modal.length === 0) return;

    const $form = $("#js-form-create-image", $modal);
    if ($form.length === 0) return;

    const $formErrors = $(".js-form-errors", $modal);
    if ($formErrors.length === 0) throw new Error("Form errors block is missing");

    $form.on('submit', (e) => {
        e.preventDefault();

        const thisForm = e.currentTarget;

        if (!thisForm.checkValidity()) {
            thisForm.classList.add('was-validated');
            return;
        }

        $.ajax({
            method: "POST",
            url: `${process.env.BASE_URL}/images/create`,
            data: new FormData(thisForm),
            contentType: false,
            processData: false
        })
            .done((respData) => {
                const {success, data, errors} = respData;

                if (success) {
                    const {redirect_url} = data;

                    if (!redirect_url) {
                        throw new Error("Redirect URL is missing");
                    }

                    location.href = redirect_url;
                }

                if (errors.length > 0) {
                    const errorsHTML = errors.reduce((resultHTML, errorText) => {
                        return resultHTML + generateErrorHTML(errorText);
                    }, "");

                    $($formErrors).html(errorsHTML);
                }
            })
            .fail((jqXHR) => {
                const {errors} = jqXHR.responseJSON;

                if (errors.length > 0) {
                    const errorsHTML = errors.reduce((resultHTML, errorText) => {
                        return resultHTML + generateErrorHTML(errorText);
                    }, "");

                    $($formErrors).html(errorsHTML);
                }

                console.log(jqXHR.status, jqXHR.statusText);
            });
    });


    $("#js-btn-create-image", $modal).on('click', () => {
        // TODO: clean form fields
        $form.submit();
    });

    function generateErrorHTML(errorText) {
        return `
            <div class="alert alert-danger alert-dismissible" role="alert">
                <div>${errorText}</div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        `;
    }
})();