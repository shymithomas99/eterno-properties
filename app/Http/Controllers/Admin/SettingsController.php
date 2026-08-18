<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactPage;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    /**
     * Display settings page.
     */
    public function edit()
    {
        $settings = ContactPage::first();

        if (!$settings) {
            $settings = ContactPage::create([]);
        }

        return view(
            'admin.settings.edit',
            compact('settings')
        );
    }

    /**
     * Update settings.
     */
    public function update(Request $request)
    {
        $settings = ContactPage::first();

        if (!$settings) {
            $settings = ContactPage::create([]);
        }

        $data = $request->validate([

            // Phone Numbers
            'phone_1' => 'nullable|max:255',
            'phone_2' => 'nullable|max:255',
            'phone_3' => 'nullable|max:255',

            // Emails
            'email_1' => 'nullable|email|max:255',
            'email_2' => 'nullable|email|max:255',
            // Addresses

            'address_1' => 'nullable',
            // Social Media
            'twitter_url' => 'nullable|url|max:255',
            'youtube_url' => 'nullable|url|max:255',
            'instagram_url' => 'nullable|url|max:255',
            'facebook_url' => 'nullable|url|max:255',
        ]);

        $settings->update($data);

        return back()->with(
            'success',
            'Settings updated successfully.'
        );
    }
}