<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BookingPage;
use Illuminate\Http\Request;

class BookingPageController extends Controller
{
    public function edit()
    {
        $bookingPage = BookingPage::first();

        if (!$bookingPage) {
            $bookingPage = BookingPage::create([
                'banner_title' => 'Booking Enquiry',
                'banner_description' => 'Ready to experience the warmth and luxury of Eterno? Fill out the form below and our reservations team will get back to you within 24 hours.',
            ]);
        }

        return view('admin.booking-page.form', compact('bookingPage'));
    }



    public function update(Request $request)
    {
        $bookingPage = BookingPage::firstOrCreate([]);

        $validated = $request->validate([
            'banner_title' => [
                'required',
                'string',
                'max:255',
            ],

            'banner_description' => [
                'nullable',
                'string',
            ],

            'banner_image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:200',
                'dimensions:width=1920,height=700',
            ],
        ]);

        $bookingPage->banner_title = $validated['banner_title'];
        $bookingPage->banner_description = $validated['banner_description'] ?? null;

        if ($request->hasFile('banner_image')) {

            $image = $request->file('banner_image');

            $filename = time() . '_' . $image->getClientOriginalName();

            // Upload image to public/uploads/booking-page/
            $image->move(
                public_path('uploads/booking-page'),
                $filename
            );

            // Store ONLY filename in database
            $bookingPage->banner_image = $filename;
        }

        $bookingPage->save();

        return redirect()
            ->route('admin.booking-page.edit')
            ->with('success', 'Booking page updated successfully.');
    }
}
