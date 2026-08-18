<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WelcomeSection;
use Illuminate\Http\Request;

class WelcomeSectionController extends Controller
{
    public function edit()
    {
        $welcomeSection = WelcomeSection::firstOrFail();

        return view('admin.welcome-section.form', compact('welcomeSection'));
    }

    public function update(Request $request)
    {
        $welcomeSection = WelcomeSection::firstOrFail();

        $validated = $request->validate([
            'sub_title' => ['required', 'string', 'max:255'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'left_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'dimensions:width=413,height=503', 'max:400'],
            'right_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'dimensions:width=413,height=503', 'max:400'],
            'button_text' => ['required', 'string', 'max:255'],
            'button_url' => ['required', 'url'],
            'status' => ['required'],
        ],
        [
            'sub_title.required' => 'The subtitle field is required.',
        ]);

        $leftFileName = $welcomeSection->left_image;
        if ($request->hasFile('left_image')) {
            $file = $request->file('left_image');
            $leftFileName = time() . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/welcome-sections'), $leftFileName);
            
            if ($welcomeSection->left_image && $welcomeSection->left_image !== 'default/home-welcome-left.jpg' && file_exists(public_path('uploads/welcome-sections/' . $welcomeSection->left_image))) {
                unlink(public_path('uploads/welcome-sections/' . $welcomeSection->left_image));
            }
        }
        $validated['left_image'] = $leftFileName;

        $rightFileName = $welcomeSection->right_image;
        if ($request->hasFile('right_image')) {
            $file = $request->file('right_image');
            $rightFileName = time() . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/welcome-sections'), $rightFileName);
            
            if ($welcomeSection->right_image && $welcomeSection->right_image !== 'default/home-welcome-right.jpg' && file_exists(public_path('uploads/welcome-sections/' . $welcomeSection->right_image))) {
                unlink(public_path('uploads/welcome-sections/' . $welcomeSection->right_image));
            }
        }
        $validated['right_image'] = $rightFileName;

        $welcomeSection->update($validated);

        return redirect()
            ->route('admin.welcome-section.edit')
            ->with('success', 'Data updated successfully.');
    }
}
