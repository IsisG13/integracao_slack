<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SlackController extends Controller
{
    public function sendNotification(Request $request) {
        $this->validate($request, [
            'message' => 'required|string',
        ]);

        $message = $request->input('message');
        $webhookUrl = 'https://hooks.slack.com/services/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';

        try {
            $response = Http::post($webhookUrl, [
                'text' => $message,
            ]);
    
            if ($response->successful()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Notification sent successfully.',
                ], 200);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Failed to send notification.',
                    'error_code' => $response->status(),
                    'error_body' => $response->body(),
                ], $response->status());
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'An unexpected error occurred.',
                'error_details' => $e->getMessage(),
            ], 500);
        }

    }
}
