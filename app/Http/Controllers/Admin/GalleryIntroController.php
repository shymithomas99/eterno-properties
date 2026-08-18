<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GalleryIntro;
use Illuminate\Http\Request;

class GalleryIntroController extends Controller
{
    public function edit($type)
    {
        $galleryIntro = GalleryIntro::where('type', $type)->firstOrFail();

        return view('admin.gallery-intro.form', compact('type', 'galleryIntro'));
    }

    public function update(Request $request, $type)
    {
        $galleryIntro = GalleryIntro::where('type', $type)->firstOrFail();

        $validated = $request->validate(
            [
                'sub_title' => [
                    $type == 1 ? 'required' : 'nullable',
                    'string',
                    'max:255',
                ],
                'title' => [
                    $type == 1 ? 'required' : 'nullable',
                    'string',
                    'max:255',
                ],
                'description' => [
                    $type == 1 ? 'required' : 'nullable',
                    'string',
                ],
                'banner_title' => [
                    $type == 2 ? 'required' : 'nullable',
                    'string',
                    'max:255',
                ],
                'banner_description' => [
                    $type == 2 ? 'required' : 'nullable',
                    'string',
                ],
                'banner_image' => [
                    'required',
                    'image',
                    'mimes:jpg,jpeg,png,webp',
                    'max:200',
                    'dimensions:width=1920,height=700',
                ],
                'status' => ['required'],
            ],
            [
                'sub_title.required' => 'The subtitle field is required.',
            ]
        );

        $fileName = $galleryIntro->banner_image;
        if ($request->hasFile('banner_image')) {
            $file = $request->file('banner_image');
            $fileName = time() . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/gallery-intros'), $fileName);

            if ($galleryIntro->banner_image && $galleryIntro->banner_image !== 'default/gallery-banner.jpg' && file_exists(public_path('uploads/gallery-intros/' . $galleryIntro->banner_image))) {
                unlink(public_path('uploads/gallery-intros/' . $galleryIntro->banner_image));
            }
        }

        $validated['banner_image'] = $fileName;
        $validated['type'] = $type;
        $galleryIntro->update($validated);

        return redirect()
            ->route('admin.gallery-intro.edit', $type)
            ->with('success', 'Data updated successfully.');
    }
}