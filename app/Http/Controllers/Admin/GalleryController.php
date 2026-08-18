<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Enums\Status;
use App\Models\GalleryCategory;
use App\Models\Resort;
use Illuminate\Validation\Rule;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, DataTables $dataTables, $type)
    {
        if ($request->ajax()) {

            $query = Gallery::with(['resort', 'galleryCategory'])->select('id', 'resort_id', 'gallery_category_id', 'image', 'sort_order', 'status', 'created_at')->where('type', $type)->orderBy('id', 'DESC');

            return $dataTables->eloquent($query)
                ->addColumn('resort_name', function (Gallery $gallery) {
                    return $gallery->resort?->name;
                })
                ->filterColumn('resort_name', function ($query, $keyword) {
                    $query->whereHas('resort', function ($q) use ($keyword) {
                        $q->where('name', 'like', "%{$keyword}%");
                    });
                })
                ->orderColumn('resort_name', function ($query, $order) {
                    $query->orderBy(
                        Resort::select('name')
                            ->whereColumn('resorts.id', 'galleries.resort_id')
                            ->limit(1),
                        $order
                    );
                })
                ->addColumn('gallery_category_name', function (Gallery $gallery) {
                    return $gallery->galleryCategory?->name;
                })
                ->filterColumn('gallery_category_name', function ($query, $keyword) {
                    $query->whereHas('galleryCategory', function ($q) use ($keyword) {
                        $q->where('name', 'like', "%{$keyword}%");
                    });
                })
                ->orderColumn('gallery_category_name', function ($query, $order) {
                    $query->orderBy(
                        GalleryCategory::select('name')
                            ->whereColumn('gallery_categories.id', 'galleries.gallery_category_id')
                            ->limit(1),
                        $order
                    );
                })
                ->editColumn('image', function (Gallery $gallery) {
                    $image_url = $gallery->image
                        ? asset('uploads/galleries/' . $gallery->image)
                        : asset('img/blank-pic.png');
                    return '<img src="' . $image_url . '" width="100" height="90" class="img-thumbnail" />';
                })
                ->editColumn('status', function (Gallery $gallery) {
                    $class = match ($gallery->status) {
                        Status::ACTIVE => 'success',
                        Status::INACTIVE => 'danger',
                    };

                    return '<span class="badge badge-' . $class . '">'
                        . $gallery->status->label()
                        . '</span>';
                })
                ->addColumn('actions', function (Gallery $gallery) use ($type) {
                    return
                        '<a href="' . route('admin.galleries.show', ['type' => $type, 'gallery' => $gallery]) . '"
                    class="btn btn-sm" title="View">
                    <i class="fa fa-eye"></i>
                </a>
                <a href="' . route('admin.galleries.edit', ['type' => $type, 'gallery' => $gallery]) . '"
                    class="btn btn-sm" title="Edit">
                    <i class="fa fa-edit"></i>
                </a>
                <a data-toggle="modal"
                    href="#delete-gallery-modal"
                    data-href="' . route('admin.galleries.destroy', ['type' => $type, 'gallery' => $gallery]) . '"
                    class="btn btn-sm gallery-delete"
                    title="Delete">
                    <i class="fa fa-trash"></i>
                </a>';
                })
                ->rawColumns(['image', 'status', 'actions'])
                ->make(true);
        }
        return view('admin.galleries.index', compact('type'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($type)
    {
        $gallery = new Gallery();

        $resorts = Resort::orderBy('sort_order', 'ASC')
            ->pluck('name', 'id');

        $galleryCategories = GalleryCategory::orderBy('sort_order', 'ASC')
            ->where('status', Status::ACTIVE)
            ->pluck('name', 'id');

        return view('admin.galleries.form', compact('type', 'gallery', 'resorts', 'galleryCategories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $type)
    {
        $validated = $request->validate(
            [
                'resort_id' => [
                    $type == 2 ? 'required' : 'nullable',
                    'exists:resorts,id',
                ],

                'gallery_category_id' => [
                    $type == 2 ? 'required' : 'nullable',
                    'exists:gallery_categories,id',
                ],

                'image' => [
                    'required',
                    'image',
                    'mimes:jpg,jpeg,png,webp',
                    'max:200',

                    // Type 1: 370 × 546
                    Rule::when(
                        $type == 1,
                        Rule::dimensions()
                            ->width(370)
                            ->height(546)
                    ),

                    // Type 2: 1000 × 750
                    Rule::when(
                        $type == 2,
                        Rule::dimensions()
                            ->width(1000)
                            ->height(750)
                    ),

                    // Type 3: 294 × 294
                    Rule::when(
                        $type == 3,
                        Rule::dimensions()
                            ->width(294)
                            ->height(294)
                    ),
                ],

                'sort_order' => [
                    'required',
                    'integer',
                    'min:1',
                ],

                'status' => [
                    'required',
                    Rule::enum(Status::class),
                ],
            ],
            [
                'resort_id.required' => 'The resort field is required.',
                'gallery_category_id.required' => 'The category field is required.',
            ]
        );

        $fileName = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/galleries'), $fileName);
        }

        $validated['image'] = $fileName;
        $validated['type'] = $type;

        Gallery::create($validated);

        return redirect()->route('admin.galleries.index', ['type' => $type])->with('success', 'Data added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show($type, Gallery $gallery)
    {
        return view('admin.galleries.show', compact('type', 'gallery'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($type, Gallery $gallery)
    {
        $resorts = Resort::orderBy('sort_order', 'ASC')
            ->pluck('name', 'id');

        $galleryCategories = GalleryCategory::orderBy('id', 'DESC')
            ->where('status', Status::ACTIVE)
            ->pluck('name', 'id');

        return view('admin.galleries.form', compact('type', 'gallery', 'resorts', 'galleryCategories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $type, Gallery $gallery)
    {
        $validated = $request->validate([
            'resort_id' => [
                $type == 2 ? 'required' : 'nullable',
                'exists:resorts,id',
            ],
            'gallery_category_id' => [
                $type == 2 ? 'required' : 'nullable',
                'exists:gallery_categories,id',
            ],
            'image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:200',

                // Type 1: 370 × 546
                Rule::when(
                    $type == 1,
                    Rule::dimensions()
                        ->width(370)
                        ->height(546)
                ),

                // Type 2: 1024 × 1024
                Rule::when(
                    $type == 2,
                    Rule::dimensions()
                        ->width(1000)
                        ->height(750)
                ),

                // Type 3: 294 × 294
                Rule::when(
                    $type == 3,
                    Rule::dimensions()
                        ->width(294)
                        ->height(294)
                ),
            ],
            'sort_order' => ['required', 'integer', 'min:1'],
            'status' => ['required', Rule::enum(Status::class)],
        ]);

        $fileName = $gallery->image;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/galleries'), $fileName);

            if ($gallery->image && file_exists(public_path('uploads/galleries/' . $gallery->image))) {
                unlink(public_path('uploads/galleries/' . $gallery->image));
            }
        }

        $validated['image'] = $fileName;
        $validated['type'] = $type;

        $gallery->update($validated);

        return redirect()->route('admin.galleries.index', ['type' => $type])->with('success', 'Data updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($type, Gallery $gallery)
    {
        $gallery->delete();

        return response()->json(['status' => 'success', 'message' => 'Data deleted successfully!']);
    }
}
