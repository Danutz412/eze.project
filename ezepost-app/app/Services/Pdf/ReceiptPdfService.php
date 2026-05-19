<?php
namespace App\Services\Pdf;

use App\Models\EzepostTracking;
use Barryvdh\DomPDF\Facade\Pdf;

class ReceiptPdfService
{
    public function download(EzepostTracking $tracking)
    {
        abort_if($tracking->file_count > 5, 422, 'Maximum 5 files can be used in one transfer receipt.');

        $pdf = Pdf::loadView('pdf.transfer-receipt', ['tracking' => $tracking]);

        return $pdf->download('ezepost-receipt-' . $tracking->transfer_reference . '.pdf');
    }
}
