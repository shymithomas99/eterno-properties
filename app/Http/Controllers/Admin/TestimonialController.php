<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use App\Models\Resort;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Enums\Status;
use Illuminate\Validation\Rule;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, DataTables $dataTables)
    {
        if($request->ajax()){
        
            $query = Testimonial::with('resort')->select('id', 'resort_id', 'customer_name', 'customer_image', 'title', 'status', 'sort_order', 'created_at')->orderBy('id','DESC');
     
            return $dataTables->eloquent($query)
            ->addColumn('resort_name', function (Testimonial $testimonial) {
                return $testimonial->resort?->name;
            })
            ->filterColumn('resort_name', function ($query, $keyword) {
                $query->whereHas('resort', function ($q) use ($keyword) {
                    $q->where('name', 'like', "%{$keyword}%");
                });
            })
            ->orderColumn('resort_name', function ($query, $order) {
                $query->orderBy(
                    Resort::select('name')
                        ->whereColumn('resorts.id', 'testimonials.resort_id')
                        ->limit(1),
                    $order
                );
            })
            ->editColumn('customer_image', function (Testimonial $testimonial) {
                $customer_image_url = $testimonial->customer_image 
                    ? asset('uploads/testimonials/' . $testimonial->customer_image) 
                    : asset('img/blank-pic.png');
                return '<img src="' . $customer_image_url . '" width="100" height="90" class="img-thumbnail" />';
            })
            ->editColumn('status', function (Testimonial $testimonial) {
                $class = match ($testimonial->status) {
                    Status::ACTIVE => 'success',
                    Status::INACTIVE => 'danger',
                };

                return '<span class="badge badge-' . $class . '">'
                    . $testimonial->status->label()
                    . '</span>';
            })
            ->addColumn('actions', function (Testimonial $testimonial) {
                return
                    '<a href="' . route('admin.testimonials.show', $testimonial) . '" 
                        class="btn btn-sm" title="View">
                        <i class="fa fa-eye"></i>
                    </a> 
                    <a href="' . route('admin.testimonials.edit', $testimonial) . '" 
                        class="btn btn-sm" title="Edit">
                        <i class="fa fa-edit"></i>
                    </a>
                    <a data-toggle="modal"
                        href="#delete-testimonial-modal"
                        data-href="' . route('admin.testimonials.destroy', $testimonial) . '"
                        class="btn btn-sm testimonial-delete"
                        title="Delete">
                        <i class="fa fa-trash"></i>
                    </a>';
            })      
           ->rawColumns(['customer_image', 'status', 'actions'])
           ->make(true);
        }
        return view('admin.testimonials.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $testimonial = new Testimonial();
        $resorts = Resort::orderBy('sort_order', 'ASC')
        ->pluck('name', 'id');

        return view('admin.testimonials.form', compact('testimonial', 'resorts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'resort_id' => ['required', 'exists:resorts,id'],
            'customer_name' => ['required', 'string', 'max:255'],
            'customer_place' => ['required', 'string', 'max:255'],
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required'],
            'customer_image' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'dimensions:width=100,height=100', 'max:30'],
            'sort_order' => ['required', 'integer', 'min:1'],
            'status' => ['required', Rule::enum(Status::class)],
        ],
        [
            'resort_id.required' => ['The resort field is required.'],
        ]);

        $fileName = null;
        if ($request->hasFile('customer_image')) {
            $file = $request->file('customer_image');
            $fileName = time() . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/testimonials'), $fileName);
        }

        $validated['customer_image'] = $fileName;

        Testimonial::create($validated);

        return redirect()->route('admin.testimonials.index')->with('success', 'Data added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Testimonial $testimonial)
    {
        return view('admin.testimonials.show', compact('testimonial'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Testimonial $testimonial)
    {
        $resorts = Resort::orderBy('sort_order', 'ASC')
        ->pluck('name', 'id');

        return view('admin.testimonials.form', compact('testimonial', 'resorts'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Testimonial $testimonial)
    {
        $validated = $request->validate([
            'resort_id' => ['required', 'exists:resorts,id'],
            'customer_name' => ['required', 'string', 'max:255'],
            'customer_place' => ['required', 'string', 'max:255'],
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required'],
            'customer_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'dimensions:width=100,height=100', 'max:30'],
            'sort_order' => ['required', 'integer', 'min:1'],
            'status' => ['required', Rule::enum(Status::class)],
        ]);

        $fileName = $testimonial->customer_image;
        if ($request->hasFile('customer_image')) {
            $file = $request->file('customer_image');
            $fileName = time() . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/testimonials'), $fileName);
            
            if ($testimonial->customer_image && file_exists(public_path('uploads/testimonials/' . $testimonial->customer_image))) {
                unlink(public_path('uploads/testimonials/' . $testimonial->customer_image));
            }
        }

        $validated['customer_image'] = $fileName;

        $testimonial->update($validated);

        return redirect()->route('admin.testimonials.index')->with('success', 'Data updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Testimonial $testimonial)
    {
        $testimonial->delete();

        return response()->json(['status'=>'success', 'message'=>'Data deleted successfully!']);
    }
}
