<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Carousel;
use Illuminate\Http\Request;

class AdminCarouselController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $carousels = Carousel::all();
        if (!empty($request->search)) {
            $carousels = Carousel::where('title', 'like', "%$request->search%")->get();
        }
        return view('admin.product.index', ['carousels' => $carousels, 'tab' => 'carousel']);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'media_type' => 'required|in:image,video,youtube',
            'media' => 'required_if:media_type,image,video|file|mimes:jpeg,jpg,png,mp4|max:2048',
            'youtube_url' => 'required_if:media_type,youtube',
        ]);

        // store carousel media
        if ($request->media_type == 'youtube') {
            $data['media'] = $request->youtube_url;
        } else if ($request->hasFile('media')) {
            $media = $request->file('media');
            $data['media'] = $media->storeAs('carousel', $media->hashName(), 'public');
        }

        Carousel::create($data);
        return redirect()->route('admin.carousel.index')->with('success', 'Carousel created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
