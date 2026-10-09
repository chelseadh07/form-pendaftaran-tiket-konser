<?php

namespace Tests\Feature;

use App\Models\ConcertRegistration;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_form_is_available(): void
    {
        $this->get('/')
            ->assertOk()
            ->assertSee('Nada di Tengah Kota')
            ->assertSee('Daftar sekarang');
    }

    public function test_valid_registration_is_saved_with_server_calculated_total(): void
    {
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
    }

    public function test_registration_rejects_more_than_four_tickets(): void
    {
        $this->from('/')->post('/pendaftaran', [
            'name' => 'Ayu Pratama',
            'email' => 'ayu@example.com',
            'phone' => '081234567890',
            'ticket_type' => 'regular',
            'quantity' => 5,
        ])->assertRedirect('/')->assertSessionHasErrors('quantity');

        $this->assertDatabaseCount('concert_registrations', 0);
    }
}
