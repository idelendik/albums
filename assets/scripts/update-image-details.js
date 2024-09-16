import $ from 'jquery';

(() => {
    'use strict';

    const $imageDetailsForm = $('#js-form-edit-image-details');
    if ($imageDetailsForm.length === 0) return;

    $imageDetailsForm.on('submit', (e) => {
        e.preventDefault();

        const thisForm = e.currentTarget;

        $.ajax({
            method: "POST",
            url: `${process.env.BASE_URL}/images/edit`,
            data: new FormData(thisForm),
            contentType: false,
            processData: false,
            beforeSend: () => {
                // $(`.${FORM_CONTROL_CLASS}`, thisForm).removeClass(IS_INVALID_CLASS).addClass(IS_VALID_CLASS);
            },
            success: (data) => {
                $('.alert', $imageDetailsForm).remove();

                const html = `<div class="alert alert-${data.success ? 'success' : 'danger'} alert-dismissible" role="alert">
                        <div>${data.data.message}</div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>`;
                $imageDetailsForm.prepend(html);

                $($imageDetailsForm[0]).removeClass('was-validated');
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
    });
})();