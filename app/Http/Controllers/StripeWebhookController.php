<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Container\Attributes\Log;
use Illuminate\Http\Request;
use Stripe\Webhook;

class StripeWebhookController extends Controller
{
    public function handle(Request $request)
    {
        $payload = $request->getContent();
        $sig_header = $request->header('Stripe-Signature');
        $secret = config('services.stripe.webhook_secret');

        try {
            $event = Webhook::constructEvent($payload, $sig_header, $secret);
        } catch (\UnexpectedValueException $e) {
            return response()->json(['error' => 'Invalid payload'], 400);
        } catch (\Stripe\Exception\SignatureVerificationException $e) {
            return response()->json(['error' => 'Invalid signature'], 400);
        }

        // Handle checkout success
        if ($event->type === 'checkout.session.completed') {
            $session = $event->data->object;

            $postId = $session->metadata->product_id ?? null;
            $userId = $session->metadata->user_id ?? null;

            if ($postId) {
                Log::info('Stripe webhook: Checkout session completed for post ID: ' . $postId);
                // Update the product status to premium
                Product::where('id', $postId)
                    ->where('user_id', $userId)
                    ->update(['is_premium' => 1, 'status' => 'active']);
            }
        }

        return response()->json(['status' => 'success']);
    }
}
