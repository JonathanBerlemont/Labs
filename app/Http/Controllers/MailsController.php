<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\UserMail;
use App\Mail;

class MailsController extends Controller
{
    public function sendMailToOwner()
    {
        $attributes = request()->validate([
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required'
        ]);

        \Mail::to(env('MAIL_FROM_ADDRESS'))->queue(
            new UserMail($attributes)
        );

        $attributes['read'] = false;

        Mail::create($attributes);

        return back();
    }

    public function show($id)
    {
        $mail = Mail::find($id);

        $mail->update(['read' => true]);

        return view('admin.contact.show', compact('mail'));
    }

    public function destroy($id)
    {
        Mail::find($id)->delete();

        if (isset(request()['testimonials'])) return back()->with('success', 'Mail deleted');
        return redirect('/admin/contact')->with('success', 'Email deleted');
    }
}
