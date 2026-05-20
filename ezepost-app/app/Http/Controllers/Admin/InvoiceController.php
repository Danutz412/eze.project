<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class InvoiceController extends Controller
{
    public function download(Invoice $invoice)
    {
        return view('admin.invoices.pdf', compact('invoice'));
    }

    public function generatePdf(Invoice $invoice)
    {
        $pdf = Pdf::loadView('admin.invoices.pdf', compact('invoice'));
        return $pdf->download('invoice-' . $invoice->invoice_no . '.pdf');
    }

    public function create(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'amount' => 'required|numeric',
            'currency' => 'required|string|max:3',
        ]);

        $invoice = Invoice::create([
            'user_id' => $validated['user_id'],
            'invoice_no' => Invoice::generateInvoiceNumber(),
            'amount' => $validated['amount'],
            'currency' => $validated['currency'],
            'payment_status' => 'paid',
            'stripe_invoice_id' => 'admin_' . uniqid(),
            'issued_at' => now(),
        ]);

        return redirect()->route('admin.invoices.index')
            ->with('success', 'Invoice created successfully.');
    }
}
