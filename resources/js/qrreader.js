import { Html5Qrcode } from "html5-qrcode";
function onScanSuccess(decodedText, decodedResult) {
    // enviar al backend para desencriptar (no funciona)
    //fetch('/qr-decrypt', {
    //    method: 'POST',
    //    body: JSON.stringify({ encryptedId: decodedText }),
    //    headers: { 'Content-Type': 'application/json' }
    //})
    //.then(response => {
    //    if (response.ok) {
    //        const redirectUrl = response.headers.get('Location');
    //        if (redirectUrl) {
    //            window.location.href = redirectUrl;
    //        }
    //    } else {
    //        alert(`Error del response: ${response.statusText}`);
    //    }
    //})
    //.catch(error => alert(`Error del catch: ${error.message}`));
    window.location.href = "/admin/order/1";
}

// lector de QR
const html5QrCode = new Html5Qrcode("reader");
html5QrCode.start(
    { facingMode: "environment" }, // camara trasera
    { fps: 10, qrbox: 250 }, // configuracion del scanner
    onScanSuccess
);