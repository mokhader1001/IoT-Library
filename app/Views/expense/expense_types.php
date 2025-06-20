<?php echo $this->extend('index'); ?>

<?php echo $this->section('content'); ?>
<div class="page-breadcrumb py-3">
    <div class="row">
        <div class="col-md-6 offset-md-1 align-self-center">
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-white px-3 py-2 shadow-sm rounded">
                        <li class="breadcrumb-item"><a href="<?= base_url() ?>/admin">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Expense Types</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#expenseModal" style="margin-left:90%">
    <i class="fas fa-plus"></i> Add Expense Type
</button>

<div class="container-fluid">
    <div class="card col-md-12">
        <div class="card-body">
            <table id="manageTable" class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="expenseModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border border-primary shadow">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title"><i class="fas fa-edit me-1"></i> Add/Edit Expense Type</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form id="expenseForm">
                <input type="hidden" name="expense_id" id="expense_id">
                <div class="modal-body">
                    <div class="mb-2">
                        <label>Expense Name</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success btn_submit_new"><i class="fas fa-save me-1"></i> Save</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    const base_url = "<?= base_url() ?>";

    $(document).ready(function () {
        manageTable = $('#manageTable').DataTable({
            ajax: base_url + 'expense_type/fetch_expense_types',
            order: []
        });
    });

    $(document).on('click', '.btn-edit-expense', function () {
        $('#expense_id').val($(this).data('id'));
        $('[name="name"]').val($(this).data('name'));
        $('.btn_submit_new').html('<i class="fas fa-save me-1"></i> Update').removeClass('btn-success').addClass('btn-warning');
        $('#expenseModal').modal('show');
    });

    $(document).on('click', '.btn-delete-expense', function () {
        const id = $(this).data('id');
        const name = $(this).data('name');

        Swal.fire({
            title: `Delete ${name}?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.post(base_url + 'expense_type/save_expense_type', { expense_id: id, action_type: 'delete' }, function (res) {
                    if (res.success) {
                        Swal.fire('Deleted!', res.message, 'success');
                        manageTable.ajax.reload(null, false);
                    } else {
                        Swal.fire('Error!', res.message, 'error');
                    }
                });
            }
        });
    });

    $(document).on('click', '.btn-status-toggle', function () {
        const id = $(this).data('id');
        const newStatus = $(this).data('status');

        Swal.fire({
            title: `Change status to ${newStatus}?`,
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Yes',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                $.post(base_url + 'expense_type/save_expense_type', {
                    expense_id: id,
                    action_type: 'toggle_status',
                    status: newStatus
                }, function (res) {
                    Swal.fire(res.success ? 'Updated!' : 'Failed', res.message, res.success ? 'success' : 'error');
                    manageTable.ajax.reload(null, false);
                });
            }
        });
    });

    $(document).on('submit', '#expenseForm', function (event) {
    event.preventDefault();
    $('.btn_submit_new').html('<span class="spinner-grow spinner-grow-sm" role="status"></span> Saving...');
    $('.btn_submit_new').attr('disabled', true);

    const form = $('#expenseForm')[0];
    const formData = new FormData(form);
    const isEdit = $('#expense_id').val() !== '';
    formData.append('action_type', isEdit ? 'update' : 'insert');

    $.ajax({
        url: base_url + 'expense_type/save_expense_type',
        method: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: function (res) {
            if (res.success) {
                Swal.fire('Success!', res.message, 'success');
                $('#expenseModal').modal('hide');
                $('#expenseForm')[0].reset();
                manageTable.ajax.reload(null, false);
            } else {
                Swal.fire('Error!', res.message, 'error');
            }
            $('.btn_submit_new').html('Save').attr('disabled', false);
        },
        error: function () {
            Swal.fire('Error!', 'Server error occurred.', 'error');
            $('.btn_submit_new').html('Save').attr('disabled', false);
        }
    });
});

</script>

<?php echo $this->endSection(); ?>
