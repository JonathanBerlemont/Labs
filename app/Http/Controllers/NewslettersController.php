<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\Newsletter as Template;
use App\Newsletter;

class NewslettersController extends Controller
{
    public function store()
    {
        $email = request()->validate(['email' => 'required|email|unique:newsletters,email'], ['email.unique' => 'This email has already been registered']);

        Newsletter::create($email);

        return back()->with('success', 'Email successfuly added to the newsletter');
    }

    public function sendNewsletter()
    {
        foreach(Newsletter::all() as $email){
            \Mail::to($email->email)
                 ->queue(new Template());
        }

        return back()->with('success', 'Newsletter sent');
    }

    public function index()
    {
        $emails = Newsletter::all();
        return view('admin.newsletter.index', compact('emails'));
    }

    public function destroy($id)
    {
        $user = Newsletter::find($id);
        $name = $user->email;
        $user->delete();

        return back()->with('success', "{$name} successfuly deleted");
    }

   
}
