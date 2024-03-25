document.addEventListener('DOMContentLoaded', function() {
    // Ensure the pinetpayData object and piAddress are available
    if (typeof pinetpayData !== 'undefined' && pinetpayData.piAddress) {
        // Create QR code element
        var qrCodeElement = document.createElement('div');
        qrCodeElement.id = 'pinetpay-qr-code';

        // Find the placeholder div where the QR code should be displayed
        var placeholder = document.getElementById('pinetpay-qr-code-placeholder');

        // Check if the placeholder exists
        if (placeholder) {
            // Append the QR code div to the placeholder
            placeholder.appendChild(qrCodeElement);
        } else {
            // Fallback: If the placeholder doesn't exist, log an error or handle as appropriate
            console.error('Pinetpay QR code placeholder not found.');
            return;
        }

        // Generate the QR code using qrcodejs
        new QRCode(qrCodeElement, {
            text: pinetpayData.piAddress,
            width: 128,
            height: 128,
            colorDark : "#99028C",
            colorLight : "#ffffff",
            correctLevel : QRCode.CorrectLevel.H
        });
    }
});
