<?= $this->extend('index'); ?>
<?= $this->section('content'); ?>

<div class="container">
    <h4 class="mt-3">Transaction History</h4>

    <!-- Filter Section -->
    <div class="card mb-3">
        <div class="card-body">
            <form id="filterForm">
                <div class="row">
                    <div class="col-md-3">
                        <label for="sourceFilter">Filter By</label>
                        <select class="form-control" id="sourceFilter" name="sourceFilter">
                            <option value="">Choose Source</option>
                            <?php
                            // Extract unique sources from transactions
                            $uniqueSources = array_unique(array_column($transactions, 'source'));
                            ?>
                            <?php foreach ($uniqueSources as $source): ?>
                                <?php if (!empty($source)): ?>
                                    <option value="<?= esc($source) ?>"><?= esc($source) ?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="startDate">Start Date</label>
                        <input type="date" class="form-control" id="startDate" name="startDate" value="<?= date('Y-m-d') ?>">
                    </div>
                    <div class="col-md-3">
                        <label for="endDate">End Date</label>
                        <input type="date" class="form-control" id="endDate" name="endDate" value="<?= date('Y-m-d') ?>">
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-primary mt-4">Filter</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Transaction Table -->
    <div class="card">
        <div class="card-body table-responsive">
            <table class="table table-bordered table-hover" id="transactionTable">
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
                    <?php 
                    $count = 1; 
                    $grouped = [];
                    
                    // Group transactions by transaction_id
                    foreach ($transactions as $trx) {
                        $grouped[$trx['transaction_id']][] = $trx;
                    }
                    
                    foreach ($grouped as $id => $rows): 
                        $main = $rows[0];
                        
                        // Calculate total amount (sum of debits for this transaction)
                        $totalAmount = array_sum(array_column($rows, 'debit'));
                        
                        // Get description - use descriptions field or construct from debit_by/credit_by
                        $description = '';
                        if (!empty($main['descriptions'])) {
                            $description = $main['descriptions'];
                        } elseif (!empty($main['debit_by'])) {
                            $description = 'Paid by ' . $main['debit_by'];
                        } elseif (!empty($main['credit_by'])) {
                            $description = 'Received by ' . $main['credit_by'];
                        } else {
                            $description = 'N/A';
                        }
                    ?>
                        <tr>
                            <td><?= $count++ ?></td>
                            <td><?= esc($main['source']) ?></td>
                            <td><?= number_format($totalAmount, 2) ?></td>
                            <td><?= esc($description) ?></td>
                            <td><?= esc($main['transaction_date']) ?></td>
                            <td>
                                <button class="btn btn-sm btn-info toggle-details" data-id="<?= $id ?>" title="View Details">
                                    <i class="fa fa-eye"></i>
                                </button>
                                <span class="text-muted mx-1">|</span>
                               
                            </td>
                        </tr>
                        <tr class="details-row" id="details-<?= $id ?>" style="display: none;">
                            <td colspan="6" class="p-0">
                                <div class="bg-light p-3">
                                    <table class="table table-bordered table-sm mb-0">
                                        <thead class="bg-secondary text-white">
                                            <tr>
                                                <th>#</th>
                                                <th>Account</th>
                                                <th>Debit</th>
                                                <th>Credit</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            $detailCount = 1;
                                            // Show debit_by first if it exists and has debit amount
                                            if (!empty($main['debit_by']) && $main['debit'] > 0): 
                                            ?>
                                                <tr>
                                                    <td><?= $detailCount++ ?></td>
                                                    <td><?= esc($main['debit_by']) ?></td>
                                                    <td class="text-right"><?= number_format($main['debit'], 2) ?></td>
                                                    <td class="text-right"></td>
                                                </tr>
                                            <?php endif; ?>
                                            
                                            <?php 
                                            // Show credit_by if it exists and has credit amount
                                            if (!empty($main['credit_by']) && $main['credit'] > 0): 
                                            ?>
                                                <tr>
                                                    <td><?= $detailCount++ ?></td>
                                                    <td><?= esc($main['credit_by']) ?></td>
                                                    <td class="text-right"></td>
                                                    <td class="text-right"><?= number_format($main['credit'], 2) ?></td>
                                                </tr>
                                            <?php endif; ?>
                                            
                                            <?php 
                                            // If no debit_by or credit_by, show all rows from the group
                                            if (empty($main['debit_by']) && empty($main['credit_by'])): 
                                                foreach ($rows as $line): 
                                            ?>
                                                <tr>
                                                    <td><?= $detailCount++ ?></td>
                                                    <td><?= esc($line['account_name']) ?></td>
                                                    <td class="text-right">
                                                        <?= $line['debit'] > 0 ? number_format($line['debit'], 2) : '' ?>
                                                    </td>
                                                    <td class="text-right">
                                                        <?= $line['credit'] > 0 ? number_format($line['credit'], 2) : '' ?>
                                                    </td>
                                                </tr>
                                            <?php 
                                                endforeach;
                                            endif; 
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Custom Styles -->
<style>
    .details-row td {
        border-top: none !important;
    }
    
    .toggle-details {
        transition: all 0.3s ease;
    }
    
    .toggle-details:hover {
        transform: scale(1.1);
    }
    
    .table-responsive {
        border-radius: 0.375rem;
    }
    
    .bg-light {
        background-color: #f8f9fa !important;
    }
    
    .text-right {
        text-align: right;
    }
    
    .btn-info {
        background-color: #17a2b8;
        border-color: #17a2b8;
    }
    
    .btn-info:hover {
        background-color: #138496;
        border-color: #117a8b;
    }
    
    .btn-secondary {
        background-color: #6c757d;
        border-color: #6c757d;
    }
    
    .btn-secondary:hover {
        background-color: #5a6268;
        border-color: #545b62;
    }
    
    .table-dark th {
        background-color: #343a40;
        border-color: #454d55;
        color: #fff;
    }
    
    .table-hover tbody tr:hover {
        background-color: rgba(0,0,0,.075);
    }
    
    .card {
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        border: 1px solid rgba(0,0,0,.125);
    }
    
    .form-control:focus {
        border-color: #80bdff;
        box-shadow: 0 0 0 0.2rem rgba(0,123,255,.25);
    }
    
    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
    }
    
    .btn-primary:hover {
        background-color: #0069d9;
        border-color: #0062cc;
    }
