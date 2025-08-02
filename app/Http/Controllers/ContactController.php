<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function send(Request $request)
    {
        //dd($request->all());
        $validated = $request->validate([
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required',
            'message' => 'required|max:400',
        ]);

        Mail::raw($validated['message'], function ($message) use ($validated) {
            $message->to('supyaeshwesinmyomgy@gmail.com')
                ->subject('Contact Form Message')
                ->from($validated['email'], $validated['firstName'] . ' ' . $validated['lastName']);
        });

        return redirect()->back()->with('success', 'Your message has been sent!');
    }
}
