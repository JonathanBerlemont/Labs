<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail;
use App\Testimonial;

class TestimonialsController extends Controller
{
    public function index()
    {
        $mails = Mail::where('subject', 'like', "%testimonial%")->get();

        return view('admin.testimonial.index', compact('mails'));
    }

    public function store()
    {
        $attributes = request()->validate([
            'message' => 'required',
            'name' => 'required'
        ]);

        if(isset(request()['job'])){
            $attributes['job'] = request()['job'];
        } else {
            $attributes['job'] = 'Unknown';
        }

        if(isset(request()['id'])){
            Mail::find(request()['id'])->delete();
        }

        Testimonial::create($attributes);

        return back()->with('success', 'Testimonial stored');
    }
}