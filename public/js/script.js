$('input[type="radio"]').on("click", function () {
    if ($(this).data("checked") === "true") {
        $(this).prop("checked", false);
        $(this).data("checked", "false");
    } else {
        $('input[name="' + $(this).attr("name") + '"]').data(
            "checked",
            "false"
        );
        $(this).data("checked", "true");
    }
});

$(".btn-submit").on("click", function () {
    formData = new FormData($("#edpsFillForm")[0]);
    // formData.forEach((value, key) => {
    //     console.log(key, value);
    // });

    Swal.fire({
        title: "Sedang mengirim...",
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
            $.ajax({
                url: $("#edpsFillForm").attr("action"),
                method: $('#edpsFillForm input[name="_method"]').val(), // atau 'POST', 'PUT', dll.
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                success: function (response) {
                    Swal.fire({
                        icon: response.status,
                        title: "Berhasil",
                        text: response.message,
                        customClass: {
                            confirmButton: "btn btn-primary",
                        },
                    });
                },
                error: function (xhr, status, error) {
                    Swal.fire({
                        icon: status,
                        title: "Opps..",
                        text: xhr.responseJSON.message,
                    });
                    // console.log(status);
                    // console.log(xhr);
                    // console.log(error);
                    // console.error(error);
                    console.error("Error:", error);
                },
            });
        },
    });
});

$(".btn-delete").on("click", function (e) {
    e.preventDefault();
    let link = $(this).attr("href");
    const csrfToken = $('meta[name="csrf-token"]').attr("content");
    Swal.fire({
        title: "Apakah anda yakin?",
        text: "Anda tidak akan dapat mengembalikan ini!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Iya, hapus sekarang!",
        customClass: {
            cancelButton: "btn btn-secondary me-3",
            confirmButton: "btn btn-primary",
        },
        buttonsStyling: false,
        reverseButtons: true,
    }).then(function (result) {
        if (result.isConfirmed) {
            fetch(link, {
                method: "DELETE",
                headers: {
                    "X-CSRF-TOKEN": csrfToken,
                    "Content-Type": "application/json",
                },
            })
                .then((response) => {
                    if (!response.ok) {
                        throw new Error(
                            "HTTP error, status = " + response.status
                        );
                    }
                    return response.json();
                })
                .then((res) => {
                    Swal.fire({
                        icon: res.status,
                        title: res.title,
                        text: res.message,
                        customClass: {
                            confirmButton: "btn btn-primary",
                        },
                    });

                    window.location.reload();
                })
                .catch((error) => {
                    Swal.fire({
                        icon: "error",
                        title: "Opps..",
                        text: "Terjadi Kesalahan",
                    });
                    console.error("Error:", error);
                });
        }
    });
});

$(".btn-delete").on("click", function (e) {
    e.preventDefault();
    let link = $(this).attr("href");
    const csrfToken = $('meta[name="csrf-token"]').attr("content");
    Swal.fire({
        title: "Apakah anda yakin?",
        text: "Anda tidak akan dapat mengembalikan ini!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Iya, hapus sekarang!",
        customClass: {
            cancelButton: "btn btn-secondary me-3",
            confirmButton: "btn btn-primary",
        },
        buttonsStyling: false,
        reverseButtons: true,
    }).then(function (result) {
        if (result.isConfirmed) {
            $.ajax({
                url: link,
                method: "DELETE",
                contentType: "application/json",
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                success: function (response) {
                    Swal.fire({
                        icon: response.status,
                        title: response.title,
                        text: response.message,
                        customClass: {
                            confirmButton: "btn btn-primary",
                        },
                    });
                    window.location.reload();
                },
                error: function (xhr, status, error) {
                    Swal.fire({
                        icon: status,
                        title: "Opps..",
                        text: xhr.responseJSON.message,
                    });
                    console.error("Error:", error);
                },
            });
        }
    });
});

let form = $("#programStudiForm")[0];
let formData = new FormData(form[0]);
if (form.checkValidity()) {
} else {
    form.reportValidity();
}
