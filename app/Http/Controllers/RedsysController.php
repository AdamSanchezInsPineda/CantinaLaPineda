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
            'order_id' => 'required|string|min:4|max:12',
            'phone' => ['required', 'string', 'regex:/^\+[0-9]{5,15}$/']
        ]);

        try {
            $formData = $this->redsys->generateFormData(
                $request->amount,
                $request->order_id,
                $request->phone
            );
        } catch (\Exception $e) {
            return redirect()->back()
                ->withErrors(['error' => 'Hubo un error al procesar tu solicitud. Por favor, inténtalo de nuevo.' . $e->getMessage()])
                ->withInput();
        }

        return view('redsys.submit', compact('formData'));
    }

    public function success(Request $request)
    {
        $params = $request->all();
        return view('redsys.success', compact('params'));
    }
    
    public function fail(Request $request)
    {
        $params = $request->all();
        return view('redsys.fail', compact('params'));
    }
}
