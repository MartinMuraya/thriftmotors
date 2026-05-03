<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMessage;

class PageController extends Controller
{
    public function services()
    {
        return view('pages.services');
    }

    public function about()
    {
        return view('pages.about');
    }

    public function terms()
    {
        return view('pages.terms');
    }

    public function privacy()
    {
        return view('pages.privacy');
    }

    public function hireCars()
    {
        $cars = Car::with(['brand', 'primaryImage'])
            ->where('is_active', true)
            ->where('is_for_hire', true)
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        return view('pages.cars-hire', compact('cars'));
    }

    public function contact()
    {
        return view('pages.contact');
    }

    public function submitContact(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'message' => 'required|string',
        ]);

        Mail::to('gathongomoses14@gmail.com')->send(new ContactMessage($validated));

        return back()->with('success', 'Your message has been sent successfully. We will get back to you soon!');
    }
}
