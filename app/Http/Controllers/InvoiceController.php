<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller
{
    public function download(Order $order)
    {
        // Security check: Only buyer or vendor of the items can download
        $isBuyer = $order->user_id === Auth::id();
        $isVendor = $order->items()->whereHas('product', function($q) {
            $q->where('vendor_id', Auth::user()->vendor->id ?? null);
        })->exists();

        if (!$isBuyer && !$isVendor) {
            abort(403, 'Unauthorized access to invoice.');
        }

        $pdf = Pdf::loadView('invoices.template', compact('order'));
        
        return $pdf->download('faktura_#' . $order->id . '.pdf');
    }
}
