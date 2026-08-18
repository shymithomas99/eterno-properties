<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RoomPage;
use Illuminate\Http\Request;

class RoomPageController extends Controller
{
    public function edit()
    {
        $roomPage = RoomPage::first();

        if (!$roomPage) {
            $roomPage = RoomPage::create([
                'banner_title' => 'Select Your Sanctuary',
                'banner_description' => 'Discover our collection of thoughtfully designed rooms and tree houses, each offering a unique perspective of the Western Ghats.',
            ]);
        }

        return view(
            'admin.room-page.form',
            compact('roomPage')
        );
    }

    public function update(Request $request)
    {
        $roomPage = RoomPage::firstOrCreate([]);

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
                'max:2048',
            ],
        ]);

        $roomPage->banner_title = $validated['banner_title'];
        $roomPage->banner_description = $validated['banner_description'] ?? null;

        if ($request->hasFile('banner_image')) {

            $image = $request->file('banner_image');

            $filename = time() . '_' . $image->getClientOriginalName();

            $image->move(
                public_path('uploads/room-page'),
                $filename
            );

            $roomPage->banner_image =
                'uploads/room-page/' . $filename;
        }

        $roomPage->save();

        return redirect()
            ->route('admin.room-page.edit')
            ->with('success', 'Rooms page updated successfully.');
    }
}