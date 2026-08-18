<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AmenityCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class AmenityCategoryController extends Controller
{
    /**
     * Display category list.
     */
    public function index()
    {
        $categories = AmenityCategory::withCount('amenities')
            ->orderBy('sort_order')
            ->orderBy('id', 'desc')
            ->get();

        return view(
            'admin.amenity-categories.index',
            compact('categories')
        );
    }

    /**
     * Show create form.
     */
    public function create()
    {
        $category = new AmenityCategory();

        return view(
            'admin.amenity-categories.form',
            compact('category')
        );
    }

    /**
     * Store category.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'slug' => [
                'nullable',
                'string',
                'alpha_dash',
                'unique:amenity_categories,slug',
            ],

            'sort_order' => [
                'nullable',
                'integer',
                'min:0',
            ],
        ]);

        $slug = $request->slug
            ?: Str::slug($request->name);

        AmenityCategory::create([
            'name' => $request->name,
            'slug' => $slug,
            'sort_order' => $request->sort_order ?? 0,
            'status' => $request->boolean('status'),
        ]);

        return redirect()
            ->route('admin.amenity-categories.index')
            ->with('success', 'Amenity category added successfully.');
    }

    /**
     * Show edit form.
     */
    public function edit(AmenityCategory $amenityCategory)
    {
        $category = $amenityCategory;

        return view(
            'admin.amenity-categories.form',
            compact('category')
        );
    }

    /**
     * Update category.
     */
    public function update(
        Request $request,
        AmenityCategory $amenityCategory
    ) {
        $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'slug' => [
                'nullable',
                'string',
                'alpha_dash',
                Rule::unique('amenity_categories', 'slug')
                    ->ignore($amenityCategory->id),
            ],

            'sort_order' => [
                'nullable',
                'integer',
                'min:0',
            ],
        ]);

        $slug = $request->slug
            ?: Str::slug($request->name);

        $amenityCategory->update([
            'name' => $request->name,
            'slug' => $slug,
            'sort_order' => $request->sort_order ?? 0,
            'status' => $request->boolean('status'),
        ]);

        return redirect()
            ->route('admin.amenity-categories.index')
            ->with('success', 'Amenity category updated successfully.');
    }

    /**
     * Delete category.
     */
    public function destroy(AmenityCategory $amenityCategory)
    {
        $amenityCategory->delete();

        return redirect()
            ->route('admin.amenity-categories.index')
            ->with('success', 'Amenity category deleted successfully.');
    }

    /**
     * Toggle status.
     */
    public function toggleStatus(AmenityCategory $amenityCategory)
    {
        $amenityCategory->update([
            'status' => !$amenityCategory->status,
        ]);

        return back()->with(
            'success',
            $amenityCategory->status
                ? 'Amenity category activated successfully.'
                : 'Amenity category deactivated successfully.'
        );
    }
}