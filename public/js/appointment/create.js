$(function () {
    $('#frm-appointment').on('submit', (e) => {
        e.preventDefault();
        const document = $('#document').val();
        const name = $('#name').val();
        const lastName = $('#lastName').val();
        const pet = $('#pet').val();
        const typePet = $('#typePet').val();
        const date = $('#date').val();
        const time = $('#time').val();

        $.ajax({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            url: "appointment/create",
            type: "POST",
            data: {
                document, name, lastName, pet, typePet, date, time
            },
            success: function (result) {
                $('#response').html(result);
            }
        });
    });

    $('#search-appointment').on('click', (e) => {

        const date = $('#dateAppointment').val();

        $.ajax({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            url: "appointment/searchByDate",
            type: "POST",
            data: {
                date
            },
            success: function (result) {
                $('#response').html(result);
            }
        });
    });
});