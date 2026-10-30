<?php

namespace Tests\Feature;

use App\Mail\RegistrationConfirmed;
use App\Models\ConcertRegistration;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_form_is_available(): void
    {
        $this->get('/')
            ->assertOk()
            ->assertSee('NIGHTWAVE')
            ->assertSee('November 28, 2026')
            ->assertSee('The Obsidian Grand Ballroom, Central Jakarta')
            ->assertSee('Register now');
    }

    public function test_valid_registration_is_saved_with_server_calculated_total(): void
    {
        Mail::fake();

        $response = $this->post('/pendaftaran', [
            'name' => 'Ayu Pratama',
            'email' => 'ayu@example.com',
            'phone' => '081234567890',
            'ticket_type' => 'vip',
            'quantity' => 2,
        ]);

        $response->assertRedirect('/');
        $response->assertSessionHas('registration_name', 'Ayu Pratama');

        $this->assertDatabaseHas('concert_registrations', [
            'name' => 'Ayu Pratama',
            'email' => 'ayu@example.com',
            'ticket_type' => 'vip',
            'quantity' => 2,
            'unit_price' => 350000,
            'total_price' => 700000,
        ]);

        $this->assertStringStartsWith('KT-', ConcertRegistration::firstOrFail()->reference);

        Mail::assertSent(RegistrationConfirmed::class, 'ayu@example.com');
    }

    public function test_registration_rejects_more_than_four_tickets(): void
    {
        Mail::fake();

        $this->from('/')->post('/pendaftaran', [
            'name' => 'Ayu Pratama',
            'email' => 'ayu@example.com',
            'phone' => '081234567890',
            'ticket_type' => 'regular',
            'quantity' => 5,
        ])->assertRedirect('/')->assertSessionHasErrors('quantity');

        $this->assertDatabaseCount('concert_registrations', 0);

        Mail::assertNotSent(RegistrationConfirmed::class);
    }

    public function test_registration_confirmation_email_contains_ticket_details(): void
    {
        $registration = new ConcertRegistration([
            'reference' => 'KT-ABCD1234',
            'name' => 'Ayu Pratama',
            'email' => 'ayu@example.com',
            'phone' => '081234567890',
            'ticket_type' => 'vip',
            'quantity' => 2,
            'unit_price' => 350000,
            'total_price' => 700000,
        ]);

        $html = (new RegistrationConfirmed($registration))->render();

        $this->assertStringContainsString('Ayu Pratama', $html);
        $this->assertStringContainsString('KT-ABCD1234', $html);
        $this->assertStringContainsString('VIP', $html);
        $this->assertStringContainsString('700,000', $html);
        $this->assertStringContainsString('NIGHTWAVE', $html);
        $this->assertStringContainsString('November 28, 2026', $html);
        $this->assertStringContainsString('The Obsidian Grand Ballroom, Central Jakarta', $html);
        $this->assertStringContainsString('Your tickets', $html);
        $this->assertStringContainsString('Event schedule', $html);
    }
}
