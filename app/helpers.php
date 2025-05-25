<?php
use Illuminate\Support\Facades\Http;
if (!function_exists('send_bl_sms')) {
    function send_bl_sms($phone, $message)
    {
        // Strip HTML tags from the message
        $plainMessage = strip_tags($message);
        
        // Trim and format the phone number
        $msisdn = trim($phone);
        $n = strlen($msisdn);
        if ($n == 11) {
            $msisdn = '88' . $msisdn;
        }

        // Send SMS using HTTP POST
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . '328|eRQViXjKF7RaVu6egXpq0aTKslOXbg2BRBU66abW',
        ])->post("https://login.esms.com.bd/api/v3/sms/send", [
            'recipient' => $msisdn,
            'sender_id' => "8809617620593",
            'type' => "plain",
            'message' => $plainMessage, // Use the plain text message
        ]);

        return $response;
    }
}



