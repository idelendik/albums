import $ from "jquery";

(() => {
    'use strict';

    const MODAL_ID = "js-modal-create-album";
    const FORM_ID = "js-form-create-album";
    const MODAL_BUTTON_ID = "js-btn-create-album";
    const FORM_CONTROL_CLASS = "form-control";
    const WAS_VALIDATED_CLASS = "was-validated";

    const IS_VALID_CLASS = "is-valid";
    const IS_INVALID_CLASS = "is-invalid";

    const INVALID_FEEDBACK_CLASS = "invalid-feedback";

    const $modal = $(`#${MODAL_ID}`);
    if ($modal.length === 0) return;

    const $form = $(`#${FORM_ID}`, $modal);
    if ($form.length === 0) return;

    document.getElementById(MODAL_ID)
        .addEventListener("shown.bs.modal", () => {
            $modal.find(`.${FORM_CONTROL_CLASS}`).first().focus();
        });

    document.getElementById(MODAL_ID)
        .addEventListener("hidden.bs.modal", () => {
            clearForm();
        });

    function clearForm() {
        $form.find(`.${FORM_CONTROL_CLASS}`).each((idx, item) => {
            item.value = "";
            $(item).removeClass(IS_VALID_CLASS).removeClass(IS_INVALID_CLASS);
        })

        $form.removeClass(WAS_VALIDATED_CLASS);
    }

    $(`#${MODAL_BUTTON_ID}`, $modal).on('click', () => {
        $form.submit();
    });

    $form.on('submit', (e) => {
        e.preventDefault();

        const thisForm = e.currentTarget;

        // client-side validation
        if (!thisForm.checkValidity()) {
            $(thisForm).addClass('was-validated');
            return;
        }

        $.ajax({
            method: "POST",
            url: `${process.env.BASE_URL}/albums/create`,
            data: new FormData(thisForm),
            contentType: false,
            processData: false,
            beforeSend: () => {
                $(`.${FORM_CONTROL_CLASS}`, thisForm).removeClass(IS_INVALID_CLASS).addClass(IS_VALID_CLASS);
            },
            success: (data) => {
                location.href = `${process.env.BASE_URL}/albums/${data['album-id']}`;
            },
            error: (jqXHR) => {
                const respJSON = jqXHR.responseJSON;
                const fieldIds = Object.keys(respJSON);

                fieldIds.forEach(fieldId => {
                    const field = $(`#${fieldId}`, thisForm);

                    field.removeClass(IS_VALID_CLASS).addClass(IS_INVALID_CLASS);
                    field.parent().find(`.${INVALID_FEEDBACK_CLASS}`).clone().text(respJSON[fieldId]).appendTo(field.parent());
                });
            }
        });
    });
})();