<?php

namespace App\Http\Controllers;

use App\Services\RedsysService;
use Illuminate\Http\Request;

class RedsysController extends Controller
{
    protected $redsys;

    public function __construct(RedsysService $redsys)
    {
        $this->redsys = $redsys;
    }

    public function showForm()
    {
        return view('redsys.form');
    }

    public function payWithBizum(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1',
            'order_id' => 'required|string',
            'phone' => 'required|string|min:9|max:15'
        ]);

        try {
            $formData = $this->redsys->generateFormData(
                $request->amount,
                $request->order_id,
                $request->phone
            );
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Error al generar los datos de pago: ' . $e->getMessage()]);
        }

        return view('redsys.submit', compact('formData'));
    }

    public function success()
    {
        return view('redsys.success');
    }

    public function fail()
    {
        return view('redsys.fail');
    }
}
