<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Enums\Status;
use App\Models\ResortIntro;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ResortIntroController extends Controller
{
    public function edit()
    {
        $resortIntro = ResortIntro::firstOrFail();

        return view('admin.resort-intro.form', compact('resortIntro'));
    }

    public function update(Request $request)
    {
        $resortIntro = ResortIntro::firstOrFail();

        $validated = $request->validate([
            'sub_title' => ['required', 'string', 'max:255'],
            'title' => ['required', 'string', 'max:255'],
            'status' => ['required', Rule::enum(Status::class)],
        ],
        [
            'sub_title.required' => 'The subtitle field is required.',
        ]);

        $resortIntro->update($validated);

        return redirect()
            ->route('admin.resort-intro.edit')
            ->with('success', 'Data updated successfully.');
    }
}
