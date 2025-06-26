<?php

namespace App\Http\Controllers;

use App\Mail\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{

    public function show()
    {
        return view('contact');
    }

    public function store(Request $request)
    {

            $request->validate(
                [
                    'name'=>'required',
                    'email'=>'required',
                    'subject'=>'required',
                    'MESSAGE'=>'required',
                ]
                );
      /*  Mail::to('naamen-bouhamed@sports-med-events.com')
            ->send(new Contact($request->except('_token')));*/
            return view('confirm', ['contact' => $request]);
    }
}
