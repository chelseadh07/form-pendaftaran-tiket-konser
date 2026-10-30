<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Pendaftaran Tiket Berhasil</title>
</head>
<body>
    <h1>Pendaftaran berhasil</h1>

    <p>Halo {{ $registration->name }},</p>
    <p>Pendaftaran tiket konser Nada di Tengah Kota sudah berhasil dicatat.</p>
    <p>Email ini adalah konfirmasi pendaftaran, bukan bukti pembayaran.</p>

    <h2>Rincian pendaftaran</h2>
    <ul>
        <li>Nomor referensi: {{ $registration->reference }}</li>
        <li>Jenis tiket: {{ $registration->ticket_type === 'vip' ? 'VIP' : 'Regular' }}</li>
        <li>Harga per tiket: Rp{{ number_format($registration->unit_price, 0, ',', '.') }}</li>
        <li>Jumlah tiket: {{ $registration->quantity }}</li>
        <li>Total: Rp{{ number_format($registration->total_price, 0, ',', '.') }}</li>
    </ul>

    <p>Simpan nomor referensi ini untuk keperluan konfirmasi pendaftaran.</p>
</body>
</html>
