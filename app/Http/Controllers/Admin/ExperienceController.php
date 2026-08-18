<?php

namespace App\Http\Controllers\Admin;

use App\Enums\ExperienceStatus;
use App\Http\Controllers\Controller;
use App\Models\Experience;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Yajra\DataTables\DataTables;

class ExperienceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, DataTables $dataTables, $type)
    {
        if ($request->ajax()) {

            $query = Experience::select(
                'id',
                'subtitle',
                'title',
                'image',
                'layout',
                'sort_order',
                'status',
                'created_at'
            )->where('type', $type)
                ->orderBy('sort_order')
                ->orderByDesc('id');

            return $dataTables->eloquent($query)

                ->addIndexColumn()




                ->editColumn('image', function (Experience $experience) {

                    $image_url = $experience->image
                        ? asset('uploads/experience/items/' . $experience->image)
                        : asset('img/blank-pic.png');

                    return '<img src="' . $image_url . '"
        width="100"
        height="90"
        class="img-thumbnail" />';
                })

                ->editColumn('status', function (Experience $experience) {

                    $class = match ($experience->status) {
                        ExperienceStatus::ACTIVE => 'success',
                        ExperienceStatus::INACTIVE => 'danger',
                    };

                    return '<span class="badge badge-' . $class . '">'
                        . $experience->status->label()
                        . '</span>';
                })

                ->editColumn('layout', function (Experience $experience) {

                    return ucfirst($experience->layout);
                })


                ->editColumn('created_at', function (Experience $experience) {

                    return $experience->created_at->format('d-m-Y');
                })

                ->addColumn('actions', function (Experience $experience) use ($type) {

                    return '

                    <a href="' . route('admin.experience-items.edit', ['type' => $type, 'experience' => $experience]) . '"
                        class="btn btn-sm"
                        title="Edit">

                        <i class="fa fa-edit"></i>

                    </a>

                    <a
                        href="#delete-experience-modal"
                        class="btn btn-sm experience-delete"
                        data-toggle="modal"
                        data-href="' . route('admin.experience-items.destroy', ['type' => $type, 'experience' => $experience]) . '"
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

        return view('admin.experience.items.index', compact('type'));
    }


    public function create($type)
    {
        $experience = new Experience();

        return view(
            'admin.experience.items.form',
            compact('experience', 'type')
        );
    }


    public function store(Request $request, $type)
    {

        $validated = $request->validate([

            // 'subtitle' => 'nullable|max:255',
            'subtitle' => [
                'string',
                'max:255',

                Rule::when(
                    (int) $type === 2,
                    ['required']
                ),
            ],

            'title' => 'required|max:255',

            'description' => 'required',

            // 'experience_list' => 'nullable',
            'experience_list' => [


                Rule::when(
                    (int) $type === 2,
                    ['required']
                ),
            ],


            'image' => [
                'required',
                // 'image',
                'mimes:jpg,jpeg,png,webp,svg',

                Rule::when(
                    $type == 1,
                    [
                        'max:50',
                        Rule::dimensions()
                            ->width(48)
                            ->height(48),
                    ]
                ),

                Rule::when(
                    $type == 2,
                    [
                        'max:200',
                        Rule::dimensions()
                            ->width(746)
                            ->height(798),
                    ]
                ),
            ],

            'layout' => 'nullable|in:left,right',

            'sort_order' => 'required|integer',

            'status' => ['required', Rule::enum(ExperienceStatus::class)]

        ]);


        if ($request->hasFile('image')) {

            $image = $request->file('image');

            $imageName = time() . '_experience.' .
                $image->getClientOriginalExtension();

            $image->move(
                public_path('uploads/experience/items'),
                $imageName
            );

            // $validated['image'] =
            //     'uploads/experience/items/' . $imageName;
            $validated['image'] = $imageName;
        }

        $validated['type'] = $type;

        Experience::create($validated);

        return redirect()
            ->route('admin.experience-items.index', $type)
            ->with(
                'success',
                'Experience added successfully.'
            );
    }




    public function edit($type, $id)
    {
        // dd($id);

        $experience = Experience::findOrFail($id);

        return view(
            'admin.experience.items.form',
            compact('experience', 'type')
        );
    }

    public function update(Request $request, $type, $id)
    {
        $experience = Experience::findOrFail($id);

        $validated = $request->validate([

            'subtitle' => [
                'string',
                'max:255',

                Rule::when(
                    (int) $type === 2,
                    ['required']
                ),
            ],

            'title' => 'required|max:255',

            'description' => 'required',

            'experience_list' => [


                Rule::when(
                    (int) $type === 2,
                    ['required']
                ),
            ],

            // 'image' => 'nullable|image|mimes:jpg,jpeg,png,webp',
            'image' => [
                'nullable',
                // 'image',
                'mimes:jpg,jpeg,png,webp,svg',

                Rule::when(
                    $type == 1,
                    [
                        'max:50',
                        Rule::dimensions()
                            ->width(48)
                            ->height(48),
                    ]
                ),

                Rule::when(
                    $type == 2,
                    [
                        'max:200',
                        Rule::dimensions()
                            ->width(746)
                            ->height(798),
                    ]
                ),
            ],

            'layout' => 'nullable|in:left,right',

            'sort_order' => 'required|integer',

            'status' => ['required', Rule::enum(ExperienceStatus::class)]

        ]);


        if ($request->hasFile('image')) {

            if (
                $experience->image &&
                file_exists(public_path($experience->image))
            ) {

                unlink(public_path($experience->image));
            }

            $image = $request->file('image');

            $imageName = time() . '_experience.' .
                $image->getClientOriginalExtension();

            $image->move(
                public_path('uploads/experience/items'),
                $imageName
            );

            $validated['image'] = $imageName;
        }

        $experience->update($validated);

        return redirect()
            ->route('admin.experience-items.index', $type)
            ->with('success', 'Updated Successfully');
    }


    public function destroy($type, $id)
    {
        $experience = Experience::findOrFail($id);

        if (
            $experience->image &&
            file_exists(public_path($experience->image))
        ) {
            unlink(public_path($experience->image));
        }

        $experience->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Deleted Successfully'
        ]);
    }
}
