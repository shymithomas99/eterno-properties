<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OfferIntro;
use Illuminate\Http\Request;

class OfferIntroController extends Controller
{
    public function edit($type)
    {
        $offerIntro = OfferIntro::where('type', $type)->firstOrFail();

        return view('admin.offer-intro.form', compact('type', 'offerIntro'));
    }

    public function update(Request $request, $type)
    {
        $offerIntro = OfferIntro::where('type', $type)->firstOrFail();

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
                // 'banner_image' => [
                //     'nullable',
                //     'image',
                //     'mimes:jpg,jpeg,png,webp',
                //     'max:2048',
                // ],
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

        $fileName = $offerIntro->banner_image;
        if ($request->hasFile('banner_image')) {
            $file = $request->file('banner_image');
            $fileName = time() . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/offer-intros'), $fileName);

            if ($offerIntro->banner_image && $offerIntro->banner_image !== 'default/offer-banner.jpg' && file_exists(public_path('uploads/offer-intros/' . $offerIntro->banner_image))) {
                unlink(public_path('uploads/offer-intros/' . $offerIntro->banner_image));
            }
        }

        $validated['banner_image'] = $fileName;
        $validated['type'] = $type;
        $offerIntro->update($validated);

        return redirect()
            ->route('admin.offer-intro.edit', $type)
            ->with('success', 'Data updated successfully.');
    }
}