import { Html5Qrcode } from "html5-qrcode";
function onScanSuccess(decodedText, decodedResult) {
    // Aquí tendrás el valor del código QR escaneado
    console.log(`Código QR descifrado: ${decodedText}`);

    // Ahora envíalo al backend para desencriptarlo
    fetch('/desencriptar-qr', {
        method: 'POST',
        body: JSON.stringify({ encryptedId: decodedText }),
        headers: { 'Content-Type': 'application/json' }
    })
    .then(response => response.json())
    .then(data => {
        console.log(data); // Muestra los datos desencriptados
    })
    .catch(error => console.error('Error:', error));
}

// Configurar el lector de QR
const html5QrCode = new Html5Qrcode("reader");
html5QrCode.start(
    { facingMode: "environment" }, // Cámara trasera
    { fps: 10, qrbox: 250 }, // Opciones de escaneo
    onScanSuccess
);