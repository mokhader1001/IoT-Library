<?php echo $this->extend('index'); ?>
<?php echo $this->section('content'); ?>
<br><br> <br><br>

<div class="page-breadcrumb py-3">
    <div class="row">
        <div class="col-md-6 offset-md-1 align-self-center">
           
        </div>
    </div>
</div>

<!-- Tabs -->
<ul class="nav nav-tabs justify-content-start mx-4 mt-3" id="expenseTabs" role="tablist">
    <li class="nav-item me-3" role="presentation">
        <button class="nav-link active d-flex align-items-center" id="types-tab" data-bs-toggle="tab" data-bs-target="#types" type="button" role="tab">
            <i class="fas fa-list-alt me-2"></i> Expense Types
        </button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link d-flex align-items-center" id="payments-tab" data-bs-toggle="tab" data-bs-target="#payments" type="button" role="tab">
            <i class="fas fa-money-check-alt me-2"></i> Expense Payments
        </button>
    </li>
</ul>

<!-- Tab Content -->
<div class="tab-content container-fluid mt-3">

    <!-- Expense Types Tab -->
    <div class="tab-pane fade show active" id="types" role="tabpanel">
        <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#expenseModal" style="margin-left:90%">
            <i class="fas fa-plus"></i> Add Expense Type
        </button>
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

    <!-- Expense Payments Tab -->
<div class="tab-pane fade" id="payments" role="tabpanel">
    <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#paymentModal" style="margin-left:90%">
        <i class="fas fa-plus"></i> Add Payment
    </button>

    <!-- Centered Table Card -->
    <div class="d-flex justify-content-center">
        <div class="card shadow-sm" style="min-width: 85%;">
            <div class="card-body">
                <table id="paymentTable" class="table table-striped table-bordered w-100 mx-auto">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Expense</th>
                            <th>Price</th>
                            <th>Account</th>
                            <th>Description</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Expense Type -->
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

<!-- Modal for Expense Payment -->
<div class="modal fade" id="paymentModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg"> <!-- Use modal-lg for better spacing -->
        <div class="modal-content border border-success shadow">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title"><i class="fas fa-receipt me-1"></i> Add/Edit Payment</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form id="paymentForm">
                <input type="hidden" name="payment_id" id="payment_id">
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label>Expense Type</label>
                            <select name="expense_id" id="expense_id_select" class="form-control" required>
                                <option value="">-- Select Expense Type --</option>
                                <?php foreach ($expense_types as $type): ?>
                                <option value="<?= $type['expense_id'] ?>" data-name="<?= esc($type['name']) ?>">
                                    <?= esc($type['name']) ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                            <input type="hidden" name="expense_name" id="expense_name">

                        </div>

                        <div class="col-md-6">
                            <label>Price</label>
                            <input type="number" step="0.01" name="price" class="form-control" required>
                        </div>

                        <div class="col-md-6">
                            <label for="account_id">Select Account</label>
                          <select name="account_id" id="account_id" class="form-control" required>
                            <option value="">-- Select Account --</option>
                            <?php foreach ($accounts as $account): ?>
                                <option value="<?= esc($account->account_id) ?>" data-name="<?= esc($account->account_name) ?>">
                                    <?= esc($account->account_name) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                                <input type="hidden" name="account_name" id="account_name">

                        </div>

                        <div class="col-md-6">
                            <label>Payment Date</label>
                                <input type="date" name="payment_date" class="form-control" required>
                        </div>

                        <div class="col-md-12">
                            <label>Description</label>
                            <textarea name="description" class="form-control" rows="2"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success btn_submit_payment"><i class="fas fa-save me-1"></i> Save</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

<br><br><br><br>
<br><br>
<br><br>
<br><br>
<br><br>
<br><br>
<br><br>
<br><br>
<br><br><br><br>
<br><br>
<br><br>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> 
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> 
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script> 
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> 

<script>
const base_url = "<?= base_url() ?>";
$('#account_id').on('change', function () {
    const selectedName = $(this).find('option:selected').data('name');
    $('#account_name').val(selectedName);
});


$('#expense_id_select').on('change', function () {
    const selectedName = $(this).find('option:selected').data('name');
    $('#expense_name').val(selectedName);
});


