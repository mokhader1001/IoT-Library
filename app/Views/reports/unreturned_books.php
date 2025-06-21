<?= $this->extend("index"); ?>

<?= $this->section('content'); ?>
<br><br><br><br>

<div class="page-breadcrumb">
    <div class="row">
        <div class="col-md-12 text-center p-3">
            <h2 class="page-title text-dark fw-bold">Borrowed Books Report</h2>
            <p class="text-muted mb-3">Track and manage borrowed books</p>
            <div class="mt-3">
                <button onclick="exportExcel()" class="btn btn-success me-2">
                    <i class="fas fa-download"></i> Export Excel
                </button>
              
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="card shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table id="reportTable" class="table table-hover table-bordered mb-0 modern-table">
                    <thead class="table-dark">
                        <tr>
                            <th class="text-center fw-semibold">#</th>
                            <th class="text-center fw-semibold">USER CARD</th>
                            <th class="text-center fw-semibold">BOOK TITLE</th>
                            <th class="text-center fw-semibold">AUTHOR</th>
                            <th class="text-center fw-semibold">BORROW DATE</th>
                            <th class="text-center fw-semibold">RETURN DATE</th>
                            <th class="text-center fw-semibold">STATUS</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $n = 1; foreach ($records as $row): ?>
                        <tr class="<?= $n % 2 == 0 ? 'table-light' : '' ?>">
                            <td class="text-center fw-medium"><?= $n++ ?></td>
                            <td class="text-center"><?= esc($row['card_tag']) ?></td>
                            <td class="text-center fw-medium"><?= esc($row['title']) ?></td>
                            <td class="text-center"><?= esc($row['author_name']) ?></td>
                            <td class="text-center"><?= esc($row['borrow_date']) ?></td>
                            <td class="text-center"><?= esc($row['return_date']) ?></td>
                            <td class="text-center">
                                <?php 
                                $status = strtolower(esc($row['status']));
                                $statusClass = '';
                                switch($status) {
                                    case 'overdue':
                                        $statusClass = 'badge bg-danger';
                                        break;
                                    case 'returned':
                                        $statusClass = 'badge bg-success';
                                        break;
                                    case 'borrowed':
                                        $statusClass = 'badge bg-primary';
                                        break;
                                    default:
                                        $statusClass = 'badge bg-secondary';
                                }
                                ?>
                                <span class="<?= $statusClass ?>"><?= esc($row['status']) ?></span>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <!-- Summary Card -->
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card bg-light">
                <div class="card-body text-center">
                    <small class="text-muted">
                        Total Records: <?= count($records) ?>
                    </small>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Custom Styles -->
<style>
    .modern-table {
        border: 2px solid #d1d5db !important;
        border-radius: 8px;
        overflow: hidden;
    }
    
    .modern-table thead th {
        background-color: #374151 !important;
        color: white !important;
        border: 1px solid #4b5563 !important;
        padding: 16px 12px;
        font-weight: 600;
        letter-spacing: 0.5px;
        font-size: 0.875rem;
    }
    
    .modern-table tbody tr {
        border: 1px solid #e5e7eb !important;
        transition: all 0.2s ease;
    }
    
    .modern-table tbody tr:hover {
        background-color: #f8fafc !important;
        transform: translateY(-1px);
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    
    .modern-table tbody td {
        padding: 16px 12px;
        border: 1px solid #e5e7eb !important;
        vertical-align: middle;
    }
    
    .modern-table tbody tr:last-child td {
        border-bottom: 1px solid #e5e7eb !important;
    }
    
    .table-light {
        background-color: #f9fafb !important;
    }
    
    .table-bordered th,
    .table-bordered td {
        border: 1px solid #d1d5db !important;
    }
    
    .badge {
        font-size: 0.75rem;
        padding: 6px 12px;
        border-radius: 20px;
        font-weight: 500;
    }
    
    .card {
        border: 1px solid #e5e7eb;
        border-radius: 12px;
    }
    
    .page-title {
        font-size: 2rem;
        margin-bottom: 0;
        color: #1f2937;
    }
    
    .page-breadcrumb {
        background-color: #f8fafc;
        border-radius: 12px;
        margin-bottom: 20px;
    }
    
    /* Print Styles */
    @media print {
        body * {
            visibility: hidden;
        }
        .container-fluid, .container-fluid *, 
        .page-breadcrumb, .page-breadcrumb * {
            visibility: visible;
        }
        .page-breadcrumb, .container-fluid {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
        }
        .btn {
            display: none !important;
        }
        .modern-table thead th {
            background-color: #374151 !important;
            color: white !important;
            -webkit-print-color-adjust: exact;
        }
        .modern-table,
        .modern-table th,
        .modern-table td {
            border: 1px solid #000 !important;
        }
        .page-title {
            font-size: 1.5rem !important;
            margin-bottom: 20px !important;
        }
    }
    
    /* Responsive */
    @media (max-width: 768px) {
        .modern-table {
            font-size: 0.875rem;
        }
        
        .modern-table thead th,
        .modern-table tbody td {
            padding: 12px 8px;
        }
        
        .page-title {
            font-size: 1.5rem;
        }
    }
    
    @media (max-width: 576px) {
        .modern-table thead th,
        .modern-table tbody td {
            padding: 8px 6px;
            font-size: 0.8rem;
        }
        
        .badge {
            font-size: 0.7rem;
            padding: 4px 8px;
        }
    }
</style>

<!-- Required Libraries -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>

<script>
// Export to Excel function
function exportExcel() {
    try {
        const table = document.getElementById("reportTable");
        const workbook = XLSX.utils.table_to_book(table, {
            sheet: "Borrowed Books Report",
            raw: false
        });
        
        // Generate filename with current date
        const now = new Date();
        const dateStr = now.getFullYear() + '-' + 
                       String(now.getMonth() + 1).padStart(2, '0') + '-' + 
                       String(now.getDate()).padStart(2, '0');
        const filename = `Borrowed_Books_Report_${dateStr}.xlsx`;
        
        XLSX.writeFile(workbook, filename);
        
        // Show success message
        showNotification('Excel file exported successfully!', 'success');
    } catch (error) {
        console.error('Export error:', error);
        showNotification('Error exporting file. Please try again.', 'error');
    }
}

// Notification function
function showNotification(message, type = 'info') {
    const alertClass = type === 'success' ? 'alert-success' : 
                      type === 'error' ? 'alert-danger' : 'alert-info';
    
    const notification = `
        <div class="alert ${alertClass} alert-dismissible fade show position-fixed" 
             style="top: 20px; right: 20px; z-index: 9999; min-width: 300px;">
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    `;
    
    $('body').append(notification);
    
    // Auto remove after 3 seconds
    setTimeout(() => {
        $('.alert').fadeOut();
    }, 3000);
}

// Print function enhancement
function printReport() {
    window.print();
}

// Keyboard shortcuts
$(document).keydown(function(e) {
    // Ctrl+P for print
    if (e.ctrlKey && e.keyCode === 80) {
        e.preventDefault();
        printReport();
    }
    // Ctrl+E for export
    if (e.ctrlKey && e.keyCode === 69) {
        e.preventDefault();
        exportExcel();
    }
});
</script>

<?= $this->endSection(); ?>