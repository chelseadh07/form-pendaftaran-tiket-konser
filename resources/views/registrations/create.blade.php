<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#0b0811">
    <title>{{ config('concert.name') }} Tickets | Night Concert</title>
    <style>
        :root {
            color-scheme: dark;
            --ink: #f5efff;
            --muted: #aaa0b9;
            --paper: #0b0811;
            --line: #33283f;
            --purple: #a968f2;
            --purple-bright: #c18bff;
            --surface: #110d19;
            --input: #171121;
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
            background: #120a1f url('https://images.unsplash.com/photo-1501386761578-eac5c94b800a?auto=format&fit=crop&w=1400&q=85') center / cover;
        }

        .poster::before {
            position: absolute;
            inset: 0;
            content: "";
            background: linear-gradient(180deg, rgb(15 5 28 / 48%), rgb(18 7 32 / 22%) 38%, rgb(10 5 18 / 94%));
        }

        .poster > * { position: relative; }
        .wordmark { font-size: 15px; font-weight: 800; letter-spacing: 0.18em; }
        .wordmark span { color: var(--purple-bright); }
        .event-copy { max-width: 530px; padding: 80px 0 42px; }
        .eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 20px;
            color: #d7b4ff;
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
        .event-copy p { max-width: 350px; margin: 22px 0 0; color: #e9e1f3; font-size: 15px; line-height: 1.7; }
        .event-meta { display: flex; flex-wrap: wrap; gap: 26px; border-top: 1px solid rgb(255 255 255 / 28%); padding-top: 18px; }
        .meta-label { display: block; margin-bottom: 6px; color: #c9bdd8; font-size: 10px; letter-spacing: 0.12em; text-transform: uppercase; }
        .meta-value { font-size: 14px; font-weight: 650; }

        .form-side { display: flex; align-items: center; justify-content: center; padding: 58px clamp(26px, 6vw, 90px); background: var(--paper); }
        .form-wrap { width: min(100%, 540px); }
        .form-heading { margin-bottom: 30px; }
        .form-heading .eyebrow { margin-bottom: 12px; color: var(--purple-bright); }
        h2 { margin: 0; font-family: Georgia, "Times New Roman", serif; font-size: clamp(34px, 4vw, 48px); font-weight: 400; line-height: 1.08; }
        .intro { margin: 12px 0 0; color: var(--muted); font-size: 14px; line-height: 1.6; }

        .success {
            margin-bottom: 24px;
            border-left: 3px solid var(--purple);
            padding: 14px 16px;
            background: #1b1228;
            color: #e8dcf7;
            font-size: 14px;
            line-height: 1.6;
        }
        .success strong { display: block; color: #d5b2ff; }
        .success span { font-weight: 700; letter-spacing: 0.05em; }
        form { display: grid; gap: 18px; }
        .field-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
        label { display: block; margin-bottom: 8px; font-size: 12px; font-weight: 700; }
        input, select {
            width: 100%;
            min-height: 48px;
            border: 1px solid #40334f;
            border-radius: 3px;
            padding: 0 13px;
            background: var(--input);
            color: var(--ink);
            font: inherit;
            font-size: 14px;
        }
        input::placeholder { color: #827891; }
        input:focus, select:focus { border-color: var(--purple-bright); outline: 3px solid rgb(169 104 242 / 20%); }
        .field-error { margin: 6px 0 0; color: #ff8caa; font-size: 12px; }
        .ticket-summary { display: flex; align-items: center; justify-content: space-between; border-top: 1px solid var(--line); padding: 16px 0 2px; font-size: 13px; }
        .ticket-summary span { color: var(--muted); }
        .ticket-summary strong { color: var(--purple-bright); font-size: 18px; }
        button {
            display: flex;
            min-height: 54px;
            align-items: center;
            justify-content: space-between;
            border: 0;
            border-radius: 3px;
            padding: 0 18px;
            background: #8e4ed6;
            color: white;
            cursor: pointer;
            font: inherit;
            font-size: 14px;
            font-weight: 750;
            transition: background 160ms ease, transform 160ms ease;
        }
        button:hover { transform: translateY(-1px); background: #a968f2; }
        button:focus-visible { outline: 3px solid rgb(193 139 255 / 45%); outline-offset: 3px; }
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
        <section class="poster" aria-label="{{ config('concert.name') }} event information">
            <div class="wordmark">NIGHTWAVE<span> / LIVE</span></div>
            <div class="event-copy">
                <div class="eyebrow">One night. A thousand stories.</div>
                <h1>{{ config('concert.name') }}</h1>
                <p>Step into an unforgettable night of music, violet lights, and electric energy.</p>
            </div>
            <div class="event-meta">
                <div><span class="meta-label">Date</span><span class="meta-value">{{ config('concert.date') }}</span></div>
                <div><span class="meta-label">Venue</span><span class="meta-value">{{ config('concert.location') }}</span></div>
            </div>
        </section>

        <section class="form-side">
            <div class="form-wrap">
                <div class="form-heading">
                    <div class="eyebrow">Ticket registration</div>
                    <h2>Claim your place.</h2>
                    <p class="intro">Choose your ticket and get ready for an unforgettable night. Your registration confirmation will be sent by email.</p>
                </div>

                @if (session('registration_reference'))
                    <div class="success" role="status">
                        <strong>Registration complete, {{ session('registration_name') }}!</strong>
                        Your reference: <span>{{ session('registration_reference') }}</span>
                        <br>Your registration details have also been sent to your email.
                    </div>
                @endif

                <form method="POST" action="{{ route('registrations.store') }}">
                    @csrf
                    <div>
                        <label for="name">Full name</label>
                        <input id="name" name="name" type="text" value="{{ old('name') }}" placeholder="Name as shown on your ID" autocomplete="name" list="buyer-suggestions" required>
                        <datalist id="buyer-suggestions">
                            <option value="Elizabeth Nathania" label="elizabeth.nathania@ciputra.ac.id"></option>
                            <option value="Haning Kumbara" label="haning.kumbara@ciputra.ac.id"></option>
                        </datalist>
                        @error('name') <p class="field-error">{{ $message }}</p> @enderror
                    </div>

                    <div class="field-grid">
                        <div>
                            <label for="email">Email address</label>
                            <input id="email" name="email" type="email" value="{{ old('email') }}" placeholder="name@example.com" autocomplete="email" required>
                            @error('email') <p class="field-error">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label for="phone">WhatsApp number</label>
                            <input id="phone" name="phone" type="tel" value="{{ old('phone') }}" placeholder="+62 8xxxxxxxxxx" autocomplete="tel" required>
                            @error('phone') <p class="field-error">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div class="field-grid">
                        <div>
                            <label for="ticket_type">Ticket type</label>
                            <select id="ticket_type" name="ticket_type" required>
                                <option value="regular" @selected(old('ticket_type', 'regular') === 'regular')>Regular · IDR 150,000</option>
                                <option value="vip" @selected(old('ticket_type') === 'vip')>VIP · IDR 350,000</option>
                            </select>
                            @error('ticket_type') <p class="field-error">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label for="quantity">Number of tickets</label>
                            <select id="quantity" name="quantity" required>
                                @for ($quantity = 1; $quantity <= 4; $quantity++)
                                    <option value="{{ $quantity }}" @selected((int) old('quantity', 1) === $quantity)>{{ $quantity }} {{ $quantity === 1 ? 'ticket' : 'tickets' }}</option>
                                @endfor
                            </select>
                            @error('quantity') <p class="field-error">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div class="ticket-summary" aria-live="polite">
                        <span>Order total</span>
                        <strong id="total">IDR 150,000</strong>
                    </div>

                    <button type="submit"><span>Register now</span><span aria-hidden="true">→</span></button>
                </form>
                <p class="note">Prices are per ticket. A maximum of 4 tickets may be ordered per registration.</p>
            </div>
        </section>
    </main>

    <script>
        const buyerName = document.querySelector('#name');
        const buyerEmail = document.querySelector('#email');
        const ticketType = document.querySelector('#ticket_type');
        const quantity = document.querySelector('#quantity');
        const total = document.querySelector('#total');
        const prices = { regular: 150000, vip: 350000 };
        const suggestedEmails = {
            'Elizabeth Nathania': 'elizabeth.nathania@ciputra.ac.id',
            'Haning Kumbara': 'haning.kumbara@ciputra.ac.id',
        };
        const suggestedEmailValues = Object.values(suggestedEmails);

        function updateEmailFromName() {
            const suggestedEmail = suggestedEmails[buyerName.value.trim()];

            if (suggestedEmail) {
                buyerEmail.value = suggestedEmail;
            } else if (suggestedEmailValues.includes(buyerEmail.value)) {
                buyerEmail.value = '';
            }
        }

        function updateTotal() {
            const amount = prices[ticketType.value] * Number(quantity.value);
            total.textContent = new Intl.NumberFormat('en-ID', {
                style: 'currency',
                currency: 'IDR',
                maximumFractionDigits: 0,
            }).format(amount);
        }

        buyerName.addEventListener('input', updateEmailFromName);
        ticketType.addEventListener('change', updateTotal);
        quantity.addEventListener('change', updateTotal);
        updateTotal();
    </script>
</body>
</html>