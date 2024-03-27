<?php

namespace App\Http\Controllers;

use App\Services\Booking\BookingService;
use Illuminate\Http\Request;
use Spatie\LaravelPdf\Facades\Pdf;

class ReportController extends Controller
{
    public function historyPdf(BookingService $bookingService)
    {
        return Pdf::view('pdf.invoice', [
            'items' => $bookingService->getBookings(),
        ])
            ->download(downloadName: 'invoice-' . now()->format('Y-m-d') . '.pdf');
    }
}
