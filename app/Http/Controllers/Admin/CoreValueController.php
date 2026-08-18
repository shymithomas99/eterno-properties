<?php

namespace App\Http\Controllers\Admin;

use App\Enums\AboutStatus;
use App\Http\Controllers\Controller;
use App\Models\AboutCoreValue;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Yajra\DataTables\DataTables;

class CoreValueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, DataTables $dataTables)
    {
        if ($request->ajax()) {

            $query = AboutCoreValue::select(
                'id',
                'title',
                'description',

                'sort_order',
                'status',
                'created_at'
            )->orderBy('sort_order')
                ->orderByDesc('id');

            return $dataTables->eloquent($query)

                ->addIndexColumn()

                // ->editColumn('icon_image', function (AboutCoreValue $coreValue) {

                //     if (!$coreValue->icon_image) {
                //         return '-';
                //     }

                //     return '<img src="' . asset($coreValue->icon_image) . '"
                //                 width="50"
                //                 height="50"
                //                 class="img-thumbnail">';
                // })

                ->editColumn('created_at', function (AboutCoreValue $coreValue) {

                    return $coreValue->created_at->format('d-m-Y');
                })

                ->editColumn('status', function (AboutCoreValue $coreValue) {

                    $class = match ($coreValue->status) {

                        AboutStatus::ACTIVE => 'success',

                        AboutStatus::INACTIVE => 'secondary',
                    };

                    return '<span class="badge badge-' . $class . '">'
                        . $coreValue->status->label()
                        . '</span>';
                })

                ->addColumn('actions', function (AboutCoreValue $coreValue) {

                    return '

                        <a href="' . route('admin.core-values.edit', $coreValue) . '"
                            class="btn btn-sm"
                            title="Edit">

                            <i class="fa fa-edit"></i>

                        </a>

                        <a href="#delete-core-value-modal"
                            class="btn btn-sm core-value-delete"
                            data-toggle="modal"
                            data-href="' . route('admin.core-values.destroy', $coreValue) . '"
                            title="Delete">

                            <i class="fa fa-trash"></i>

                        </a>

                    ';
                })

                ->rawColumns([
                    // 'icon_image',
                    'status',
                    'actions'
                ])

                ->make(true);
        }

        return view('admin.about.core-values.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $coreValue = new AboutCoreValue();

        return view(
            'admin.about.core-values.form',
            compact('coreValue')
        );
    }

    /**
     * Store a newly created resource.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([

            'title' => ['required', 'string', 'max:255'],

            'description' => ['required'],

            // 'icon_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp'],

            'sort_order' => ['required', 'integer'],

            'status' => ['required', Rule::enum(AboutStatus::class)]

        ]);

        /*
        |--------------------------------------------------------------------------
        | Upload Image
        |--------------------------------------------------------------------------
        */

        // if ($request->hasFile('icon_image')) {

        //     $image = $request->file('icon_image');

        //     $imageName = time() . '_corevalue.' .
        //         $image->getClientOriginalExtension();

        //     $image->move(
        //         public_path('img/about/core-values'),
        //         $imageName
        //     );

        //     $validated['icon_image'] =
        //         'img/about/core-values/' . $imageName;
        // }

        AboutCoreValue::create($validated);

        return redirect()
            ->route('admin.core-values.index')
            ->with('success', 'Core Value added successfully.');
    }

    /**
     * Show the form for editing.
     */
    public function edit(AboutCoreValue $coreValue)
    {
        return view(
            'admin.about.core-values.form',
            compact('coreValue')
        );
    }

    /**
     * Update the specified resource.
     */
    public function update(Request $request, AboutCoreValue $coreValue)
    {
        $validated = $request->validate([

            'title' => ['required', 'string', 'max:255'],

            'description' => ['required'],

            // 'icon_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp'],

            'sort_order' => ['required', 'integer'],

            'status' => ['required', Rule::enum(AboutStatus::class)]

        ]);

        /*
        |--------------------------------------------------------------------------
        | Replace Image
        |--------------------------------------------------------------------------
        */

        // if ($request->hasFile('icon_image')) {

        //     if (
        //         $coreValue->icon_image &&
        //         file_exists(public_path($coreValue->icon_image))
        //     ) {
        //         unlink(public_path($coreValue->icon_image));
        //     }

        //     $image = $request->file('icon_image');

        //     $imageName = time() . '_corevalue.' .
        //         $image->getClientOriginalExtension();

        //     $image->move(
        //         public_path('img/about/core-values'),
        //         $imageName
        //     );

        //     $validated['icon_image'] =
        //         'img/about/core-values/' . $imageName;
        // }

        $coreValue->update($validated);

        return redirect()
            ->route('admin.core-values.index')
            ->with('success', 'Core Value updated successfully.');
    }

    /**
     * Remove the specified resource.
     */
    public function destroy(AboutCoreValue $coreValue)
    {
        // if (
        //     $coreValue->icon_image &&
        //     file_exists(public_path($coreValue->icon_image))
        // ) {
        //     unlink(public_path($coreValue->icon_image));
        // }

        $coreValue->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Core Value deleted successfully!'
        ]);
    }
}