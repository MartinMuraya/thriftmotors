<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use Illuminate\View\View;

class InquiryController extends Controller
{
    /**
     * Display a listing of inquiries.
     */
    public function index(): View
    {
        $inquiries = Inquiry::with('car')
            ->orderBy('is_read', 'asc')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('admin.inquiries.index', compact('inquiries'));
    }

    /**
     * Display the specified inquiry.
     */
    public function show(Inquiry $inquiry): View
    {
        $inquiry->markAsRead();
        $inquiry->load(['car']);

        return view('admin.inquiries.show', compact('inquiry'));
    }

    /**
     * Delete an inquiry.
     */
    public function destroy(Inquiry $inquiry)
    {
        $inquiry->delete();

        return redirect()
            ->route('admin.inquiries.index')
            ->with('success', 'Inquiry deleted successfully!');
    }
}
