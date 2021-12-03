<?php

namespace App\Http\Controllers;

use App\Mail\ContactFormMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\View;

class ContactController extends Controller
{
    public function create()
    {
        return View::make('contact.form');
    }

    public function store()
    {
        // dd(request()->all());
        $data = request()->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required'
        ]);

        $contactFormMailer = new ContactFormMail($data);
        // dd($contactFormMailer);
        Mail::to('test@contact.me')->send($contactFormMailer);
        // $contactForm->to('test@contact.me', 'testing')->send($data);

        // return redirect('/contact')->with('message', 'Thank you for sending us message. We\'ll Keep in touch.');

        session()->flash('message', 'Thank you for sending us message. We\'ll be in touch.');

        return redirect('/contact');
    }
}
