<?php

namespace App\Http\Controllers;

use App\Models\ConcertRegistration;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class RegistrationController extends Controller
{
    public function create(): View
    {
        return view('registrations.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $ticketPrices = [
            'regular' => 150000,
            'vip' => 350000,
        ];

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:160'],
            'phone' => ['required', 'string', 'max:24'],
            'ticket_type' => ['required', Rule::in(array_keys($ticketPrices))],
            'quantity' => ['required', 'integer', 'between:1,4'],
        ]);

        $unitPrice = $ticketPrices[$validated['ticket_type']];

        $registration = ConcertRegistration::create([
            ...$validated,
            'reference' => 'KT-'.strtoupper(Str::random(8)),
            'unit_price' => $unitPrice,
            'total_price' => $unitPrice * $validated['quantity'],
        ]);

        return redirect()->route('registrations.create')->with([
            'registration_reference' => $registration->reference,
            'registration_name' => $registration->name,
        ]);
    }
}
