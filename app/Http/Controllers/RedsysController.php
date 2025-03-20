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
                ->withErrors(['error' => 'Hubo un error al procesar tu solicitud. Por favor, inténtalo de nuevo.'])
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

    public function notification(Request $request)
    {
        try {
            // Procesar la notificación
            $data = $this->redsys->processNotification(
                $request->input('Ds_MerchantParameters'),
                $request->input('Ds_Signature')
            );

            // Obtener detalles de la transacción
            $orderId = $data['Ds_Order'];
            $amount = $data['Ds_Amount'] / 100; // Convertir a euros
            $responseCode = $data['Ds_Response'];

            if ($responseCode === '0000') {
                // Pago exitoso
                // Actualizar el estado del pedido en la base de datos
                // Ejemplo: Pedido::where('order_id', $orderId)->update(['status' => 'paid']);
            } else {
                // Pago fallido
                // Actualizar el estado del pedido en la base de datos
                // Ejemplo: Pedido::where('order_id', $orderId)->update(['status' => 'failed']);
            }

            // Responder a Redsys con un código 200 (éxito)
            return response('Notificación recibida', 200);
        } catch (\Exception $e) {
            // Registrar el error y responder con un código 400 (error)
            return response('Error al procesar la notificación: ' . $e->getMessage(), 400);
        }
    }
}