<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#f4f1e9">
    <title>Daftar Tiket | Sora Live</title>
    <style>
        :root {
            color-scheme: light;
            --ink: #20211f;
            --muted: #77766f;
            --paper: #f4f1e9;
            --line: #dedbd2;
            --coral: #e4553d;
            --teal: #176e68;
        }

        * { box-sizing: border-box; }
        body {
            margin: 0;
            min-height: 100vh;
            background: var(--paper);
            color: var(--ink);
            font-family: "Avenir Next", Avenir, "Segoe UI", sans-serif;
        }

        .page {
            display: grid;
            grid-template-columns: minmax(300px, 0.9fr) minmax(440px, 1.1fr);
            min-height: 100vh;
        }

        .poster {
            position: relative;
            display: flex;
            min-height: 720px;
            flex-direction: column;
            justify-content: space-between;
            overflow: hidden;
            padding: 36px clamp(28px, 5vw, 72px);
            color: #fffdf7;
            background: #143331 url('https://images.unsplash.com/photo-1501386761578-eac5c94b800a?auto=format&fit=crop&w=1400&q=85') center / cover;
        }

        .poster::before {
            position: absolute;
            inset: 0;
            content: "";
            background: linear-gradient(180deg, rgb(9 25 24 / 35%), rgb(9 25 24 / 14%) 38%, rgb(9 25 24 / 82%));
        }

        .poster > * { position: relative; }
        .wordmark { font-size: 15px; font-weight: 800; letter-spacing: 0.14em; }
        .wordmark span { color: #ffb69e; }
        .event-copy { max-width: 530px; padding: 80px 0 42px; }
        .eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 20px;
            color: #ffcfb8;
            font-size: 11px;
            font-weight: 750;
            letter-spacing: 0.16em;
            text-transform: uppercase;
        }
        .eyebrow::before { width: 24px; height: 1px; background: currentColor; content: ""; }
        h1 {
            max-width: 500px;
            margin: 0;
            font-family: Georgia, "Times New Roman", serif;
            font-size: clamp(50px, 6.4vw, 88px);
            font-weight: 400;
            line-height: 0.98;
        }
        .event-copy p { max-width: 350px; margin: 22px 0 0; color: #e9e7dc; font-size: 15px; line-height: 1.7; }
        .event-meta { display: flex; flex-wrap: wrap; gap: 26px; border-top: 1px solid rgb(255 255 255 / 35%); padding-top: 18px; }
        .meta-label { display: block; margin-bottom: 6px; color: #d6d4c9; font-size: 10px; letter-spacing: 0.12em; text-transform: uppercase; }
        .meta-value { font-size: 14px; font-weight: 650; }

        .form-side { display: flex; align-items: center; justify-content: center; padding: 58px clamp(26px, 6vw, 90px); }
        .form-wrap { width: min(100%, 540px); }
        .form-heading { margin-bottom: 30px; }
        .form-heading .eyebrow { margin-bottom: 12px; color: var(--teal); }
        h2 { margin: 0; font-family: Georgia, "Times New Roman", serif; font-size: clamp(34px, 4vw, 48px); font-weight: 400; line-height: 1.08; }
        .intro { margin: 12px 0 0; color: var(--muted); font-size: 14px; line-height: 1.6; }

        .success {
            margin-bottom: 24px;
            border-left: 3px solid var(--teal);
            padding: 14px 16px;
            background: #e4ede6;
            font-size: 14px;
            line-height: 1.6;
        }
        .success strong { display: block; color: #155b54; }
        .success span { font-weight: 700; letter-spacing: 0.05em; }
        form { display: grid; gap: 18px; }
        .field-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
        label { display: block; margin-bottom: 8px; font-size: 12px; font-weight: 700; }
        input, select {
            width: 100%;
            min-height: 48px;
            border: 1px solid #d1cec5;
            border-radius: 3px;
            padding: 0 13px;
            background: #fbfaf6;
            color: var(--ink);
            font: inherit;
            font-size: 14px;
        }
        input::placeholder { color: #99968c; }
        input:focus, select:focus { border-color: var(--teal); outline: 3px solid rgb(23 110 104 / 14%); }
        .field-error { margin: 6px 0 0; color: #b33729; font-size: 12px; }
        .ticket-summary { display: flex; align-items: center; justify-content: space-between; border-top: 1px solid var(--line); padding: 16px 0 2px; font-size: 13px; }
        .ticket-summary span { color: var(--muted); }
        .ticket-summary strong { color: var(--teal); font-size: 18px; }
        button {
            display: flex;
            min-height: 54px;
            align-items: center;
            justify-content: space-between;
            border: 0;
            border-radius: 3px;
            padding: 0 18px;
            background: var(--coral);
            color: white;
            cursor: pointer;
            font: inherit;
            font-size: 14px;
            font-weight: 750;
            transition: background 160ms ease, transform 160ms ease;
        }
        button:hover { transform: translateY(-1px); background: #c94732; }
        button:focus-visible { outline: 3px solid rgb(228 85 61 / 35%); outline-offset: 3px; }
        .note { margin: 13px 0 0; color: var(--muted); font-size: 11px; line-height: 1.5; text-align: center; }

        @media (max-width: 820px) {
            .page { grid-template-columns: 1fr; }
            .poster { min-height: 410px; padding: 24px clamp(24px, 7vw, 56px); }
            .event-copy { padding: 56px 0 28px; }
            h1 { max-width: 480px; font-size: clamp(48px, 11vw, 70px); }
            .event-copy p { margin-top: 12px; }
            .form-side { padding: 48px 24px 56px; }
        }
        @media (max-width: 480px) {
            .poster { min-height: 390px; }
            .event-meta { gap: 16px; }
            .meta-value { font-size: 12px; }
            .field-grid { grid-template-columns: 1fr; gap: 18px; }
            .form-side { padding-top: 38px; }
        }
        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after { scroll-behavior: auto !important; transition-duration: 0.01ms !important; }
        }
    </style>
</head>
<body>
    <main class="page">
        <section class="poster" aria-label="Informasi acara Sora Live">
            <div class="wordmark">SORA<span> / LIVE</span></div>
            <div class="event-copy">
                <div class="eyebrow">Satu malam, banyak cerita</div>
                <h1>Nada di Tengah Kota</h1>
                <p>Temui teman-teman, nyanyikan lagu favoritmu, dan rayakan malam bersama.</p>
            </div>
            <div class="event-meta">
                <div><span class="meta-label">Tanggal</span><span class="meta-value">28 November 2026</span></div>
                <div><span class="meta-label">Lokasi</span><span class="meta-value">Taman Ismail Marzuki, Jakarta</span></div>
            </div>
        </section>

        <section class="form-side">
            <div class="form-wrap">
                <div class="form-heading">
                    <div class="eyebrow">Pendaftaran tiket</div>
                    <h2>Amankan tempatmu.</h2>
                    <p class="intro">Isi data berikut untuk memesan tiket. Konfirmasi pendaftaran akan muncul setelah formulir dikirim.</p>
                </div>

                @if (session('registration_reference'))
                    <div class="success" role="status">
                        <strong>Pendaftaran berhasil, {{ session('registration_name') }}!</strong>
                        Nomor referensimu: <span>{{ session('registration_reference') }}</span>
                    </div>
                @endif

                <form method="POST" action="{{ route('registrations.store') }}">
                    @csrf
                    <div>
                        <label for="name">Nama lengkap</label>
                        <input id="name" name="name" type="text" value="{{ old('name') }}" placeholder="Nama sesuai identitas" autocomplete="name" required>
                        @error('name') <p class="field-error">{{ $message }}</p> @enderror
                    </div>

                    <div class="field-grid">
                        <div>
                            <label for="email">Email</label>
                            <input id="email" name="email" type="email" value="{{ old('email') }}" placeholder="nama@email.com" autocomplete="email" required>
                            @error('email') <p class="field-error">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label for="phone">Nomor WhatsApp</label>
                            <input id="phone" name="phone" type="tel" value="{{ old('phone') }}" placeholder="08xxxxxxxxxx" autocomplete="tel" required>
                            @error('phone') <p class="field-error">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div class="field-grid">
                        <div>
                            <label for="ticket_type">Jenis tiket</label>
                            <select id="ticket_type" name="ticket_type" required>
                                <option value="regular" @selected(old('ticket_type', 'regular') === 'regular')>Regular · Rp150.000</option>
                                <option value="vip" @selected(old('ticket_type') === 'vip')>VIP · Rp350.000</option>
                            </select>
                            @error('ticket_type') <p class="field-error">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label for="quantity">Jumlah tiket</label>
                            <select id="quantity" name="quantity" required>
                                @for ($quantity = 1; $quantity <= 4; $quantity++)
                                    <option value="{{ $quantity }}" @selected((int) old('quantity', 1) === $quantity)>{{ $quantity }} tiket</option>
                                @endfor
                            </select>
                            @error('quantity') <p class="field-error">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div class="ticket-summary" aria-live="polite">
                        <span>Total pembayaran</span>
                        <strong id="total">Rp150.000</strong>
                    </div>

                    <button type="submit"><span>Daftar sekarang</span><span aria-hidden="true">→</span></button>
                </form>
                <p class="note">Harga tertera per tiket. Maksimal pemesanan 4 tiket dalam satu pendaftaran.</p>
            </div>
        </section>
    </main>

    <script>
        const ticketType = document.querySelector('#ticket_type');
        const quantity = document.querySelector('#quantity');
        const total = document.querySelector('#total');
        const prices = { regular: 150000, vip: 350000 };

        function updateTotal() {
            const amount = prices[ticketType.value] * Number(quantity.value);
            total.textContent = new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                maximumFractionDigits: 0,
            }).format(amount);
        }

        ticketType.addEventListener('change', updateTotal);
        quantity.addEventListener('change', updateTotal);
        updateTotal();
    </script>
</body>
</html>