<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GalleryCategory;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Enums\Status;
use Illuminate\Validation\Rule;

class GalleryCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, DataTables $dataTables)
    {
        if($request->ajax()){
        
            $query = GalleryCategory::select('id', 'name', 'sort_order', 'status', 'created_at')->orderBy('id','DESC');
     
            return $dataTables->eloquent($query)
            ->editColumn('status', function (GalleryCategory $galleryCategory) {
                $class = match ($galleryCategory->status) {
                    Status::ACTIVE => 'success',
                    Status::INACTIVE => 'danger',
                };

                return '<span class="badge badge-' . $class . '">'
                    . $galleryCategory->status->label()
                    . '</span>';
            })
            ->addColumn('actions', function (GalleryCategory $galleryCategory) {
                return
                    '<a href="' . route('admin.gallery-categories.show', $galleryCategory) . '" 
                        class="btn btn-sm" title="View">
                        <i class="fa fa-eye"></i>
                    </a> 
                    <a href="' . route('admin.gallery-categories.edit', $galleryCategory) . '" 
                        class="btn btn-sm" title="Edit">
                        <i class="fa fa-edit"></i>
                    </a>
                    <a data-toggle="modal"
                        href="#delete-gallery-category-modal"
                        data-href="' . route('admin.gallery-categories.destroy', $galleryCategory) . '"
                        class="btn btn-sm gallery-category-delete"
                        title="Delete">
                        <i class="fa fa-trash"></i>
                    </a>';
            })      
           ->rawColumns(['status', 'actions'])
           ->make(true);
        }
        return view('admin.gallery-categories.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $galleryCategory = new GalleryCategory();
        return view('admin.gallery-categories.form', compact('galleryCategory'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'sort_order' => ['required', 'integer', 'min:1'],
            'status' => ['required', Rule::enum(Status::class)],
        ]);

        GalleryCategory::create($validated);

        return redirect()->route('admin.gallery-categories.index')->with('success', 'Data added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(GalleryCategory $galleryCategory)
    {
        return view('admin.gallery-categories.show', compact('galleryCategory'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(GalleryCategory $galleryCategory)
    {
        return view('admin.gallery-categories.form', compact('galleryCategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, GalleryCategory $galleryCategory)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'sort_order' => ['required', 'integer', 'min:1'],
            'status' => ['required', Rule::enum(Status::class)],
        ]);

        $galleryCategory->update($validated);

        return redirect()->route('admin.gallery-categories.index')->with('success', 'Data updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GalleryCategory $galleryCategory)
    {
        if (
            $galleryCategory->galleries()->exists()
        ) {
            return response()->json([
                'status' => 'error',
                'message' => 'This category cannot be deleted because it contains related data.',
            ], 422);
        }

        $galleryCategory->delete();

        return response()->json(['status'=>'success', 'message'=>'Data deleted successfully!']);
    }
}
