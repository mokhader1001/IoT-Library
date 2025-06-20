<?= $this->extend('index'); ?>
<?= $this->section('content'); ?>
<br> <br>
<br>
<br>
<br>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Library Payment Report</h3>
        <div>
            <button class="btn btn-outline-primary btn-sm" onclick="printTable()">🖨 Print</button>
            <a href="<?= base_url('payment/export_pdf') ?>" target="_blank" class="btn btn-outline-danger btn-sm">📄 Export PDF</a>
            <button class="btn btn-outline-success btn-sm" onclick="exportToExcel()">📁 Export Excel</button>
        </div>
    </div>

    <div id="printableArea">
        <table class="table table-bordered table-striped" id="paymentTable">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Username</th>
                    <th>Card Tag</th>
                    <th>Amount</th>
                    <th>Description</th>
                    <th>Payment Method</th>
                    <th>Payment Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($payments)) : ?>
                    <?php foreach ($payments as $index => $row) : ?>
                        <tr>
                            <td><?= $index + 1 ?></td>
                            <td><?= esc($row['username']) ?></td>
                            <td><?= esc($row['card_tag']) ?></td>
                            <td>$<?= esc($row['price']) ?></td>
                            <td><?= esc($row['desriptions']) ?></td>
                            <td><?= esc($row['payment_method']) ?></td>
                            <td><?= esc($row['payment_date']) ?></td>
                            <td><?= esc($row['status']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr><td colspan="8" class="text-center">No records found.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
function printTable() {
    const printContent = document.getElementById("printableArea").innerHTML;
    const originalContent = document.body.innerHTML;
    document.body.innerHTML = printContent;
    window.print();
    document.body.innerHTML = originalContent;
    location.reload(); // Optional: reload to restore page
}

function exportToExcel() {
    let table = document.getElementById("paymentTable");
    let csv = [];
    for (let row of table.rows) {
        let cols = [];
        for (let cell of row.cells) {
            cols.push(cell.innerText.replace(/,/g, ""));
        }
        csv.push(cols.join(","));
    }

    let csvContent = csv.join("\n");
    let blob = new Blob([csvContent], { type: "text/csv;charset=utf-8;" });
    let link = document.createElement("a");
    link.setAttribute("href", URL.createObjectURL(blob));
    link.setAttribute("download", "Payment_Report.csv");
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
}
</script>

<?= $this->endSection(); ?>
