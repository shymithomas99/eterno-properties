<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Offer;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Enums\Status;
use App\Models\Resort;
use Illuminate\Validation\Rule;

class OfferController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, DataTables $dataTables, $type)
    {
        if ($request->ajax()) {

            $query = Offer::with('resort')->select('id', 'resort_id', 'image', 'title', 'status', 'sort_order', 'created_at')->where('type', $type)->orderBy('id', 'DESC');

            return $dataTables->eloquent($query)
                ->addColumn('resort_name', function (Offer $offer) {
                    return $offer->resort?->name;
                })
                ->filterColumn('resort_name', function ($query, $keyword) {
                    $query->whereHas('resort', function ($q) use ($keyword) {
                        $q->where('name', 'like', "%{$keyword}%");
                    });
                })
                ->orderColumn('resort_name', function ($query, $order) {
                    $query->orderBy(
                        Resort::select('name')
                            ->whereColumn('resorts.id', 'offers.resort_id')
                            ->limit(1),
                        $order
                    );
                })
                ->editColumn('image', function (Offer $offer) {
                    $image_url = $offer->image
                        ? asset('uploads/offers/' . $offer->image)
                        : asset('img/blank-pic.png');
                    return '<img src="' . $image_url . '" width="100" height="90" class="img-thumbnail" />';
                })
                ->editColumn('status', function (Offer $offer) {
                    $class = match ($offer->status) {
                        Status::ACTIVE => 'success',
                        Status::INACTIVE => 'danger',
                    };

                    return '<span class="badge badge-' . $class . '">'
                        . $offer->status->label()
                        . '</span>';
                })
                ->addColumn('actions', function (Offer $offer) use ($type) {
                    return
                        '<a href="' . route('admin.offers.show', ['type' => $type, 'offer' => $offer]) . '"
                    class="btn btn-sm" title="View">
                    <i class="fa fa-eye"></i>
                </a>
                <a href="' . route('admin.offers.edit', ['type' => $type, 'offer' => $offer]) . '"
                    class="btn btn-sm" title="Edit">
                    <i class="fa fa-edit"></i>
                </a>
                <a data-toggle="modal"
                    href="#delete-offer-modal"
                    data-href="' . route('admin.offers.destroy', ['type' => $type, 'offer' => $offer]) . '"
                    class="btn btn-sm offer-delete"
                    title="Delete">
                    <i class="fa fa-trash"></i>
                </a>';
                })
                ->rawColumns(['image', 'status', 'actions'])
                ->make(true);
        }
        return view('admin.offers.index', compact('type'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($type)
    {
        $offer = new Offer();
        $resorts = Resort::orderBy('sort_order', 'ASC')
            ->pluck('name', 'id');

        return view('admin.offers.form', compact('type', 'offer', 'resorts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $type)
    {
        $validated = $request->validate([
            'resort_id' => [
                $type == 2 ? 'required' : 'nullable',
                'exists:resorts,id',
            ],
            'title' => [
                $type == 2 ? 'required' : 'nullable',
                'string',
                'max:255',
            ],
            'description' => [
                $type == 2 ? 'required' : 'nullable',
            ],
            'content' => [
                $type == 2 ? 'required' : 'nullable',
            ],
            'button_text' => ['required', 'string'],
            // 'button_url' => ['nullable', 'url'],
            'button_url' => $type == 1
                ? ['required', 'url']
                : ['nullable'],
            'image' => [
                'required',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:200',

                Rule::when(
                    $type == 1,
                    Rule::dimensions()
                        ->width(648)
                        ->height(592)
                ),

                Rule::when(
                    $type == 2,
                    Rule::dimensions()
                        ->width(800)
                        ->height(533)
                ),
            ],
            'sort_order' => ['required', 'integer', 'min:1'],
            'status' => ['required', Rule::enum(Status::class)],
        ]);

        $fileName = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/offers'), $fileName);
        }

        $validated['image'] = $fileName;
        $validated['type'] = $type;

        Offer::create($validated);

        return redirect()->route('admin.offers.index', ['type' => $type])->with('success', 'Data added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show($type, Offer $offer)
    {
        return view('admin.offers.show', compact('type', 'offer'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($type, Offer $offer)
    {
        $resorts = Resort::orderBy('sort_order', 'ASC')
            ->pluck('name', 'id');

        return view('admin.offers.form', compact('type', 'offer', 'resorts'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $type, Offer $offer)
    {
        $validated = $request->validate(
            [
                'resort_id' => [
                    $type == 2 ? 'required' : 'nullable',
                    'exists:resorts,id',
                ],
                'title' => [
                    $type == 2 ? 'required' : 'nullable',
                    'string',
                    'max:255',
                ],
                'description' => [
                    $type == 2 ? 'required' : 'nullable',
                ],
                'content' => [
                    $type == 2 ? 'required' : 'nullable',
                ],
                'button_text' => ['required', 'string', 'max:255'],
                'button_url' => $type == 1
                    ? ['required', 'url']
                    : ['nullable'],
                // 'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
                'image' => [
                    'nullable',
                    'image',
                    'mimes:jpg,jpeg,png,webp',
                    'max:200',

                    Rule::when(
                        $type == 1,
                        Rule::dimensions()
                            ->width(648)
                            ->height(592)
                    ),

                    Rule::when(
                        $type == 2,
                        Rule::dimensions()
                            ->width(800)
                            ->height(533)
                    ),
                ],
                'sort_order' => ['required', 'integer', 'min:1'],
                'status' => ['required', Rule::enum(Status::class)],
            ],
            [
                'resort_id.required' => ['The resort field is required.'],
            ]
        );


        $fileName = $offer->image;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/offers'), $fileName);

            if ($offer->image && file_exists(public_path('uploads/offers/' . $offer->image))) {
                unlink(public_path('uploads/offers/' . $offer->image));
            }
        }

        $validated['image'] = $fileName;
        $validated['type'] = $type;

        $offer->update($validated);

        return redirect()->route('admin.offers.index', ['type' => $type])->with('success', 'Data updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($type, Offer $offer)
    {
        $offer->delete();

        return response()->json(['status' => 'success', 'message' => 'Data deleted successfully!']);
    }
}
