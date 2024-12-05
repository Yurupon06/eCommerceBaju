<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use Mpdf\Mpdf;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $payment = Payment::with('order')->get();

        return view('payment.index', compact('payment'));
    }

    public function exportPDF()
    {
        $payments = Payment::all();

        $totalAmount = 0;


        $html = '<h1>Data Pembayaran</h1>';
        $html .= '<table border="1">';
        $html .= '<tr><th>ID</th><th>Nama Customer</th><th>Tanggal Pembayaran</th><th>Jumlah Pembayaran</th></tr>';
        foreach ($payments as $payment) {
            $html .= '<tr>';
            $html .= '<td>' . $payment->id . '</td>';
            $html .= '<td>' . $payment->order->customer->name . '</td>';
            $html .= '<td>' . $payment->payment_date . '</td>';
            $html .= '<td>$' . $payment->amount . '</td>';
            $html .= '</tr>';

            $totalAmount += $payment->amount;
        }
        $html .= '<tr>';
        $html .= '<td colspan="3"><strong>Total</strong></td>';
        $html .= '<td><strong>$' . $totalAmount . '</strong></td>';
        $html .= '</tr>';

        $html .= '</table>';
    
        $mpdf = new \Mpdf\Mpdf();
        $mpdf->WriteHTML($html);
        $mpdf->Output();
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Payment $payment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payment $payment)
    {
        //
    }
}
