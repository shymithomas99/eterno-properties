<?php

namespace App\Http\Controllers\Admin;

use App\Enums\AboutStatus;
use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AboutController extends Controller
{
    /**
     * Edit About Page
     */
    public function edit()
    {
        $about = About::first();

        if (!$about) {

            $about = About::create([
                'banner_title' => 'About Us',
                'intro_title' => 'Introduction',
                'status' => AboutStatus::ACTIVE
            ]);
        }

        return view(
            'admin.about.edit',
            compact('about')
        );
    }

    /**
     * Update About Page
     */
    public function update(Request $request)
    {
        $about = About::firstOrFail();

        $validated = $request->validate([

            // Banner
            'banner_title' => ['required', 'string', 'max:255'],
            'banner_description' => ['required'],
            // 'banner_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp'],
            'banner_image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:200',
                'dimensions:width=1920,height=700',
            ],

            // About
            'intro_title' => ['required', 'string', 'max:255'],
            'intro_description' => ['nullable'],
            // 'intro_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp'],
            'intro_image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:200',
                'dimensions:width=800,height=535',
            ],

            // CTA
            'cta_title' => ['required', 'string', 'max:255'],
            'cta_description' => ['required'],
            'cta_button_text' => ['required', 'string', 'max:255'],
            'cta_button_link' => ['required'],
            // 'cta_background_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp'],
            'cta_background_image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:200',
                'dimensions:width=1920,height=900',
            ],

            // Status
            // 'status' => ['required', Rule::enum(AboutStatus::class)],

        ]);

        /*
        |--------------------------------------------------------------------------
        | Banner Image
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('banner_image')) {

            if (
                $about->banner_image &&
                file_exists(public_path($about->banner_image))
            ) {
                unlink(public_path($about->banner_image));
            }

            $image = $request->file('banner_image');

            $imageName = time() . '_banner.' . $image->getClientOriginalExtension();

            $image->move(
                public_path('uploads/about'),
                $imageName
            );

            $validated['banner_image'] = 'uploads/about/' . $imageName;
        }

        /*
        |--------------------------------------------------------------------------
        | Intro Image
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('intro_image')) {

            if (
                $about->intro_image &&
                file_exists(public_path($about->intro_image))
            ) {
                unlink(public_path($about->intro_image));
            }

            $image = $request->file('intro_image');

            $imageName = time() . '_intro.' . $image->getClientOriginalExtension();

            $image->move(
                public_path('uploads/about'),
                $imageName
            );

            $validated['intro_image'] = 'uploads/about/' . $imageName;
        }

        /*
        |--------------------------------------------------------------------------
        | CTA Image
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('cta_background_image')) {

            if (
                $about->cta_background_image &&
                file_exists(public_path($about->cta_background_image))
            ) {
                unlink(public_path($about->cta_background_image));
            }

            $image = $request->file('cta_background_image');

            $imageName = time() . '_cta.' . $image->getClientOriginalExtension();

            $image->move(
                public_path('uploads/about'),
                $imageName
            );

            $validated['cta_background_image'] = 'uploads/about/' . $imageName;
        }

        $about->update($validated);

        return redirect()
            ->route('admin.about.edit')
            ->with('success', 'About page updated successfully.');
    }
}
