<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pages;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class PagesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pages = Pages::all();
        return view('pages.index', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate form fields
        $request->validate([
            'name' => 'required|max:255',
            'phone' => 'nullable|max:15',
            'address' => 'nullable|max:255',
            'image' => ['nullable', 'image', 'max:2048'],
        ], [
            'name.required' => 'Please insert the page name.',
            'image.image' => 'The file must be an image.',
            'image.max' => 'The image must not be greater than 2MB.',
        ]);

        // Create a new Pages instance
        $pages = new Pages();
        $pages->name = $request->name;
        $pages->phone = $request->phone;
        $pages->address = $request->address;

        // Handle image upload if present
        if ($request->hasFile('image')) {
            $pages->image = $this->imageUpload($request->file('image'), 'pages', 800, 600);
        }

        // Save to database
        try {
            $pages->save();
            return redirect()->route('pages.index')->with('success', 'Page created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to create page. Please try again.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $page = Pages::findOrFail($id);
        return view('pages.show', compact('page'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $page = Pages::findOrFail($id);
        return view('pages.edit', compact('page'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $page = Pages::findOrFail($id);

        // Validate form fields
        $request->validate([
            'name' => 'required|max:255',
            'phone' => 'nullable|max:15',
            'address' => 'nullable|max:255',
            'image' => ['nullable', 'image', 'max:2048'],
        ], [
            'name.required' => 'Please insert the page name.',
            'image.image' => 'The file must be an image.',
            'image.max' => 'The image must not be greater than 2MB.',
        ]);

        // Update Pages instance
        $page->name = $request->name;
        $page->phone = $request->phone;
        $page->address = $request->address;

        // Handle image upload if present
        if ($request->hasFile('image')) {
            $page->image = $this->imageUpdate($request->file('image'), 'pages', 800, 600, $page->image);
        }

        // Save to database
        try {
            $page->save();
            return redirect()->route('pages.index')->with('success', 'Page updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update page. Please try again.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $page = Pages::findOrFail($id);

        try {
            // Delete image if exists
            if ($page->image) {
                $this->imageDelete($page->image);
            }

            // Delete the page record
            $page->delete();
            return redirect()->route('pages.index')->with('success', 'Page deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete page. Please try again.');
        }
    }
}
