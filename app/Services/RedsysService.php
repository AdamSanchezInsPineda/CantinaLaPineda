<?php

namespace App\Services;

class RedsysService
{
    protected $config;

    public function __construct()
    {
        $this->config = config('redsys');
    }

    /**
     * Genera los datos del formulario para la solicitud de pago.
     */
    public function generateFormData($amount, $orderId, $bizumPhone = null)
    {
        // Convertir el importe a céntimos (entero) como requiere Redsys
        $amountInCents = (int) ($amount * 100);
    
        // Formatear el número de pedido: debe tener entre 4 y 12 caracteres alfanuméricos
        $formattedOrderId = str_pad(substr($orderId, 0, 12), 12, '0', STR_PAD_RIGHT);
    
        // Limpiar y validar el número de teléfono
        if ($bizumPhone) {
            $cleanPhone = preg_replace('/[^0-9+]/', '', $bizumPhone);
            if (!preg_match('/^\+[0-9]{5,15}$/', $cleanPhone)) {
                throw new \InvalidArgumentException('El número de teléfono no tiene un formato válido.');
            }
            $validPhone = $cleanPhone;
        }
    
        // Datos de la solicitud
        $data = [
            'DS_MERCHANT_MERCHANTCODE' => $this->config['merchant_code'],
            'DS_MERCHANT_TERMINAL' => $this->config['terminal'],
            'DS_MERCHANT_TRANSACTIONTYPE' => '0', // Pago estándar
            'DS_MERCHANT_AMOUNT' => $amountInCents,
            'DS_MERCHANT_CURRENCY' => $this->config['currency'],
            'DS_MERCHANT_ORDER' => $formattedOrderId,
            'DS_MERCHANT_PAYMETHODS' => 'z', // 'z' para Bizum (en minúscula)
            'DS_MERCHANT_URLOK' => route('redsys.success'), // URL de éxito
            'DS_MERCHANT_URLKO' => route('redsys.fail'), // URL de fallo
            'DS_MERCHANT_MERCHANTURL' => route('redsys.notification'), // URL de notificación
        ];
    
        // Si se proporcionó el teléfono, agregarlo al array de datos
        if (isset($validPhone)) {
            $data['DS_MERCHANT_BIZUM_MOBILENUMBER'] = $validPhone; // Número de teléfono con prefijo
        }
    
        // Generar la firma
        $signature = $this->generateSignature($data);
    
        return [
            'Ds_MerchantParameters' => $this->base64_url_encode(json_encode($data)), // Codificación Base64 URL-safe
            'Ds_Signature' => $signature,
            'Ds_SignatureVersion' => 'HMAC_SHA256_V1',
            'url' => $this->config['environment'] === 'live'
                ? $this->config['url_live']
                : $this->config['url_test'],
        ];
    }

    /**
     * Genera la firma HMAC SHA-256.
     */
    private function generateSignature($data)
    {
        $key = base64_decode($this->config['key']);
        $encodedParams = $this->base64_url_encode(json_encode($data));

        // Diversificar la clave con el número de pedido usando 3DES
        $diversifiedKey = $this->encrypt_3DES($data['DS_MERCHANT_ORDER'], $key);

        // Generar la firma HMAC SHA-256
        return $this->base64_url_encode(hash_hmac('sha256', $encodedParams, $diversifiedKey, true));
    }

    /**
     * Cifra un mensaje usando 3DES.
     */
    private function encrypt_3DES($message, $key)
    {
        $l = ceil(strlen($message) / 8) * 8;
        return substr(openssl_encrypt($message . str_repeat("\0", $l - strlen($message)), 'des-ede3-cbc', $key, OPENSSL_RAW_DATA, "\0\0\0\0\0\0\0\0"), 0, $l);
    }

    /**
     * Codifica en Base64 URL-safe.
     */
    private function base64_url_encode($input)
    {
        return strtr(base64_encode($input), '+/', '-_');
    }

    /**
     * Decodifica desde Base64 URL-safe.
     */
    private function base64_url_decode($input)
    {
        return base64_decode(strtr($input, '-_', '+/'));
    }

    /**
     * Procesa la notificación de Redsys.
     */
    public function processNotification($merchantParameters, $signature)
    {
        // Decodificar los parámetros
        $decodedParams = $this->base64_url_decode($merchantParameters);
        $data = json_decode($decodedParams, true);

        // Verificar la firma
        $expectedSignature = $this->generateSignature($data);
        if ($expectedSignature !== $signature) {
            throw new \RuntimeException('La firma no coincide. Posible manipulación de datos.');
        }

        return $data;
    }
}