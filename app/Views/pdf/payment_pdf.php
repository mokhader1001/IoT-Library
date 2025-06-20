<?php use Dompdf\Dompdf; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Library Payment Report</title>
    <style>
        @page {
            margin: 20px 15px;
            size: A4 landscape;
        }
        
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 10px;
            margin: 0;
            padding: 0;
            line-height: 1.3;
            color: #333;
        }
        
        .header {
            text-align: center;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 3px solid #2c3e50;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            padding: 20px;
            border-radius: 8px;
        }
        
        .header img {
            width: 60px;
            height: auto;
            margin-bottom: 8px;
        }
        
        .header h2 {
            margin: 8px 0 5px 0;
            font-size: 20px;
            color: #2c3e50;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        .header p {
            font-size: 11px;
            color: #6c757d;
            margin: 5px 0;
            font-style: italic;
        }
        
        .report-info {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
            background-color: #f8f9fa;
            padding: 12px;
            border-radius: 5px;
            border-left: 4px solid #007bff;
        }
        
        .report-info div {
            font-size: 10px;
            color: #495057;
        }
        
        .report-info strong {
            color: #2c3e50;
            font-size: 11px;
        }
        
        .summary-stats {
            display: flex;
            justify-content: center;
            gap: 40px;
            margin-bottom: 20px;
            background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
            color: white;
            padding: 15px;
            border-radius: 8px;
        }
        
        .stat-item {
            text-align: center;
        }
        
        .stat-value {
            font-size: 16px;
            font-weight: bold;
            display: block;
        }
        
        .stat-label {
            font-size: 9px;
            opacity: 0.9;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            border-radius: 8px;
            overflow: hidden;
        }
        
        table th {
            background: linear-gradient(135deg, #343a40 0%, #495057 100%);
            color: white;
            font-weight: bold;
            text-align: center;
            padding: 10px 6px;
            font-size: 9px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border: none;
        }
        
        table td {
            padding: 8px 6px;
            text-align: center;
            font-size: 9px;
            border: 1px solid #dee2e6;
            vertical-align: middle;
        }
        
        /* Optimized Column Widths - Medium/Small */
        .col-num { width: 4%; }
        .col-username { width: 14%; text-align: left; }
        .col-card { width: 10%; }
        .col-amount { width: 10%; text-align: right; font-weight: bold; }
        .col-description { width: 22%; text-align: left; font-size: 8px; }
        .col-method { width: 12%; }
        .col-date { width: 12%; }
        .col-status { width: 10%; }
        
        tr:nth-child(even) {
            background-color: #f8f9fa;
        }
        
        tr:hover {
            background-color: #e3f2fd;
        }
        
        .status-completed {
            background-color: #d4edda;
            color: #155724;
            padding: 3px 6px;
            border-radius: 12px;
            font-size: 8px;
            font-weight: bold;
            text-transform: uppercase;
        }
        
        .status-pending {
            background-color: #fff3cd;
            color: #856404;
            padding: 3px 6px;
            border-radius: 12px;
            font-size: 8px;
            font-weight: bold;
            text-transform: uppercase;
        }
        
        .status-failed {
            background-color: #f8d7da;
            color: #721c24;
            padding: 3px 6px;
            border-radius: 12px;
            font-size: 8px;
            font-weight: bold;
            text-transform: uppercase;
        }
        
        .total-row {
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%) !important;
            color: white !important;
            font-weight: bold;
            font-size: 10px;
        }
        
        .total-row td {
            border: none;
            padding: 12px 6px;
        }
        
        .amount-cell {
            font-family: 'Courier New', monospace;
            font-weight: bold;
            color: #28a745;
        }
        
        .method-badge {
            background-color: #6c757d;
            color: white;
            padding: 2px 6px;
            border-radius: 10px;
            font-size: 8px;
            text-transform: uppercase;
            font-weight: bold;
        }
        
        .method-cash { background-color: #28a745; }
        .method-card { background-color: #007bff; }
        .method-mobile { background-color: #fd7e14; }
        .method-bank { background-color: #6f42c1; }
        
        .footer {
            position: fixed;
            bottom: -15px;
            left: 0;
            right: 0;
            text-align: center;
            font-size: 9px;
            color: #6c757d;
            background-color: #f8f9fa;
            padding: 8px;
            border-top: 2px solid #dee2e6;
        }
        
        .footer-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .no-data {
            text-align: center;
            padding: 40px;
            color: #6c757d;
            font-style: italic;
            background-color: #f8f9fa;
            border-radius: 8px;
        }
        
        .watermark {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-45deg);
            font-size: 60px;
            color: rgba(0,0,0,0.05);
            z-index: -1;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="watermark">DHOBAALE LIBRARY</div>
    
    <div class="header">
        <img src="<?= base_url('public/uploads/logo.png') ?>" alt="Library Logo">
        <h2>Dhobaale Library Payment Report</h2>
        <p>Comprehensive financial summary of all user payments and transactions</p>
    </div>

    <div class="report-info">
        <div><strong>Report Generated:</strong> <?= date('F d, Y \a\t g:i A') ?></div>
        <div><strong>Report Type:</strong> Payment Summary</div>
        <div><strong>Period:</strong> All Time</div>
    </div>

    <?php 
    $totalAmount = 0;
    $completedCount = 0;
    $pendingCount = 0;
    foreach ($payments as $payment) {
        $totalAmount += $payment['price'];
        if ($payment['status'] == 'completed') $completedCount++;
        else $pendingCount++;
    }
    ?>

    <div class="summary-stats">
        <div class="stat-item">
            <span class="stat-value"><?= count($payments) ?></span>
            <span class="stat-label">Total Payments</span>
        </div>
        <div class="stat-item">
            <span class="stat-value">$<?= number_format($totalAmount, 2) ?></span>
            <span class="stat-label">Total Amount</span>
        </div>
        <div class="stat-item">
            <span class="stat-value"><?= $completedCount ?></span>
            <span class="stat-label">Completed</span>
        </div>
        <div class="stat-item">
            <span class="stat-value"><?= $pendingCount ?></span>
            <span class="stat-label">Pending</span>
        </div>
    </div>

    <?php if (!empty($payments)): ?>
    <table>
        <thead>
            <tr>
                <th class="col-num">#</th>
                <th class="col-username">Username</th>
                <th class="col-card">Card Tag</th>
                <th class="col-amount">Amount</th>
                <th class="col-description">Description</th>
                <th class="col-method">Method</th>
                <th class="col-date">Date</th>
                <th class="col-status">Status</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1; foreach ($payments as $row): ?>
                <tr>
                    <td class="col-num"><?= $i++ ?></td>
                    <td class="col-username"><?= esc($row['username']) ?></td>
                    <td class="col-card"><?= esc($row['card_tag']) ?></td>
                    <td class="col-amount amount-cell">$<?= number_format($row['price'], 2) ?></td>
                    <td class="col-description"><?= esc(substr($row['desriptions'], 0, 35)) ?><?= strlen($row['desriptions']) > 35 ? '...' : '' ?></td>
                    <td class="col-method">
                        <span class="method-badge method-<?= strtolower($row['payment_method']) ?>">
                            <?= esc(strtoupper($row['payment_method'])) ?>
                        </span>
                    </td>
                    <td class="col-date"><?= date('M d, Y', strtotime($row['payment_date'])) ?></td>
                    <td class="col-status">
                        <span class="status-<?= strtolower($row['status']) ?>">
                            <?= ucfirst($row['status']) ?>
                        </span>
                    </td>
                </tr>
            <?php endforeach; ?>
            
            <tr class="total-row">
                <td colspan="3"><strong>GRAND TOTAL</strong></td>
                <td class="col-amount"><strong>$<?= number_format($totalAmount, 2) ?></strong></td>
                <td colspan="4"><strong><?= count($payments) ?> Total Transactions</strong></td>
            </tr>
        </tbody>
    </table>
    <?php else: ?>
        <div class="no-data">
            <h3>No Payment Data Available</h3>
            <p>There are currently no payment records to display in this report.</p>
        </div>
    <?php endif; ?>

    <div class="footer">
        <div class="footer-content">
            <span>© <?= date('Y') ?> Dhobaale Library Management System</span>
            <span>Generated: <?= date('Y-m-d H:i:s') ?></span>
            <span>Page {PAGE_NUM} of {PAGE_COUNT}</span>
        </div>
    </div>
</body>
</html>
