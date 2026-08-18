<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Amenity;
use App\Models\AmenityCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AmenityController extends Controller
{
    /**
     * Display amenities grouped by category.
     */
    public function index()
    {
        $categories = AmenityCategory::with([
            'amenities' => function ($query) {
                $query->orderBy('id', 'asc');
            }
        ])
            ->where('status', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        return view(
            'admin.amenities.index',
            compact('categories')
        );
    }


    /**
     * Show create form.
     */
    public function create()
    {
        $categories = AmenityCategory::where('status', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        return view(
            'admin.amenities.form',
            compact('categories')
        );
    }


    /**
     * Store multiple amenities under one category.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'amenity_category_id' => [
                'required',
                'exists:amenity_categories,id',
            ],

            'amenities' => [
                'required',
                'array',
                'min:1',
            ],

            'amenities.*.name' => [
                'required',
                'string',
                'max:255',
            ],
        ]);


        foreach ($validated['amenities'] as $item) {

            Amenity::create([
                'amenity_category_id' => $validated['amenity_category_id'],
                'name' => $item['name'],
            ]);
        }


        return redirect()
            ->route('admin.amenities.index')
            ->with('success', 'Amenities added successfully.');
    }


    /**
     * Show all amenities belonging to a category.
     */
    public function edit(AmenityCategory $category)
    {
        $categories = AmenityCategory::where('status', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        $amenities = $category->amenities()
            ->orderBy('id', 'asc')
            ->get();


        return view(
            'admin.amenities.form',
            compact(
                'category',
                'categories',
                'amenities'
            )
        );
    }


    /**
     * Update all amenities belonging to a category.
     */
    public function update(Request $request, AmenityCategory $category)
    {
        $validated = $request->validate([
            'amenities' => [
                'required',
                'array',
                'min:1',
            ],

            'amenities.*.id' => [
                'nullable',
                'integer',
                'exists:amenities,id',
            ],

            'amenities.*.name' => [
                'required',
                'string',
                'max:255',
            ],
        ]);


        DB::transaction(function () use ($validated, $category) {

            $submittedIds = [];

            foreach ($validated['amenities'] as $item) {

                /*
                |--------------------------------------------------------------------------
                | Existing Amenity
                |--------------------------------------------------------------------------
                */

                if (!empty($item['id'])) {

                    $amenity = Amenity::where('id', $item['id'])
                        ->where(
                            'amenity_category_id',
                            $category->id
                        )
                        ->firstOrFail();

                    $amenity->update([
                        'name' => $item['name'],
                    ]);

                    $submittedIds[] = $amenity->id;
                }

                /*
                |--------------------------------------------------------------------------
                | New Amenity
                |--------------------------------------------------------------------------
                */ else {

                    $amenity = Amenity::create([
                        'amenity_category_id' => $category->id,
                        'name' => $item['name'],
                    ]);

                    $submittedIds[] = $amenity->id;
                }
            }


            /*
            |--------------------------------------------------------------------------
            | Delete removed amenities
            |--------------------------------------------------------------------------
            */

            Amenity::where(
                'amenity_category_id',
                $category->id
            )
                ->whereNotIn('id', $submittedIds)
                ->delete();
        });


        return redirect()
            ->route('admin.amenities.index')
            ->with('success', 'Amenities updated successfully.');
    }


    /**
     * Delete individual amenity.
     */
    public function destroy(Amenity $amenity)
    {
        $amenity->delete();

        return redirect()
            ->route('admin.amenities.index')
            ->with('success', 'Amenity deleted successfully.');
    }


    /**
     * Delete all amenities belonging to a category.
     */
    public function destroyCategory(AmenityCategory $category)
    {
        Amenity::where(
            'amenity_category_id',
            $category->id
        )->delete();

        return redirect()
            ->route('admin.amenities.index')
            ->with(
                'success',
                'All amenities under the category have been deleted successfully.'
            );
    }
}