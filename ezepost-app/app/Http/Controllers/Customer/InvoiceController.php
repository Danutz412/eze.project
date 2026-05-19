<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Plan;
use App\Models\Team;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index()
    {
        $invoices = auth()->user()->invoices()
            ->latest()
            ->paginate(10);

        return view('customer.invoices.index', compact('invoices'));
    }

    public function create()
    {
        return view('customer.invoices.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'amount' => 'required|numeric',
            'currency' => 'required|string|max:3',
        ]);

        $invoice = Invoice::create([
            'user_id' => auth()->id(),
            'invoice_no' => Invoice::generateInvoiceNumber(),
            'amount' => $validated['amount'],
            'currency' => $validated['currency'],
            'payment_status' => 'pending',
            'issued_at' => now(),
        ]);

        return redirect()->route('customer.invoices.show', $invoice)
            ->with('success', 'Invoice created successfully!');
    }

    public function show(Invoice $invoice)
    {
        if ($invoice->user_id !== auth()->id()) {
            abort(403);
        }

        $invoice->load(['user']);

        return view('customer.invoices.show', compact('invoice'));
    }

    public function download(Invoice $invoice)
    {
        if ($invoice->user_id !== auth()->id()) {
            abort(403);
        }

        // Generate and download PDF invoice
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('customer.invoices.pdf', compact('invoice'));
        return $pdf->download('invoice-' . $invoice->invoice_no . '.pdf');
    }

    public function destroy(Invoice $invoice)
    {
        if ($invoice->user_id !== auth()->id()) {
            abort(403);
        }

        if ($invoice->payment_status === 'paid') {
            return back()->with('error', 'Cannot delete paid invoice.');
        }

        $invoice->delete();

        return redirect()->route('customer.invoices.index')
            ->with('success', 'Invoice deleted successfully!');
    }
}
