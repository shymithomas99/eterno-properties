<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Yajra\DataTables\DataTables;
use App\Enums\Status;

class OfferController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, DataTables $dataTables, $type)
    {
        $type = (int) $type;

        if ($request->ajax()) {

            $query = Offer::select(
                'id',
                'image',
                'title',
                'status',
                'sort_order',
                'created_at'
            )
                ->where('type', $type)
                ->orderBy('id', 'DESC');

            return $dataTables->eloquent($query)

                ->editColumn('image', function (Offer $offer) {

                    $imageUrl = $offer->image
                        ? asset('uploads/offers/' . $offer->image)
                        : asset('img/blank-pic.png');

                    return '<img src="' . $imageUrl . '"
                                width="100"
                                height="90"
                                class="img-thumbnail"
                                style="object-fit: cover;">';
                })

                ->editColumn('status', function (Offer $offer) {

                    $class = match ($offer->status) {
                        Status::ACTIVE => 'success',
                        Status::INACTIVE => 'danger',
                        default => 'secondary',
                    };

                    return '<span class="badge badge-' . $class . '">'
                        . $offer->status->label()
                        . '</span>';
                })

                ->addColumn('actions', function (Offer $offer) use ($type) {

                    return '
                        <a href="' . route('admin.offers.show', [
                        'type' => $type,
                        'offer' => $offer
                    ]) . '"
                            class="btn btn-sm"
                            title="View">
                            <i class="fa fa-eye"></i>
                        </a>

                        <a href="' . route('admin.offers.edit', [
                        'type' => $type,
                        'offer' => $offer
                    ]) . '"
                            class="btn btn-sm"
                            title="Edit">
                            <i class="fa fa-edit"></i>
                        </a>

                        <a data-toggle="modal"
                            href="#delete-offer-modal"
                            data-href="' . route('admin.offers.destroy', [
                        'type' => $type,
                        'offer' => $offer
                    ]) . '"
                            class="btn btn-sm offer-delete"
                            title="Delete">
                            <i class="fa fa-trash"></i>
                        </a>
                    ';
                })

                ->rawColumns([
                    'image',
                    'status',
                    'actions'
                ])

                ->make(true);
        }

        return view('admin.offers.index', compact('type'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($type)
    {
        $type = (int) $type;

        $offer = new Offer();

        return view(
            'admin.offers.form',
            compact('type', 'offer')
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $type)
    {
        $type = (int) $type;

        $validated = $request->validate([

            /*
            |--------------------------------------------------------------------------
            | Type 2 fields
            |--------------------------------------------------------------------------
            */

            'title' => [
                $type === 2 ? 'required' : 'nullable',
                'string',
                'max:255',
            ],

            'description' => [
                $type === 2 ? 'required' : 'nullable',
                'string',
            ],

            /*
            |--------------------------------------------------------------------------
            | Content
            |--------------------------------------------------------------------------
            |
            | Type 1 does NOT need content.
            | Type 2 content is optional.
            |
            */

            'content' => [
                'nullable',
                'string',
            ],

            /*
            |--------------------------------------------------------------------------
            | Button
            |--------------------------------------------------------------------------
            */

            'button_text' => [
                'required',
                'string',
                'max:255',
            ],

            'button_url' => $type === 1
                ? [
                    'required',
                    'url',
                    'max:2048',
                ]
                : [
                    'nullable',
                ],

            /*
            |--------------------------------------------------------------------------
            | Image
            |--------------------------------------------------------------------------
            */

            'image' => [
                'required',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:200',

                Rule::when(
                    $type === 1,
                    Rule::dimensions()
                        ->width(648)
                        ->height(592)
                ),

                Rule::when(
                    $type === 2,
                    Rule::dimensions()
                        ->width(800)
                        ->height(533)
                ),
            ],

            /*
            |--------------------------------------------------------------------------
            | Sort Order
            |--------------------------------------------------------------------------
            */

            'sort_order' => [
                'required',
                'integer',
                'min:1',
            ],

            /*
            |--------------------------------------------------------------------------
            | Status
            |--------------------------------------------------------------------------
            */

            'status' => [
                'required',
                Rule::enum(Status::class),
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | Upload Image
        |--------------------------------------------------------------------------
        */

        $fileName = null;

        if ($request->hasFile('image')) {

            $file = $request->file('image');

            $fileName = time()
                . '-'
                . uniqid()
                . '.'
                . $file->getClientOriginalExtension();

            $uploadPath = public_path('uploads/offers');

            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }

            $file->move(
                $uploadPath,
                $fileName
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Save Data
        |--------------------------------------------------------------------------
        */

        $validated['image'] = $fileName;
        $validated['type'] = $type;

        Offer::create($validated);

        return redirect()
            ->route('admin.offers.index', [
                'type' => $type
            ])
            ->with(
                'success',
                'Data added successfully'
            );
    }

    /**
     * Display the specified resource.
     */
    public function show($type, Offer $offer)
    {
        $type = (int) $type;

        return view(
            'admin.offers.show',
            compact('type', 'offer')
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($type, Offer $offer)
    {
        $type = (int) $type;

        return view(
            'admin.offers.form',
            compact('type', 'offer')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $type, Offer $offer)
    {
        $type = (int) $type;

        $validated = $request->validate([

            /*
            |--------------------------------------------------------------------------
            | Type 2 fields
            |--------------------------------------------------------------------------
            */

            'title' => [
                $type === 2 ? 'required' : 'nullable',
                'string',
                'max:255',
            ],

            'description' => [
                $type === 2 ? 'required' : 'nullable',
                'string',
            ],

            /*
            |--------------------------------------------------------------------------
            | Content
            |--------------------------------------------------------------------------
            */

            'content' => [
                'nullable',
                'string',
            ],

            /*
            |--------------------------------------------------------------------------
            | Button
            |--------------------------------------------------------------------------
            */

            'button_text' => [
                'required',
                'string',
                'max:255',
            ],

            'button_url' => $type === 1
                ? [
                    'required',
                    'url',
                    'max:2048',
                ]
                : [
                    'nullable',
                ],

            /*
            |--------------------------------------------------------------------------
            | Image
            |--------------------------------------------------------------------------
            */

            'image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:200',

                Rule::when(
                    $type === 1,
                    Rule::dimensions()
                        ->width(648)
                        ->height(592)
                ),

                Rule::when(
                    $type === 2,
                    Rule::dimensions()
                        ->width(800)
                        ->height(533)
                ),
            ],

            /*
            |--------------------------------------------------------------------------
            | Sort Order
            |--------------------------------------------------------------------------
            */

            'sort_order' => [
                'required',
                'integer',
                'min:1',
            ],

            /*
            |--------------------------------------------------------------------------
            | Status
            |--------------------------------------------------------------------------
            */

            'status' => [
                'required',
                Rule::enum(Status::class),
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | Existing Image
        |--------------------------------------------------------------------------
        */

        $fileName = $offer->image;

        /*
        |--------------------------------------------------------------------------
        | New Image Upload
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('image')) {

            $file = $request->file('image');

            $fileName = time()
                . '-'
                . uniqid()
                . '.'
                . $file->getClientOriginalExtension();

            $uploadPath = public_path('uploads/offers');

            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }

            $file->move(
                $uploadPath,
                $fileName
            );

            /*
            |--------------------------------------------------------------------------
            | Delete Old Image
            |--------------------------------------------------------------------------
            */

            if (
                $offer->image &&
                file_exists(
                    public_path(
                        'uploads/offers/' . $offer->image
                    )
                )
            ) {
                unlink(
                    public_path(
                        'uploads/offers/' . $offer->image
                    )
                );
            }
        }

        /*
        |--------------------------------------------------------------------------
        | Update Data
        |--------------------------------------------------------------------------
        */

        $validated['image'] = $fileName;
        $validated['type'] = $type;

        $offer->update($validated);

        return redirect()
            ->route('admin.offers.index', [
                'type' => $type
            ])
            ->with(
                'success',
                'Data updated successfully'
            );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($type, Offer $offer)
    {
        $type = (int) $type;

        /*
        |--------------------------------------------------------------------------
        | Delete Image
        |--------------------------------------------------------------------------
        */

        if (
            $offer->image &&
            file_exists(
                public_path(
                    'uploads/offers/' . $offer->image
                )
            )
        ) {
            unlink(
                public_path(
                    'uploads/offers/' . $offer->image
                )
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Delete Offer
        |--------------------------------------------------------------------------
        */

        $offer->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Data deleted successfully!'
        ]);
    }
}
