window.addEventListener("DOMContentLoaded", () => {
    $("#tsubscribe").on("submit", function (e) {
        e.preventDefault();
        const csrfToken = $('meta[name="csrf-token"]').attr("content");

        $(".success_msg").html(
            "<p class='mt-2 text-red-500 font-bold cursor-pointer removeElem'><strong>Processing...</strong></p>"
        );

        $.ajax({
            method: "POST",
            url: "/subscribe",
            contentType: "application/x-www-form-urlencoded; charset=UTF-8",
            dataType: "JSON",
            data: $("#temail").serialize(),
            headers: {
                "X-CSRF-TOKEN": csrfToken,
            },
        })
        .done(function(response) {
            $(".success_msg").html(
                "<p class='mt-2 text-green-500 font-bold cursor-pointer removeElem'><strong>Success!</strong> Your request has been processed successfully. Thank you for choosing us!</p>"
            );
            $("#temail").val("");
        })
        .fail(function(xhr) {
            var err = xhr.responseJSON;

            $(".success_msg").html(
                "<p class='mt-2 text-red-500 font-bold cursor-pointer removeElem'>Oops!! " +
                    err.error +
                    "</p>"
            );
            $('#temail').val("");
        });
    });

    $(document).on("click", ".removeElem", function (e) {
        $(this).remove();
    });
});
