'use strict';

import $ from "jquery";

$('#js-delete-image').on('click', (e) => {
    $.ajax({
        method: "POST",
        url: `${process.env.BASE_URL}/images`,
        data: {"image_id": $(e.currentTarget).data('image-id'), "_method": "DELETE"}
    })
        .done(() => {
            location.href = location.pathname.slice(0, location.pathname.lastIndexOf('/'));
        })
        .fail((jqXHR, textStatus) => console.log(textStatus));
});