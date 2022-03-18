$(function () {
    const spinnerInsert = document.querySelector("#spinnerInsert");
    spinnerInsert.style.display = "none";

    $("#frm-appointment").on("submit", (e) => {
        e.preventDefault();
        $("#btnAdd").hide();
        spinnerInsert.style.display = "flex";

        const document = $("#document").val();
        const name = $("#name").val();
        const lastName = $("#lastName").val();
        const pet = $("#pet").val();
        const typePet = $("#typePet").val();
        const date = $("#date").val();
        const time = $("#time").val();

        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            url: "appointment/create",
            type: "POST",
            data: {
                document,
                name,
                lastName,
                pet,
                typePet,
                date,
                time,
            },
            success: function (result) {
                $("#response").html(result);
                spinnerInsert.style.display = "none";
                $("#btnAdd").show();
            },
        });
    });

    $("#search-appointment").on("click", (e) => {
        $("#search-appointment").attr("disabled", true);
        const date = $("#dateAppointment").val();

        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            url: "appointment/searchByDate",
            type: "POST",
            data: {
                date,
            },
            success: function (result) {
                $("#response").html(result);
                $("#search-appointment").attr("disabled", false);
            },
        });
    });

    $(document).on("click", (e) => {
        if (e.target.id === "btn-edit") {
            $("#tableAppointment").find("button").attr("disabled", "disabled");
            const id = e.target.value;
            $.ajax({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                url: "appointment/modalUpdate",
                type: "POST",
                data: {
                    id,
                },
                success: function (result) {
                    $("#response").html(result);
                    $("#tableAppointment")
                        .find("button")
                        .removeAttr("disabled");
                },
            });
        } else if (e.target.id === "btn-update-appointment") {
            const id = e.target.value;
            $("#btn-update-appointment").attr("disabled", true);
            const date = $("#appointmentDate").val();
            const time = $("#appointmentTime").val();
            $.ajax({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                url: "appointment/update",
                type: "PUT",
                data: {
                    id,
                    date,
                    time,
                },
                success: function (result) {
                    $("#response").html(result);
                    $("#btn-update-appointment").attr("disabled", false);
                },
            });
        }
    });
});
