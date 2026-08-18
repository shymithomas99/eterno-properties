<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TestimonialIntro;
use Illuminate\Http\Request;

class TestimonialIntroController extends Controller
{
    public function edit()
    {
        $testimonialIntro = TestimonialIntro::firstOrFail();

        return view('admin.testimonial-intro.form', compact('testimonialIntro'));
    }

    public function update(Request $request)
    {
        $testimonialIntro = TestimonialIntro::firstOrFail();

        $validated = $request->validate([
            'sub_title' => ['required', 'string', 'max:255'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'status' => ['required'],
        ]);

        $testimonialIntro->update($validated);

        return redirect()
            ->route('admin.testimonial-intro.edit')
            ->with('success', 'Data updated successfully.');
    }
}
