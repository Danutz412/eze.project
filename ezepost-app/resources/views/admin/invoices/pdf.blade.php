<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice #{{ $invoice->invoice_no }}</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; color: #333; }
        .header { border-bottom: 2px solid #dc2626; padding-bottom: 20px; margin-bottom: 30px; }
        .company { font-size: 24px; font-weight: bold; color: #dc2626; }
        .invoice-info { text-align: right; margin-top: 10px; }
        .section { margin-bottom: 30px; }
        .section-title { font-size: 16px; font-weight: bold; margin-bottom: 10px; color: #666; }
        table { width: 100%; border-collapse: collapse; }
        th { text-align: left; padding: 10px; background: #f9f9f9; border-bottom: 2px solid #ddd; }
        td { padding: 10px; border-bottom: 1px solid #ddd; }
        .total { font-size: 20px; font-weight: bold; }
        .status { padding: 5px 15px; border-radius: 20px; font-weight: bold; }
        .status.paid { background: #d1fae5; color: #065f46; }
        .status.pending { background: #fef3c7; color: #92400e; }
    </style>
</head>
<body>
    <div class="header">
        <div class="company">EZePost</div>
        <p>Secure File Transfer Service</p>
        <div class="invoice-info">
            <p><strong>Invoice #{{ $invoice->invoice_no }}</strong></p>
            <p>Date: {{ $invoice->issued_at ? $invoice->issued_at->format('M d, Y') : $invoice->created_at->format('M d, Y') }}</p>
            @if($invoice->stripe_invoice_id)
                <p>Stripe Invoice: {{ $invoice->stripe_invoice_id }}</p>
            @endif
        </div>
    </div>

    <div class="section">
        <div class="section-title">Bill To</div>
        <p><strong>{{ $invoice->user->name }}</strong></p>
        <p>{{ $invoice->user->email }}</p>
    </div>

    <div class="section">
        <div class="section-title">Invoice Details</div>
        <table>
            <thead>
                <tr>
                    <th>Description</th>
                    <th style="text-align: right;">Amount</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <strong>Service Fee</strong>
                    </td>
                    <td style="text-align: right;">{{ $invoice->currency }}{{ number_format($invoice->amount, 2) }}</td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td style="text-align: right; padding: 20px 10px 10px;"><strong>Total:</strong></td>
                    <td class="total" style="text-align: right; padding: 20px 10px 10px;">{{ $invoice->currency }}{{ number_format($invoice->amount, 2) }}</td>
                </tr>
            </tfoot>
        </table>
    </div>

    <div class="section">
        <div class="section-title">Payment Status</div>
        <span class="status {{ $invoice->payment_status }}">
            {{ ucfirst($invoice->payment_status) }}
        </span>
    </div>
</body>
</html>
