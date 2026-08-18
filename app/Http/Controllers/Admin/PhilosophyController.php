<?php

namespace App\Http\Controllers\Admin;

use App\Enums\AboutStatus;
use App\Http\Controllers\Controller;
use App\Models\AboutPhilosophy;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Yajra\DataTables\DataTables;

class PhilosophyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, DataTables $dataTables)
    {
        if ($request->ajax()) {

            $query = AboutPhilosophy::select(
                'id',
                'title',
                'description',
                'icon_image',
                'sort_order',
                'status',
                'created_at'
            )->orderBy('sort_order')
                ->orderByDesc('id');

            return $dataTables->eloquent($query)

                // ->editColumn('icon_image', function (AboutPhilosophy $philosophy) {

                //     if (!$philosophy->icon_image) {
                //         return '-';
                //     }

                //     return '<img src="' . asset($philosophy->icon_image) . '"
                //                  width="50"
                //                  height="50"
                //                  class="img-thumbnail">';
                // })

                // ->editColumn('status', function (AboutPhilosophy $philosophy) {

                //     $class = match ($philosophy->status) {

                //         AboutStatus::ACTIVE => 'success',

                //         AboutStatus::INACTIVE => 'secondary',
                //     };

                //     return '<span class="badge badge-' . $class . '">'
                //         . $philosophy->status->label()
                //         . '</span>';
                // })


                ->editColumn('icon_image', function (AboutPhilosophy $philosophy) {

                    if (!$philosophy->icon_image) {
                        return '-';
                    }

                    return '<img src="' . asset($philosophy->icon_image) . '"
                width="50"
                height="50"
                class="img-thumbnail"
                style="object-fit: contain;">';
                })

                ->editColumn('status', function (AboutPhilosophy $philosophy) {

                    $class = match ($philosophy->status) {

                        AboutStatus::ACTIVE => 'success',

                        AboutStatus::INACTIVE => 'secondary',
                    };

                    return '<span class="badge badge-' . $class . '">'
                        . $philosophy->status->label()
                        . '</span>';
                })

                ->addColumn('actions', function (AboutPhilosophy $philosophy) {

                    return '

                    <a href="' . route('admin.philosophies.edit', $philosophy) . '"
                       class="btn btn-sm"
                       title="Edit">

                        <i class="fa fa-edit"></i>

                    </a>

                    <a href="#delete-philosophy-modal"
                       class="btn btn-sm philosophy-delete"
                       data-toggle="modal"
                       data-href="' . route('admin.philosophies.destroy', $philosophy) . '"
                       title="Delete">

                        <i class="fa fa-trash"></i>

                    </a>

                    ';
                })

                ->rawColumns([
                    'icon_image',
                    'status',
                    'actions'
                ])

                ->make(true);
        }

        return view('admin.about.philosophy.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $philosophy = new AboutPhilosophy();

        return view(
            'admin.about.philosophy.form',
            compact('philosophy')
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

            // 'icon_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,svg'],
            // 'icon_image' => 'required|mimes:jpg,jpeg,png,gif,webp,svg|max:2048',

            'icon_image' => [
                'required',
                'mimes:jpg,jpeg,png,gif,webp,svg',
                'max:50',
                'dimensions:width=48,height=48',
            ],

            'sort_order' => ['required', 'integer'],

            'status' => ['required', Rule::enum(AboutStatus::class)]

        ]);

        /*
        |--------------------------------------------------------------------------
        | Upload Icon
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('icon_image')) {

            $image = $request->file('icon_image');

            $imageName = time() . '_philosophy.' .
                $image->getClientOriginalExtension();

            $image->move(
                public_path('uploads/about/philosophies'),
                $imageName
            );

            $validated['icon_image'] =
                'uploads/about/philosophies/' . $imageName;
        }

        AboutPhilosophy::create($validated);

        return redirect()
            ->route('admin.philosophies.index')
            ->with('success', 'Data added successfully');
    }

    /**
     * Show the form for editing.
     */
    public function edit(AboutPhilosophy $philosophy)
    {
        return view(
            'admin.about.philosophy.form',
            compact('philosophy')
        );
    }

    /**
     * Update.
     */
    public function update(Request $request, AboutPhilosophy $philosophy)
    {

        $validated = $request->validate([

            'title' => ['required', 'string', 'max:255'],

            'description' => ['required'],

            // 'icon_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,svg'],
            // 'icon_image' => 'nullable|mimes:jpg,jpeg,png,gif,webp,svg|max:2048',

            'icon_image' => [
                'nullable',
                'mimes:jpg,jpeg,png,gif,webp,svg',
                'max:50',
                'dimensions:width=48,height=48',
            ],

            'sort_order' => ['required', 'integer'],

            'status' => ['required', Rule::enum(AboutStatus::class)]

        ]);

        /*
        |--------------------------------------------------------------------------
        | Replace Image
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('icon_image')) {

            if (
                $philosophy->icon_image &&
                file_exists(public_path($philosophy->icon_image))
            ) {
                unlink(public_path($philosophy->icon_image));
            }

            $image = $request->file('icon_image');

            $imageName = time() . '_philosophy.' .
                $image->getClientOriginalExtension();

            $image->move(
                public_path('uploads/about/philosophies'),
                $imageName
            );

            $validated['icon_image'] =
                'uploads/about/philosophies/' . $imageName;
        }

        $philosophy->update($validated);

        return redirect()
            ->route('admin.philosophies.index')
            ->with('success', 'Data updated successfully');
    }

    /**
     * Delete.
     */
    public function destroy(AboutPhilosophy $philosophy)
    {

        if (
            $philosophy->icon_image &&
            file_exists(public_path($philosophy->icon_image))
        ) {
            unlink(public_path($philosophy->icon_image));
        }

        $philosophy->delete();

        return response()->json([

            'status' => 'success',

            'message' => 'Data deleted successfully!'

        ]);
    }
}