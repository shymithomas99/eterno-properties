<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Resort;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Enums\Status;
use Illuminate\Validation\Rule;

class ResortController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, DataTables $dataTables, $type)
    {
        if ($request->ajax()) {

            $query = Resort::select('name', 'url', 'home_title', 'mega_menu_title', 'home_image', 'mega_menu_image', 'book_now_image', 'home_status', 'mega_menu_status', 'book_now_status', 'sort_order', 'created_at', 'id')->orderBy('id', 'DESC');

            return $dataTables->eloquent($query)
                ->editColumn('home_image', function (Resort $resort) {
                    if (!$resort->home_image) {
                        return '';
                    }
                    return '<img src="' . asset('uploads/resorts/' . $resort->home_image) . '" width="100" height="90" class="img-thumbnail" />';
                })
                ->editColumn('mega_menu_image', function (Resort $resort) {
                    if (!$resort->mega_menu_image) {
                        return '';
                    }
                    return '<img src="' . asset('uploads/resorts/' . $resort->mega_menu_image) . '" width="100" height="90" class="img-thumbnail" />';
                })
                ->editColumn('book_now_image', function (Resort $resort) {
                    if (!$resort->book_now_image) {
                        return '';
                    }
                    return '<img src="' . asset('uploads/resorts/' . $resort->book_now_image) . '" width="100" height="90" class="img-thumbnail" />';
                })
                ->editColumn('home_status', function (Resort $resort) {
                    $class = match ($resort->home_status) {
                        Status::ACTIVE => 'success',
                        Status::INACTIVE => 'danger',
                    };

                    return '<span class="badge badge-' . $class . '">'
                        . $resort->home_status->label()
                        . '</span>';
                })
                ->editColumn('mega_menu_status', function (Resort $resort) {
                    $class = match ($resort->mega_menu_status) {
                        Status::ACTIVE => 'success',
                        Status::INACTIVE => 'danger',
                    };

                    return '<span class="badge badge-' . $class . '">'
                        . $resort->mega_menu_status->label()
                        . '</span>';
                })
                ->editColumn('book_now_status', function (Resort $resort) {
                    $class = match ($resort->book_now_status) {
                        Status::ACTIVE => 'success',
                        Status::INACTIVE => 'danger',
                    };

                    return '<span class="badge badge-' . $class . '">'
                        . $resort->book_now_status->label()
                        . '</span>';
                })
                ->addColumn('actions', function (Resort $resort) use ($type) {
                    $actions = '
                    <a href="' . route('admin.resorts.show', ['type' => $type, 'resort' => $resort]) . '"
                        class="btn btn-sm" title="View">
                        <i class="fa fa-eye"></i>
                    </a>

                    <a href="' . route('admin.resorts.edit', ['type' => $type, 'resort' => $resort]) . '"
                        class="btn btn-sm" title="Edit">
                        <i class="fa fa-edit"></i>
                    </a>';

                    if ($type === '1') {
                        $actions .= '
                        <a data-toggle="modal"
                            href="#delete-resort-modal"
                            data-href="' . route('admin.resorts.destroy', ['type' => $type, 'resort' => $resort]) . '"
                            class="btn btn-sm resort-delete"
                            title="Delete">
                            <i class="fa fa-trash"></i>
                        </a>';
                    }

                    return $actions;
                })
                ->rawColumns(['home_image', 'mega_menu_image', 'book_now_image', 'home_status', 'mega_menu_status', 'book_now_status', 'actions'])
                ->make(true);
        }
        return view('admin.resorts.index', compact('type'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($type)
    {
        $resort = new Resort();
        return view('admin.resorts.form', compact('type', 'resort'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $type)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'url' => ['required', 'url'],
            'sort_order' => ['required', 'integer', 'min:1'],
        ]);

        $now = now();

        $validated['home_updated_at'] = $now;
        $validated['mega_menu_updated_at'] = $now;
        $validated['book_now_updated_at'] = $now;

        Resort::create($validated);

        return redirect()->route('admin.resorts.index', ['type' => $type])->with('success', 'Data added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show($type, Resort $resort)
    {
        return view('admin.resorts.show', compact('type', 'resort'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($type, Resort $resort)
    {
        return view('admin.resorts.form', compact('type', 'resort'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $type, Resort $resort)
    {
        $validated = $request->validate([
            // Type 1
            'name' => [
                $type === 1 ? 'required' : 'nullable',
                'string',
                'max:255',
            ],

            'url' => [
                $type === 1 ? 'required' : 'nullable',
                'url',
            ],

            'sort_order' => [
                $type === 1 ? 'required' : 'nullable',
                'integer',
                'min:1'
            ],

            // Type 2
            'home_place' => [
                $type === 2 ? 'required' : 'nullable',
                'string',
                'max:255',
            ],
            'home_title' => [
                $type === 2 ? 'required' : 'nullable',
                'string',
                'max:255',
            ],
            'home_description' => [
                $type === 2 ? 'required' : 'nullable',
                'string',
            ],
            'home_button_text' => [
                $type === 2 ? 'required' : 'nullable',
                'string',
                'max:255',
            ],
            'home_button_url' => [
                $type === 2 ? 'required' : 'nullable',
                'url',
            ],
            'home_image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'dimensions:width=660,height=487',
                'max:500',
            ],
            'home_status' => [
                $type === 2 ? 'required' : 'nullable',
                Rule::enum(Status::class)
            ],

            // Type 3
            'mega_menu_sub_title' => [
                $type === 3 ? 'required' : 'nullable',
                'string',
                'max:255',
            ],
            'mega_menu_title' => [
                $type === 3 ? 'required' : 'nullable',
                'string',
                'max:255',
            ],
            'mega_menu_description' => [
                $type === 3 ? 'required' : 'nullable',
                'string',
            ],
            'mega_menu_image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'dimensions:width=500,height=462',
                'max:200',
            ],
            'mega_menu_status' => [
                $type === 3 ? 'required' : 'nullable',
                Rule::enum(Status::class)
            ],

            // Type 4
            'book_now_image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'dimensions:width=400,height=267',
                'max:100',
            ],
            'book_now_status' => [
                $type === 4 ? 'required' : 'nullable',
                Rule::enum(Status::class)
            ],
        ], [
            // Home Section
            'home_place.required' => 'The place field is required.',
            'home_place.string' => 'The place must be a valid text.',
            'home_place.max' => 'The place may not be greater than 255 characters.',

            'home_title.required' => 'The title field is required.',
            'home_title.string' => 'The title must be a valid text.',
            'home_title.max' => 'The title may not be greater than 255 characters.',

            'home_description.required' => 'The description field is required.',
            'home_description.string' => 'The description must be a valid text.',

            'home_button_text.required' => 'The button text field is required.',
            'home_button_text.string' => 'The button text must be a valid text.',
            'home_button_text.max' => 'The button text may not be greater than 255 characters.',

            'home_button_url.required' => 'The button URL field is required.',
            'home_button_url.url' => 'Please enter a valid button URL.',

            'home_image.image' => 'The selected file must be an image.',
            'home_image.mimes' => 'The image must be a JPG, JPEG, PNG or WEBP file.',
            'home_image.dimensions' => 'The image field has invalid image dimensions.',
            'home_image.max' => 'The image field must not be greater than 500 kilobytes.',

            'home_status.required' => 'The status field is required.',

            // Mega Menu
            'mega_menu_sub_title.required' => 'The subtitle field is required.',
            'mega_menu_sub_title.string' => 'The subtitle must be a valid text.',
            'mega_menu_sub_title.max' => 'The subtitle may not be greater than 255 characters.',

            'mega_menu_title.required' => 'The title field is required.',
            'mega_menu_title.string' => 'The title must be a valid text.',
            'mega_menu_title.max' => 'The title may not be greater than 255 characters.',

            'mega_menu_description.required' => 'The description field is required.',
            'mega_menu_description.string' => 'The description must be a valid text.',

            'mega_menu_image.image' => 'The selected file must be an image.',
            'mega_menu_image.mimes' => 'The image must be a JPG, JPEG, PNG or WEBP file.',
            'mega_menu_image.dimensions' => 'The image field has invalid image dimensions.',
            'mega_menu_image.max' => 'The image field must not be greater than 200 kilobytes.',

            'mega_menu_status.required' => 'The status field is required.',

            // Book Now
            'book_now_image.image' => 'The selected file must be an image.',
            'book_now_image.mimes' => 'The image must be a JPG, JPEG, PNG or WEBP file.',
            'book_now_image.dimensions' => 'The image field has invalid image dimensions.',
            'book_now_image.max' => 'The image field must not be greater than 100 kilobytes.',

            'book_now_status.required' => 'The status field is required.',
        ]);

        $homeFileName = $resort->home_image;
        if ($request->hasFile('home_image')) {
            $file = $request->file('home_image');
            $homeFileName = time() . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/resorts'), $homeFileName);

            if ($resort->home_image && file_exists(public_path('uploads/resorts/' . $resort->home_image))) {
                unlink(public_path('uploads/resorts/' . $resort->home_image));
            }
        }

        $validated['home_image'] = $homeFileName;

        $megaMenuFileName = $resort->mega_menu_image;
        if ($request->hasFile('mega_menu_image')) {
            $file = $request->file('mega_menu_image');
            $megaMenuFileName = time() . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/resorts'), $megaMenuFileName);

            if ($resort->mega_menu_image && file_exists(public_path('uploads/resorts/' . $resort->mega_menu_image))) {
                unlink(public_path('uploads/resorts/' . $resort->mega_menu_image));
            }
        }

        $validated['mega_menu_image'] = $megaMenuFileName;

        $bookNowFileName = $resort->book_now_image;
        if ($request->hasFile('book_now_image')) {
            $file = $request->file('book_now_image');
            $bookNowFileName = time() . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/resorts'), $bookNowFileName);

            if ($resort->book_now_image && file_exists(public_path('uploads/resorts/' . $resort->book_now_image))) {
                unlink(public_path('uploads/resorts/' . $resort->book_now_image));
            }
        }

        $validated['book_now_image'] = $bookNowFileName;

        if ($type !== '1') {
            $resort->timestamps = false;
        }

        $timestampColumn = match ($type) {
            '2' => 'home_updated_at',
            '3' => 'mega_menu_updated_at',
            '4' => 'book_now_updated_at',
            default => null,
        };

        $validated[$timestampColumn] = now();

        $resort->update($validated);

        return redirect()->route('admin.resorts.index', ['type' => $type])->with('success', 'Data updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($type, Resort $resort)
    {
        if (
            $resort->testimonials()->where('status', Status::ACTIVE->value)->exists() ||
            $resort->galleries()->where('status', Status::ACTIVE->value)->exists() ||
            $resort->offers()->where('status', Status::ACTIVE->value)->exists() ||
            $resort->home_status === Status::ACTIVE ||
            $resort->mega_menu_status === Status::ACTIVE ||
            $resort->book_now_status === Status::ACTIVE
        ) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unable to delete this resort because it contains active associated data.',
            ], 422);
        }

        $resort->delete();

        return response()->json(['status' => 'success', 'message' => 'Data deleted successfully!']);
    }
}
