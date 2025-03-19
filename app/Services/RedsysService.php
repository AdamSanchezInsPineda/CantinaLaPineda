<?php

namespace App\Services;

class RedsysService
{
    protected $config;

    public function __construct()
    {
        $this->config = config('redsys');
    }

    public function generateFormData($amount, $orderId, $bizumPhone)
    {
        // Convert amount to cents (integer) as required by Redsys
        $amountInCents = (int) ($amount * 100);
        
        // Format order ID - must be between 4 and 12 chars, alphanumeric
        // Corrección en el formato del número de pedido
        $formattedOrderId = substr($orderId, 0, 12); // Asegura que no exceda 12 caracteres
        
        // Clean and validate phone number
        // Corrección en la validación del teléfono
        $cleanPhone = preg_replace('/[^0-9+]/', '', $bizumPhone);
        $validPhone = preg_match('/^\+[0-9]{5,15}$/', $cleanPhone) ? $cleanPhone : '';
        
        $data = [
            'DS_MERCHANT_MERCHANTCODE' => $this->config['merchant_code'],
            'DS_MERCHANT_TERMINAL' => $this->config['terminal'],
            'DS_MERCHANT_TRANSACTIONTYPE' => '0', // Standard payment
            'DS_MERCHANT_AMOUNT' => $amountInCents,
            'DS_MERCHANT_CURRENCY' => $this->config['currency'],
            'DS_MERCHANT_ORDER' => $formattedOrderId,
            'DS_MERCHANT_PAYMETHODS' => 'z', // Must be lowercase 'z' for Bizum
            'DS_MERCHANT_BIZUM_MOBILENUMBER' => $validPhone,
            'DS_MERCHANT_URLOK' => route('redsys.success'),
            'DS_MERCHANT_URLKO' => route('redsys.fail'),
            'DS_MERCHANT_MERCHANTURL' => route('redsys.success'),
        ];
        
        $signature = $this->generateSignature($data);
        
        return [
            'Ds_MerchantParameters' => base64_encode(json_encode($data)),
            'Ds_Signature' => $signature,
            'Ds_SignatureVersion' => 'HMAC_SHA256_V1',
            'url' => $this->config['environment'] === 'live'
                ? $this->config['url_live']
                : $this->config['url_test'],
        ];
    }

    // Corrección en la generación de la firma
    private function generateSignature($data)
    {
        $key = base64_decode($this->config['key']);
        $encodedParams = base64_encode(json_encode($data));
        return base64_encode(hash_hmac('sha256', $encodedParams, $key, true));
    }
}
