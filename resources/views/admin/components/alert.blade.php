<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<script>
    $(document).on("click", ".delete-item", function () {
        var deleteEndpoint = $(this).data('url');
        // Konfirmasi pengguna sebelum menghapus data
        var confirmation = confirm("Apakah Anda yakin ingin menghapus data?");

        if (confirmation) {
            // Melakukan permintaan AJAX DELETE
            $.ajax({
                url: deleteEndpoint,
                type: "DELETE",
                data: {
                    _token: "{{ csrf_token() }}"
                },
                success: function (result) {
                    // Tindakan yang diambil jika penghapusan berhasil
                    console.log("Data berhasil dihapus", result);
                    Swal.fire({
                        icon: "success",
                        title: "Sukses",
                        text: "Data berhasil dihapus",
                    });
                    if (typeof table === 'undefined') {
                        window.location.reload();
                    } else {
                        table.draw();
                    }
                },
                error: function (error) {
                    // Tindakan yang diambil jika terjadi kesalahan
                    console.error("Terjadi kesalahan saat menghapus data", error);
                }
            });
        }
    });

    @if(session('error'))
    Swal.fire({
        title: "Opss..",
        text: "{{session('error')}}",
        icon: "error"
    });
    @elseif(session('success'))
    Swal.fire({
        title: "Success",
        text: "{{session('success')}}",
        icon: "success"
    });
    @elseif(session('warning'))
    Swal.fire({
        title: "Warning",
        text: "{{session('warning')}}",
        icon: "error"
    });
    @endif

</script>
