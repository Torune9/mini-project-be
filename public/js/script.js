$(document).ready(function() {
    // get data table
    var table = $('#tasksTable').DataTable({
        ajax: '/taskcontroller/gettasks',
        columns: [
            { data: 'id' },
            { data: 'judul' },
            {
                data: 'status',
                render: function(data, type, row) {
                    let statusText = data == 1 ? 'Finished' : 'Unfinished';
                    let checked = data == 1 ? 'checked' : '';
                    return `
                        <div class="status-wrapper">
                            <input type="checkbox" class="status-checkbox" data-id="${row.id}" ${checked}>
                            <span class="status-text">${statusText}</span>
                            <span class="loading-icon" style="display: none;">🔄</span>
                        </div>
                    `;
                }
            },
            {
                data: 'id',
                render: function(data) {
                    return `
                        <button class="bg-blue-500 p-1 rounded-sm text-white w-24 hover:bg-blue-400 transition-all ease duration-200" data-id="${data}">Edit</button>
                        <button class="bg-red-500 p-1 rounded-sm text-white w-24 hover:bg-red-400 transition-all ease duration-200" data-id="${data}">Hapus</button>`;
                }
            }
        ]
        
    });


    // submit form
    $('#taskForm').on('submit', function(e) {
        e.preventDefault();

        $.post('/taskcontroller/create', $(this).serialize(), function(response) {
            if (response.success) {

                table.ajax.reload();

                $('#taskForm')[0].reset();
            } else {
                alert('Gagal menambahkan tugas.');
            }
        }).fail(function() {
            alert('Terjadi kesalahan, silakan coba lagi.');
        });
    });

    // set status
    $('#tasksTable').on('change', '.status-checkbox', function() {
        let id = $(this).data('id');
        let status = this.checked ? 1 : 0;
        let $statusWrapper = $(this).closest('.status-wrapper');
        let $loadingIcon = $statusWrapper.find('.loading-icon');
        let $statusText = $statusWrapper.find('.status-text');

        // Tampilkan loading icon dan sembunyikan checkbox sementara
        $(this).hide();
        $loadingIcon.show();

        $.post(`/taskcontroller/update/${id}`, { status: status }, function() {
            let statusText = status === 1 ? 'Finished' : 'Unfinished';

            // Perbarui teks status dan tampilkan kembali checkbox
            $statusText.text(statusText);
            $loadingIcon.hide();
            $statusWrapper.find('.status-checkbox').show();
        }).fail(function() {
            alert('Gagal memperbarui status.');

            // Kembalikan checkbox ke status sebelumnya jika gagal
            $loadingIcon.hide();
            $statusWrapper.find('.status-checkbox').prop('checked', !status).show();
        });
    });


    $('#tasksTable').on('click', '.delete-btn', function() {
        let id = $(this).data('id');
        if (confirm('Yakin ingin menghapus?')) {
            $.post(`/taskcontroller/delete/${id}`, function() {
                table.ajax.reload();
            });
        }
    });
});