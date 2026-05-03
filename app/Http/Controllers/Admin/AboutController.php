<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutContent;
use App\Models\AboutSlide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AboutController extends Controller
{
    public function index()
    {
        $content = AboutContent::first();
        if (!$content) {
            $content = AboutContent::create([
                'hero_title' => 'Redefining the Car Marketplace',
                'hero_description' => 'ThriftMotors is Kenya\'s premier destination for high-quality vehicles...',
                'mission_title' => 'Our Mission',
                'vision_title' => 'Our Vision',
            ]);
        }

        $slides = AboutSlide::orderBy('order')->get();

        return view('admin.about.index', compact('content', 'slides'));
    }

    public function updateContent(Request $request)
    {
        $content = AboutContent::first();
        
        $validated = $request->validate([
            'hero_title' => 'nullable|string|max:255',
            'hero_description' => 'nullable|string',
            'mission_title' => 'nullable|string|max:255',
            'mission_description' => 'nullable|string',
            'vision_title' => 'nullable|string|max:255',
            'vision_description' => 'nullable|string',
            'experience_years' => 'nullable|integer',
            'stat_cars_sold' => 'nullable|string|max:50',
            'stat_happy_clients' => 'nullable|string|max:50',
            'stat_partner_dealers' => 'nullable|string|max:50',
            'hero_bg_image' => 'nullable|image|max:2048',
            'mission_image' => 'nullable|image|max:2048',
            'vision_image' => 'nullable|image|max:2048',
        ]);

        $data = $request->except(['hero_bg_image', 'mission_image', 'vision_image']);

        // Handle Images
        foreach (['hero_bg_image', 'mission_image', 'vision_image'] as $imageField) {
            if ($request->hasFile($imageField)) {
                if ($content->$imageField) {
                    Storage::disk('public')->delete($content->$imageField);
                }
                $data[$imageField] = $request->file($imageField)->store('about', 'public');
            }
        }

        $content->update($data);

        return back()->with('success', 'About Us content updated successfully!');
    }

    public function storeSlide(Request $request)
    {
        $request->validate([
            'image' => 'required|image|max:2048',
            'order' => 'nullable|integer',
        ]);

        $path = $request->file('image')->store('about/slides', 'public');

        AboutSlide::create([
            'image_path' => $path,
            'order' => $request->order ?? 0,
        ]);

        return back()->with('success', 'Slide added successfully!');
    }

    public function updateSlide(Request $request, AboutSlide $slide)
    {
        $request->validate([
            'order' => 'required|integer',
            'is_active' => 'boolean',
        ]);

        $slide->update($request->only(['order', 'is_active']));

        return back()->with('success', 'Slide updated successfully!');
    }

    public function destroySlide(AboutSlide $slide)
    {
        Storage::disk('public')->delete($slide->image_path);
        $slide->delete();

        return back()->with('success', 'Slide removed successfully!');
    }
}
