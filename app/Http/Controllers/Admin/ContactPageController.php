<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactPage;
use Illuminate\Http\Request;

class ContactPageController extends Controller
{
    public function edit()
    {
        $page = ContactPage::first();

        if (!$page) {

            $page = ContactPage::create([

                'banner_title' => 'Contact Us',
                'section_title' => 'Let’s Start Your Journey',

            ]);
        }

        return view(
            'admin.contact.page.edit',
            compact('page')
        );
    }


    public function update(Request $request)
    {
        $page = ContactPage::first();

        $data = $request->validate([

            'banner_title' => 'required|max:255',
            'banner_description' => 'nullable',

            'section_subtitle' => 'required|max:255',
            'section_title' => 'required|max:255',
            'section_description' => 'required',

            'form_title' => 'required|max:255',
            'form_description' => 'nullable',

            'phone' => 'required|max:255',
            'email' => 'required|email',
            'address' => 'required',

            // Banner image - EXACTLY 1920 x 700
            'banner_image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:200',
                'dimensions:width=1920,height=700',
            ],

            // Form image - EXACTLY 700 x 800
            'form_image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:200',
                'dimensions:width=700,height=800',
            ],

            'map_iframe' => 'nullable',

        ]);


        if ($request->hasFile('banner_image')) {

            $image = $request->file('banner_image');

            $imageName = time() . '_banner.' .
                $image->getClientOriginalExtension();

            $image->move(
                public_path('uploads/contact'),
                $imageName
            );

            $data['banner_image'] =
                'uploads/contact/' . $imageName;
        }


        if ($request->hasFile('form_image')) {

            $image = $request->file('form_image');

            $imageName = time() . '_form.' .
                $image->getClientOriginalExtension();

            $image->move(
                public_path('uploads/contact'),
                $imageName
            );

            $data['form_image'] =
                'uploads/contact/' . $imageName;
        }


        $page->update($data);

        return back()->with(
            'success',
            'Contact page updated successfully.'
        );
    }
}
