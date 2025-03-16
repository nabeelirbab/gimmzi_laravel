<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Mail\ShareListingMail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ShareController extends Controller
{
    public function sendEmail(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'yourName'       => 'required|string|max:255',
            'yourEmail'      => 'required|email',
            'recipientEmail' => 'required|string',
            'emailSubject'   => 'required|string|max:255',
            'message'        => 'nullable|string',
        ]);

        $recipientEmails = array_map('trim', preg_split('/[\s,]+/', $request->recipientEmail));

        try {
            foreach ($recipientEmails as $recipient) {
                if (filter_var($recipient, FILTER_VALIDATE_EMAIL)) {
                    Mail::to($recipient)->send(new ShareListingMail($request->all()));
                }
            }
    
            return back()->with('success', 'Email sent successfully!');
    
        } catch (Exception $e) {
            Log::error('Email Sending Failed: ', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'request' => $request->all()
            ]);
    
            // Alternatively, write to a custom log file
            $logFile = storage_path('logs/email_errors.log');
            file_put_contents($logFile, '[' . now() . '] ' . $e->getMessage() . "\n" . $e->getTraceAsString() . "\n", FILE_APPEND);
    
            return back()->with('error', 'Failed to send email');
        }
    }
}
