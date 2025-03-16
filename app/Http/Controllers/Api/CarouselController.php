<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Carousel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CarouselController extends Controller
{
    public function findAll()
    {
        return response()->json(Carousel::all());
    }

    public function create(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'media_type' => 'required|in:image,video,youtube',
            'media' => 'required_if:media_type,image,video|file|mimes:jpeg,jpg,png,mp4|max:2048',
            'youtube_url' => 'required_if:media_type,youtube',
        ]);

        // store carousel media
        if ($request->media_type == 'youtube') {
            // get videoId from youtube url
            $url = $request->youtube_url;
            if (strpos($url, 'youtu.be')) {
                $videoId = explode('youtu.be/', $url)[1];
                $videoId = explode('?', $videoId)[0];
            } else {
                $videoId = explode('v=', $url)[1];
                $videoId = explode('&', $videoId)[0];
            }
            $data['media'] = "https://www.youtube.com/embed/$videoId?autoplay=1&mute=1";
        } else if ($request->hasFile('media')) {
            $media = $request->file('media');
            $data['media'] = $media->store('carousel');
        }

        if ($data['description'] == null) {
            $data['description'] = '';
        }

        $carousel = Carousel::create($data);
        return response()->json($carousel);
    }

    public function update(Request $request, $id)
    {
        $carousel = Carousel::find($id);
        if (!$carousel) {
            return response()->json(['message' => 'Carousel not found'], 404);
        }

        $data = $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
        ]);

        $carousel->update($data);
        return response()->json($carousel);
    }

    public function delete($id)
    {
        $carousel = Carousel::find($id);
        if (!$carousel) {
            return response()->json(['message' => 'Carousel not found'], 404);
        }

        if ($carousel->media_type == 'image' || $carousel->media_type == 'video') {
            Storage::delete($carousel->media);
        }

        $carousel->delete();
        return response()->json(['message' => 'Carousel deleted']);
    }
}
