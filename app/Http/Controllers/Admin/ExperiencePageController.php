<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ExperiencePage;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ExperiencePageController extends Controller
{
    /**
     * Edit Experience Page
     */
    public function edit($type)
    {
        $experiencePage = ExperiencePage::where('type', $type)->first();

        if (!$experiencePage) {

            $experiencePage = ExperiencePage::create([

                'type'               => $type,

                'banner_title'       => 'Experience',

                'banner_description' => '',

                'intro_subtitle'     => '',

                'intro_title'        => 'Our Experiences',

                'intro_description'  => '',

            ]);
        }

        return view(
            'admin.experience.edit',
            compact('experiencePage', 'type')
        );
    }


    /**
     * Update Experience Page
     */
    public function update(Request $request, $type)
    {
        $experiencePage = ExperiencePage::where('type', $type)->firstOrFail();

        $rules = [
            'banner_title' => 'required|max:255',
            'intro_subtitle' => 'nullable|max:255',
            'intro_title' => 'required|max:255',
            'intro_description' => 'nullable',
            'banner_image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:200',

                Rule::dimensions()
                    ->width(1920)
                    ->height(700),
            ],
        ];

        if ($type == 1) {
            $rules['button_text'] = 'nullable|max:255';
            $rules['button_url'] = 'nullable|max:255';
        } else {
            $rules['banner_description'] = 'nullable';
        }

        $data = $request->validate($rules);

        /*
        |--------------------------------------------------------------------------
        | Banner Image
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('banner_image')) {

            if (
                $experiencePage->banner_image &&
                file_exists(public_path($experiencePage->banner_image))
            ) {

                unlink(public_path($experiencePage->banner_image));
            }

            $image = $request->file('banner_image');

            $imageName = time() . '_banner.' .
                $image->getClientOriginalExtension();

            $image->move(
                public_path('uploads/experience'),
                $imageName
            );

            $data['banner_image'] =
                'uploads/experience/' . $imageName;
        }

        $experiencePage->update($data);

        return redirect()
            ->back()
            ->with(
                'success',
                'Experience Page updated successfully.'
            );
    }
}
