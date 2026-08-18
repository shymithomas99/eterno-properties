<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VideoSection;
use Illuminate\Http\Request;

class VideoSectionController extends Controller
{
    public function edit()
    {
        $videoSection = VideoSection::firstOrFail();

        return view('admin.video-section.form', compact('videoSection'));
    }

    public function update(Request $request)
    {
        $videoSection = VideoSection::firstOrFail();

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'thumbnail_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'dimensions:width=1920,height=1080', 'max:400'],
            'video' => ['nullable', 'file', 'mimes:mp4,mov,avi,webm', 'max:20480'],
            'status' => ['required'],
        ]);

        $imageFileName = $videoSection->thumbnail_image;
        if ($request->hasFile('thumbnail_image')) {
            $file = $request->file('thumbnail_image');
            $imageFileName = time() . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/video-sections'), $imageFileName);
            
            if ($videoSection->thumbnail_image && $videoSection->thumbnail_image !== 'default/home-video-thumbnail.jpg' && file_exists(public_path('uploads/video-sections/' . $videoSection->thumbnail_image))) {
                unlink(public_path('uploads/video-sections/' . $videoSection->thumbnail_image));
            }
        }
        $validated['thumbnail_image'] = $imageFileName;

        $videoFileName = $videoSection->video;
        if ($request->hasFile('video')) {
            $file = $request->file('video');
            $videoFileName = time() . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/video-sections'), $videoFileName);
            
            if ($videoSection->video && $videoSection->video !== 'default/home-video.mp4' && file_exists(public_path('uploads/video-sections/' . $videoSection->video))) {
                unlink(public_path('uploads/video-sections/' . $videoSection->video));
            }
        }
        $validated['video'] = $videoFileName;

        $videoSection->update($validated);

        return redirect()
            ->route('admin.video-section.edit')
            ->with('success', 'Data updated successfully.');
    }
}