$(document).ready(function () {
    // DataTable for Expense Types
    let manageTable = $('#manageTable').DataTable({
        ajax: base_url + 'expense_type/fetch_expense_types',
        order: []
    });

let paymentTable = $('#paymentTable').DataTable({
    ajax: base_url + 'fetch_expense_payments',
    order: [],
    columns: [
        { title: '#' },
        { title: 'Expense' },
        { title: 'Price' },
        { title: 'Account' },
        { title: 'Description' },
        { title: 'payment_date' },
        { title: 'Actions' }
    ]
});

    // Load expense types into dropdown
    $.get(base_url + 'expense_type/fetch_expense_types', function(res) {
        const select = $('#expense_id_select');
        res.forEach(type => {
            if (type.status === 1) {
                select.append(`<option value="${type.expense_id}">${type.name}</option>`);
            }
        });
    }, 'json');

    // Form Submit - Expense Type
    $(document).on('submit', '#expenseForm', function (e) {
        e.preventDefault();
        $('.btn_submit_new').html('<span class="spinner-grow spinner-grow-sm"></span> Saving...');
        $('.btn_submit_new').attr('disabled', true);

        const formData = new FormData(this);
        const isEdit = $('#expense_id').val() !== '';
        formData.append('action_type', isEdit ? 'update' : 'insert');

        $.ajax({
            url: base_url + 'expense_type/save_expense_type',
            method: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function (res) {
                if (res.success) {
                    Swal.fire('Success!', res.message, 'success');
                    $('#expenseModal').modal('hide');
                    $('#expenseForm')[0].reset();
                    manageTable.ajax.reload(null, false);
                    window.location.reload(); // Reload the page to refresh the dropdown
                } else {
                    Swal.fire('Error!', res.message, 'error');
                }
                $('.btn_submit_new').html('Save').removeAttr('disabled');
            }
        });
    });

    $(document).on('submit', '#paymentForm', function (e) {
        e.preventDefault();
        $('.btn_submit_payment').html('<span class="spinner-grow spinner-grow-sm"></span> Saving...');
        $('.btn_submit_payment').attr('disabled', true);

        const formData = new FormData(this);
        const isEdit = $('#payment_id').val() !== '';
        formData.append('action_type', isEdit ? 'update' : 'insert');
        formData.append('exppayment_id', $('#payment_id').val());

        $.ajax({
            url: base_url + 'save_expense_payment',
            method: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function (res) {
                if (res.success) {
                    Swal.fire('Success!', res.message, 'success');
                    $('#paymentModal').modal('hide');
                    $('.modal-backdrop').remove();

                    $('#paymentForm')[0].reset();
                    paymentTable.ajax.reload(null, false);
                } else {
                    Swal.fire('Error!', res.message, 'error');
                }
                $('.btn_submit_payment').html('<i class="fas fa-save me-1"></i> Save');
                $('.btn_submit_payment').removeAttr('disabled');
            }
        });
    });

    // Handle Edit Button
    $(document).on('click', '.btn-edit-payment', function () {
        $('#payment_id').val($(this).data('id'));
        $('#expense_id_select').val($(this).data('expense-id'));
        $('[name="price"]').val($(this).data('price'));
        $('[name="account_id"]').val($(this).data('account-id'));
        $('[name="description"]').val($(this).data('description'));
        $('[name="payment_date"]').val($(this).data('payment_date')); // ✅ fix this name

        $('.btn_submit_payment')
            .html('<i class="fas fa-sync-alt me-1"></i> Update')
            .removeClass('btn-success')
            .addClass('btn-warning');

        $('#paymentModal').modal('show');
    });

    // Edit Expense Type
    $(document).on('click', '.btn-edit-expense', function () {
        $('#expense_id').val($(this).data('id'));
        $('[name="name"]').val($(this).data('name'));
        $('.btn_submit_new').html('<i class="fas fa-save me-1"></i> Update')
                           .removeClass('btn-success').addClass('btn-warning');
        $('#expenseModal').modal('show');
    });

    // Delete Expense Type
    $(document).on('click', '.btn-delete-expense', function () {
        const id = $(this).data('id');
        const name = $(this).data('name');
        Swal.fire({ title: `Delete ${name}?`, icon: 'warning', showCancelButton: true }).then((result) => {
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

    // Edit Expense Payment
$(document).on('click', '.btn-edit-payment', function () {
    $('#payment_id').val($(this).data('id'));
    $('#expense_id_select').val($(this).data('expense-id'));      // ✅ fix here
    $('[name="price"]').val($(this).data('price'));
    $('[name="account_id"]').val($(this).data('account-id'));     // ✅ fix here
    $('[name="description"]').val($(this).data('description'));
    $('[name="payment_"]').val($(this).data('payment_date'));

    $('.btn_submit_payment')
        .html('<i class="fas fa-sync-alt me-1"></i> Update')
        .removeClass('btn-success')
        .addClass('btn-warning');

    $('#paymentModal').modal('show');
});



    // Delete Expense Payment
    $(document).on('click', '.btn-delete-payment', function () {
        const id = $(this).data('id');
        const desc = $(this).data('description');
        Swal.fire({ title: `Delete "${desc}"?`, icon: 'warning', showCancelButton: true }).then((result) => {
            if (result.isConfirmed) {
                $.post(base_url + 'save_expense_payment', { payment_id: id, action_type: 'delete' }, function (res) {
                    if (res.success) {
                        Swal.fire('Deleted!', res.message, 'success');
                        paymentTable.ajax.reload(null, false);
                    } else {
                        Swal.fire('Error!', res.message, 'error');
                    }
                });
            }
        });
    });
});
</script>

<?php echo $this->endSection(); ?>