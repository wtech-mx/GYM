function deleteData(id) {
    Swal.fire({
        title: '¿Está seguro?',
        text: "¡No podrás revertir esto!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: '¡Sí, bórralo!'
    }).then((result) => {
        if (result.value) {
            document.getElementById('delete-form-' + id).submit();
        }
    })
}

function resetForm(formId) {
    document.getElementById(formId).reset();
}

$(document).ready(function() {
    // Dropify
    $('.dropify').dropify();

    // Select2
    $('.select').each(function () {
        $(this).select2();
    });
});
