import $ from "jquery";

(() => {
    'use strict';

    const $form = $('#js-form-add-comment');
    if ($form.length === 0) return;

    $form.on('submit', (e) => {
        e.preventDefault();

        const thisForm = e.currentTarget;

        $.ajax({
            method: "POST",
            url: `${process.env.BASE_URL}/comments`,
            data: new FormData(thisForm),
            contentType: false,
            processData: false,
            beforeSend: () => {
                // $(`.${FORM_CONTROL_CLASS}`, thisForm).removeClass(IS_INVALID_CLASS).addClass(IS_VALID_CLASS);
            },
            success: (data) => {
                const $commentsList = $("#js-comment-list");
                if ($commentsList.length === 0) return;

                if (data.success) {
                    $("ul", $commentsList).prepend(data.data);

                    // empty form
                    $($form[0]).find('input:not([type="hidden"]), textarea').each((idx, field) => {
                        field.value = "";
                    });

                    $($form[0]).removeClass('was-validated');
                } else {

                }
            },
            error: (jqXHR) => {
                // const respJSON = jqXHR.responseJSON;
                // Object.entries(respJSON.errors['validation_errors']).forEach(([errorField, errorMessage]) => {
                //     $(`#${errorField}`).removeClass('is-valid').addClass('is-invalid');
                //
                //     $(`#${errorField} + .invalid-feedback`).html(errorMessage);
                // })
                // const respJSON = jqXHR.responseJSON;
                // const fieldIds = Object.keys(respJSON);
                //
                // fieldIds.forEach(fieldId => {
                //     const field = $(`#${fieldId}`, thisForm);
                //
                //     field.removeClass(IS_VALID_CLASS).addClass(IS_INVALID_CLASS);
                //     field.parent().find(`.${INVALID_FEEDBACK_CLASS}`).clone().text(respJSON[fieldId]).appendTo(field.parent());
                // });

                // prepopulate form fields with entered values
                // highlight invalid form data
            }
        })
    })
})();