</style>

<!-- Scripts -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Toggle Details Row
        document.querySelectorAll('.toggle-details').forEach(btn => {
            btn.addEventListener('click', function () {
                const id = this.dataset.id;
                const row = document.getElementById('details-' + id);
                const icon = this.querySelector('i');
                
                if (row.style.display === 'none' || row.style.display === '') {
                    row.style.display = 'table-row';
                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash');
                    this.setAttribute('title', 'Hide Details');
                    this.classList.remove('btn-info');
                    this.classList.add('btn-warning');
                } else {
                    row.style.display = 'none';
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');
                    this.setAttribute('title', 'View Details');
                    this.classList.remove('btn-warning');
                    this.classList.add('btn-info');
                }
            });
        });

        // Handle form submission for filtering
        document.getElementById('filterForm').addEventListener('submit', function (e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const sourceFilter = formData.get('sourceFilter');
            const startDate = formData.get('startDate');
            const endDate = formData.get('endDate');
            
            // Build query string
            const params = new URLSearchParams();
            if (sourceFilter) params.append('source', sourceFilter);
            if (startDate) params.append('start_date', startDate);
            if (endDate) params.append('end_date', endDate);
            
            // Show loading state
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Filtering...';
            submitBtn.disabled = true;
            
            // Redirect with filters
            setTimeout(() => {
                window.location.href = window.location.pathname + '?' + params.toString();
            }, 500);
        });
    });
</script>

<?= $this->endSection(); ?>