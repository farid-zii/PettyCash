let nama = $('#nama').value;
    var i = 0;
    $('#add').click(function () {
        ++i;
        $('#table').append(
            `<tr>
            <td><input type="text" class="form-control" name="inputs[+i+][nama]" placeholder=""></td>
            <td><input type="text" class="form-control" name="inputs[+i+][email]" placeholder=""></td>
            <td><input type="text" class="form-control" name="inputs[+i+][nilai]" placeholder=""></td>
            <td><button type="button" class="btn btn-danger remove-table-row">Hapus</button></td>
            </tr>`
        );
    });

    $(document).on('click', '.remove-table-row', function () {
        $(this).parents('tr').remove();
    });
