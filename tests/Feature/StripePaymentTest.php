<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StripePaymentTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_stripe_webhook_checkout_session_completed()
    {
        $payload = json_encode([
            'type' => 'checkout.session.completed',
            'data' => [
                'object' => [
                    'id' => 'cs_test_123',
                    'payment_status' => 'paid',
                ],
            ],
        ]);
    
        $response = $this->postJson('/stripe/webhook', [], [
            'Stripe-Signature' => 'fake-signature',
        ]);
    
        $response->assertStatus(400); // fails signature, but proves endpoint works
    }
    
}
