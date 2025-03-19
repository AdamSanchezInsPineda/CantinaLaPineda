<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redirigiendo a Redsys...</title>
</head>
<body onload="document.forms['redsysForm'].submit();">
    <h1>Redirigiendo a Redsys...</h1>
    <form name="redsysForm" action="{{ $formData['url'] }}" method="POST">
        <input type="hidden" name="Ds_MerchantParameters" value="{{ $formData['Ds_MerchantParameters'] }}">
        <input type="hidden" name="Ds_Signature" value="{{ $formData['Ds_Signature'] }}">
        <input type="hidden" name="Ds_SignatureVersion" value="{{ $formData['Ds_SignatureVersion'] }}">
        <button type="submit">Pagar con Bizum</button>
    </form>
</body>
</html>
