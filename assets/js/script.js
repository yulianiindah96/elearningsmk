$(function () {
    $('.tombolTambahData').on('click', function () {
        $('#newRoleModalLabel').html("Tambah Akses");
        $('.modal-footer button[type=submit]').html("Tambah Akses");
    })

    $('.tampilModalUbah').on('click', function () {
        $('#newRoleModalLabel').html("Ubah Nama Akses");
        $('.modal-footer button[type=submit]').html("Ubah Akses");

        const id = $(this).data('id');
        $.ajax({
            url: 'http://localhost/elearningsmk/application/ubahrole/',
            data: { id, id },
            method: 'post',
            dataType: 'json',
            success: function (data) {

            }
        })

    })
})