<?php

function domain_link()
{
    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://';
    $domain = $_SERVER['HTTP_HOST'] . "/document-tracker";
    $link = $protocol . $domain;

    return $link;
}

function generate_qrcode($value, $size = 350)
{
    $root = domain_link();

    echo
        '<script src="https://cdn.jsdelivr.net/npm/qrious/dist/qrious.min.js"></script>';

    echo
        "<canvas id='qr-code'></canvas>";

    echo
        "<input type='hidden' id='value' value='$value' />";

    echo
        "<script>
    var input = document.getElementById('value').value;
    const canvas = document.getElementById('qr-code');

        const qr = new QRious({
            element: canvas,
            size: '$size',
            value: input
        });

        const logoImage = new Image();
        logoImage.src = '$root/assets/img/icons/imus-logo.png';

        logoImage.onload = function() {
        const logoSize = qr.size * 0.2;
        const logoX = (qr.size - logoSize) / 2;
        const logoY = (qr.size - logoSize) / 2;

        qr.canvas.getContext('2d').drawImage(logoImage, logoX, logoY, logoSize, logoSize);
        };
    </script>";
}

function qrcode_link($reference)
{
    return domain_link() . "/scanned?reference=$reference";
}