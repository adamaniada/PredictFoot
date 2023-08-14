<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMail;
use Illuminate\Support\Facades\Http;

class ContactController extends Controller
{
    public function contact()
    {
        return view('contact.index');
    }

    public function sendContactForm(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'message' => 'required|string',
        ]);

        // Mail::to('adama2mg@gmail.com')->send(new ContactFormMail($data));

        return redirect()->route('predictions.contact')->with('success', 'Votre message a été envoyé avec succès !');
    }
}
