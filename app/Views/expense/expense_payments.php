<?= $this->extend("index"); ?>

<?= $this->section('content'); ?>
<div class="page-breadcrumb py-3">
    <div class="row">
        <div class="col-md-6 offset-md-1 align-self-center">
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-white px-3 py-2 shadow-sm rounded">
                        <li class="breadcrumb-item"><a href="<?= base_url() ?>/admin">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Expense Payments</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#expensePaymentModal" style="margin-left:90%">
    <i class="fas fa-plus"></i> Add Expense Payment
</button>

<div class="container-fluid">
    <div class="card col-md-12">
        <div class="card-body">
            <table id="manageTable" class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Expense Type</th>
                        <th>Price</th>
                        <th>Account</th>
                        <th>Descriptions</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="expensePaymentModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border border-primary shadow">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title"><i class="fas fa-money-bill-wave me-1"></i> Add/Edit Expense Payment</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form id="expensePaymentForm">
                <input type="hidden" name="exppayment_id" id="exppayment_id">
                <div class="modal-body">
                    <div class="mb-2">
                        <label>Expense Type</label>
                        <select name="expense_id" class="form-select" required>
                            <option value="">-- Select --</option>
                            <?php foreach ($expense_types as $type): ?>
                                <option value="<?= $type['expense_id']; ?>"><?= $type['name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-2">
                        <label>Price</label>
                        <input type="number" step="0.01" name="price" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label>Account</label>
                        <select name="account_id" class="form-select" required>
                            <option value="">-- Select --</option>
                            <?php foreach ($accounts as $acc): ?>
                                <option value="<?= $acc['account_id']; ?>"><?= $acc['account_name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-2">
                        <label>Descriptions</label>
                        <textarea name="descriptions" class="form-control" rows="2"></textarea>
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

<script>
const base_url = "<?= base_url() ?>";

$(document).ready(function () {
    manageTable = $('#manageTable').DataTable({
        ajax: base_url + 'fetch_expense_payments',
        order: []
    });
});

$(document).on('click', '.btn-edit-payment', function () {
    $('#exppayment_id').val($(this).data('id'));
    $('[name="expense_id"]').val($(this).data('expense_id'));
    $('[name="price"]').val($(this).data('price'));
    $('[name="account_id"]').val($(this).data('account_id'));
    $('[name="descriptions"]').val($(this).data('descriptions'));
    $('.btn_submit_new').html('<i class="fas fa-save me-1"></i> Update').removeClass('btn-success').addClass('btn-warning');
    $('#expensePaymentModal').modal('show');
});

$(document).on('click', '.btn-delete-payment', function () {
    const id = $(this).data('id');
    Swal.fire({
        title: `Delete this payment?`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then(result => {
        if (result.isConfirmed) {
            $.post(base_url + 'save_expense_payment', { exppayment_id: id, action_type: 'delete' }, function (res) {
                Swal.fire(res.success ? 'Deleted!' : 'Error!', res.message, res.success ? 'success' : 'error');
                manageTable.ajax.reload(null, false);
            });
        }
    });
});

$(document).on('submit', '#expensePaymentForm', function (e) {
    e.preventDefault();
    $('.btn_submit_new').html('<span class="spinner-grow spinner-grow-sm"></span> Saving...').attr('disabled', true);
    const formData = new FormData(this);
    $.ajax({
        url: base_url + 'expense_payments/save_expense_payment',
        method: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: function (res) {
            if (res.success) {
                Swal.fire('Saved!', res.message, 'success');
                $('#expensePaymentModal').modal('hide');
                $('#expensePaymentForm')[0].reset();
                manageTable.ajax.reload(null, false);
            } else {
                Swal.fire('Error!', res.message, 'error');
            }
        },
        complete: function () {
            $('.btn_submit_new').html('<i class="fas fa-save me-1"></i> Save').attr('disabled', false);
        }
    });
});
</script>

<?= $this->endSection(); ?>
