$(document).ready(function () {
    $('#btn-add').click(function () {
        var sizes = $(this).data('sizes');
        var options = '';

        for (var i = 0; i < sizes.length; i++) {
            options += `<option value="${sizes[i]['id']}">${sizes[i]['size']}</option>`
        }

        $('#group-add').append(`
                <div class="d-flex mb-1">
                    <select class="custom-select mr-1" name="sizes[]">
                        ${options}
                    </select>
                    <input type="number" class="form-control mr-1" name="quantities[]">
                    <button type="button" class="btn btn-danger btn-remove">Remove</button>
                </div>
            `);

        const btnRemoves = $('#group-add .btn-remove');
        if (btnRemoves.length > 1) {
            btnRemoves.removeClass('disabled');
        }
    });
    $('#group-add').on('click', '.btn-remove:not(.disabled)', function () {
        $(this).closest('.d-flex').remove();
        const btnRemoves = $('#group-add .btn-remove');
        if (btnRemoves.length === 1) {
            btnRemoves.addClass('disabled');
        }
    });

    $('#image').on('change', function () {
        //get the file name
        var fileName = $(this).val();
        //replace the "Choose a file" label
        $(this).next('.custom-file-label').html(fileName);
    });
});
