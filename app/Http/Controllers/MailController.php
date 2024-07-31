<?php

namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use Mail;
use App\Mail\DemoMail;


class MailController extends Controller
{
    public function index()
    {
        $mailData = [
            'title' => 'Mail from TechGropse.com',
            'body' => 'This is for testing email using SMTP.'
        ];
         
        try {
            Mail::to('rajgupta@techgropse.com')->send(new DemoMail($mailData));
            
            return response()->json([
                'message' => 'Email is sent successfully.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to send email: ' . $e->getMessage()
            ], 500); 
        }
    }
}
