<?php

namespace App\Http\Controllers;

use App\Mail\InvoiceMail;
use App\Mail\SingleInvoiceMail;
use App\Models\Bill;
use App\Repositories\BillRepository;
use App\Services\PrepareInvoicesService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;


class BillController extends Controller
{
    public function __construct(private BillRepository $billRepository)
    {
    }

    public function generateInvoice(Request $request)
    {
        $data = $request->all();
        $pdf = PDF::loadView('invoice', compact('data'));
        $this->billRepository->store(["data" => json_encode($data), "user_id" => Auth::id()]);
        return $pdf->download('invoice.pdf');
    }

    public function sendInvoiceViaMail(Bill $bill): JsonResponse
    {
        $data = json_decode($bill->data, true);
        Mail::to($bill->user->email)->queue(new SingleInvoiceMail($data, $bill->slug, $bill->user));
        return response()->json(['message' => 'Invoice sent successfully!']);
    }

    public function sendMonthlyInvoicesViaMail(Request $request,PrepareInvoicesService $invoicesService)
    {
        $filter = ["user_id" => Auth::id()];
        $selects = ["slug", "data"];
        $records = $this->billRepository->get($filter, false, [], $selects, "this-month", "created_at", "id", "asc", false);
        $invoices = $invoicesService->handle($records);

    }

}
