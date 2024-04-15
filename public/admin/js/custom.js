$(document).ready(function () {
    $("#nav_item").removeClass("Active");
    $("#nav_link").removeClass("Inactive");

    // datatable injection
    $("#sectionsTable").DataTable();

    // datatable injection
    $("#categoriesTable").DataTable();

    // check current password
    $("#currentPassword").keyup(function () {
        var currentPassword = $("#currentPassword").val();

        $.ajax({
            type: "post",
            url: "/admin/check-admin-password",
            data: { currentPassword: currentPassword },
            success: function (resp) {
                if (resp == "false") {
                    $("#passwordCheckMessage").html(
                        "<font color='red'>Mot de passe inconforme</font>"
                    );
                } else if (resp == "true") {
                    $("#passwordCheckMessage").html(
                        "<font color='green'>Mot de passe confourme</font>"
                    );
                }
            },
            error: function () {
                alert(Error);
            },
        });
    });

    // update admins status
    $(document).on("click", ".updateAdminsStatus", function () {
        var status = $(this).children("i").attr("status");
        var admin_id = $(this).attr("admin_id");
        $.ajax({
            type: "post",
            url: "/admin/update-admin-status",
            data: { status: status, admin_id: admin_id },
            success: function (resp) {
                if (resp["status"] == 0) {
                    $("#admin-" + admin_id).html(
                        "<i style='font-size: 30px; color: #666;' class='mdi mdi mdi-toggle-switch-off' status='Inactive'></i>"
                    );
                    $("#status-" + admin_id).text("Inactive");
                } else if (resp["status"] == 1) {
                    $("#admin-" + admin_id).html(
                        "<i style='font-size: 30px;' class='mdi mdi mdi-toggle-switch' status='Active'></i>"
                    );
                    $("#status-" + admin_id).text("Active");
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert("Error :" + errorThrown);
            },
        });
    });

    // update sections status
    $(document).on("click", ".updateSectionsStatus", function () {
        var status = $(this).children("i").attr("status");
        var section_id = $(this).attr("section_id");
        $.ajax({
            type: "post",
            url: "/admin/update-section-status",
            data: { status: status, section_id: section_id },
            success: function (resp) {
                if (resp["status"] == 0) {
                    $("#section-" + section_id).html(
                        "<i style='font-size: 30px; color: #666;' class='mdi mdi mdi-toggle-switch-off' status='Inactive'></i>"
                    );
                    $("#status-" + section_id).text("Inactive");
                } else if (resp["status"] == 1) {
                    $("#section-" + section_id).html(
                        "<i style='font-size: 30px;' class='mdi mdi mdi-toggle-switch' status='Active'></i>"
                    );
                    $("#status-" + section_id).text("Active");
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert("Error :" + errorThrown);
            },
        });
    });

    // update category status
    $(document).on("click", ".updatecategoriesStatus", function () {
        var status = $(this).children("i").attr("status");
        var category_id = $(this).attr("category_id");
        $.ajax({
            type: "post",
            url: "/admin/update-category-status",
            data: { status: status, category_id: category_id },
            success: function (resp) {
                if (resp["status"] == 0) {
                    $("#category-" + category_id).html(
                        "<i style='font-size: 30px; color: #666;' class='mdi mdi mdi-toggle-switch-off' status='Inactive'></i>"
                    );
                    $("#status-" + category_id).text("Inactive");
                } else if (resp["status"] == 1) {
                    $("#category-" + category_id).html(
                        "<i style='font-size: 30px;' class='mdi mdi mdi-toggle-switch' status='Active'></i>"
                    );
                    $("#status-" + category_id).text("Active");
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert("Error :" + errorThrown);
            },
        });
    });
});

/**
 *
 * confirm deletion sweet alert - i have to moove the jquery code
 *  the document ready to get the sweet alert code work
 */
$(".confirmDelete").click(function () {
    var module = $(this).attr("module");
    var module_id = $(this).attr("module_id");
    Swal.fire({
        title: "Êtes-vous sûr de vouloir supprimer cette " + module + " ?",
        text: "Vous ne pouvez pas revenir en arrière",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Oui ! Supprimer",
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                title: "Supprimer!",
                text: module + " a été supprimer avec success",
                icon: "success",
            });

            window.location = "/admin/delete-" + module + "/" + module_id;
        }
    });
});
