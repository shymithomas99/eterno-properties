<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Enums\Status;
use Illuminate\Validation\Rule;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, DataTables $dataTables, $type)
    {
        if($request->ajax()){
        
            $query = Banner::select('title', 'image', 'sort_order', 'status', 'created_at', 'id')->where('type', $type)->orderBy('id','DESC');
     
            return $dataTables->eloquent($query)
            ->editColumn('image', function (Banner $banner) {
                $imageUrl = $banner->image 
                    ? asset('uploads/banners/' . $banner->image) 
                    : asset('img/blank-pic.png');
                return '<img src="' . $imageUrl . '" width="100" height="90" class="img-thumbnail" />';
            })
            ->editColumn('status', function (Banner $banner) {
                $class = match ($banner->status) {
                    Status::ACTIVE => 'success',
                    Status::INACTIVE => 'danger',
                };

                return '<span class="badge badge-' . $class . '">'
                    . $banner->status->label()
                    . '</span>';
            })
            ->addColumn('actions', function (Banner $banner) use ($type) {
                return
                    '<a href="' . route('admin.banners.show', ['type' => $type, 'banner' => $banner]) . '" 
                        class="btn btn-sm" title="View">
                        <i class="fa fa-eye"></i>
                    </a> 
                    <a href="' . route('admin.banners.edit', ['type' => $type, 'banner' => $banner]) . '" 
                        class="btn btn-sm" title="Edit">
                        <i class="fa fa-edit"></i>
                    </a>
                    <a data-toggle="modal"
                        href="#delete-banner-modal"
                        data-href="' . route('admin.banners.destroy', ['type' => $type, 'banner' => $banner]) . '"
                        class="btn btn-sm banner-delete"
                        title="Delete">
                        <i class="fa fa-trash"></i>
                    </a>';
            })      
           ->rawColumns(['image', 'status', 'actions'])
           ->make(true);
        }
        return view('admin.banners.index', compact('type'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($type)
    {
        $banner = new Banner();
        return view('admin.banners.form', compact('type', 'banner'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $type)
    {
        $validated = $request->validate([
            'title' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'image' => [$type === '2' ? 'required' : 'nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'dimensions:width=1920,height=1080', 'max:2048'],
            'sort_order' => ['required', 'integer', 'min:1'],
            'status' => ['required', Rule::enum(Status::class)],
        ]);

        $fileName = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/banners'), $fileName);
        }

        $validated['image'] = $fileName;
        $validated['type'] = $type;

        Banner::create($validated);

        return redirect()->route('admin.banners.index', ['type' => $type])->with('success', 'Data added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show($type, Banner $banner)
    {
        return view('admin.banners.show', compact('type', 'banner'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($type, Banner $banner)
    {
        if (
            ($type === '1' && $banner->id !== 1) ||
            ($type === '2' && $banner->id === 1)
        ) {
            abort(404);
        }

        return view('admin.banners.form', compact('type', 'banner'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $type, Banner $banner)
    {
        if (
            ($type === '1' && $banner->id !== 1) ||
            ($type === '2' && $banner->id === 1)
        ) {
            abort(404);
        }
        
        $validated = $request->validate([
            'title' => [
                $type === '1' ? 'required' : 'nullable',
                'string', 'max:255'
            ],
            'description' => [
                $type === '1' ? 'required' : 'nullable',
                'string'
            ],
            'sort_order' => [
                $type === '1' ? 'nullable' : 'required',
                'integer', 'min:1'
            ],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'dimensions:width=1920,height=1080', 'max:2048'],
            'status' => ['required', Rule::enum(Status::class)],
        ]);

        $fileName = $banner->image;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/banners'), $fileName);
            
            if ($banner->image && file_exists(public_path('uploads/banners/' . $banner->image))) {
                unlink(public_path('uploads/banners/' . $banner->image));
            }
        }

        $validated['image'] = $fileName;
        $validated['type'] = $type;

        $banner->update($validated);

        if ($type === '1') {
            return redirect()->route('admin.banners.edit', ['type' => $type, 'banner' => $banner])->with('success', 'Data updated successfully');
        }
        return redirect()->route('admin.banners.index', ['type' => $type])->with('success', 'Data updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($type, Banner $banner)
    {
        $banner->delete();

        return response()->json(['status'=>'success', 'message'=>'Data deleted successfully!']);
    }
}
