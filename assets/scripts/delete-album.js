'use strict';

import $ from "jquery";

$('[id^="js-delete-album"]').on('click', (e) => {
    $.ajax({
        method: "POST",
        url: `${process.env.BASE_URL}/albums`,
        data: {"album_id": $(e.currentTarget).data('album-id'), "_method": "DELETE"}
    })
        .done(() => {
            location.href = `${process.env.BASE_URL}`;
        })
        .fail((jqXHR, textStatus) => console.log(textStatus));
});