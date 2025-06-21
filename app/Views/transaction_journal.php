<?= $this->extend('index'); ?>
<?= $this->section('content'); ?>

<div class="container mt-4">
    <h4 class="mb-4">Transaction Journal</h4>

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Source</th>
                <th>Total Amount</th>
                <th>Description</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $count = 1; foreach ($transactions as $trx): ?>
                <tr>
                    <td><?= $count++ ?></td>
                    <td><?= esc($trx['source']) ?></td>
                    <td><?= number_format($trx['total_debit'], 2) ?></td>
                    <td><?= esc($trx['description']) ?></td>
                    <td><?= esc($trx['transaction_date']) ?></td>
                    <td>
                        <button class="btn btn-sm btn-primary toggle-details" data-id="<?= $trx['transaction_id'] ?>">
                            <i class="fa fa-eye"></i>
                        </button>
                    </td>
                </tr>

                <!-- Expandable Details -->
                <tr class="details-row d-none" id="details-<?= $trx['transaction_id'] ?>">
                    <td colspan="6">
                        <table class="table table-sm table-bordered mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Account</th>
                                    <th>Debit</th>
                                    <th>Credit</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; foreach ($trx['entries'] as $entry): ?>
                                    <tr>
                                        <td><?= $i++ ?></td>
                                        <td><?= esc($entry['account_name']) ?></td>
                                        <td><?= $entry['debit'] > 0 ? number_format($entry['debit'], 2) : '-' ?></td>
                                        <td><?= $entry['credit'] > 0 ? number_format($entry['credit'], 2) : '-' ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script>
    document.querySelectorAll('.toggle-details').forEach(button => {
        button.addEventListener('click', function () {
            const id = this.getAttribute('data-id');
            const detailsRow = document.getElementById('details-' + id);
            detailsRow.classList.toggle('d-none');
        });
    });
</script>

<?= $this->endSection(); ?>
