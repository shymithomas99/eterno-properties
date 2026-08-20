<?php

namespace App\Http\Controllers\Admin;

use App\Enums\Status;
use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\RoomGallery;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RoomsController extends Controller
{
    /**
     * Display rooms.
     */
    public function index($type)
    {
        $rooms = Room::where('type', $type)
            ->orderBy('sort_order')
            ->orderBy('id', 'desc')
            ->paginate(20);

        return view('admin.rooms.index', compact('rooms', 'type'));
    }

    /**
     * Create room.
     */
    public function create($type)
    {
        $room = new Room();

        return view('admin.rooms.form', compact('room', 'type'));
    }

    /**
     * Store room.
     */
    public function store(Request $request, $type)
    {
        $rules = [
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'description' => [
                'nullable',
                'string',
            ],

            'main_image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:200',
                'dimensions:width=850,height=630',
            ],

            'sort_order' => [
                'nullable',
                'integer',
                'min:0',
            ],

            'status' => [
                'required',
                Rule::in(['active', 'inactive']),
            ],
        ];

        /*
        |--------------------------------------------------------------------------
        | Type 2 Validation
        |--------------------------------------------------------------------------
        |
        | Slug must be unique only within the same type.
        |
        */
        if ((int) $type === 2) {

            $rules['slug'] = [
                'required',
                'string',
                'alpha_dash',
                Rule::unique('rooms', 'slug')
                    ->where(function ($query) use ($type) {
                        return $query->where('type', $type);
                    }),
            ];

            foreach (['bed_type', 'guests', 'size', 'view'] as $field) {
                $rules[$field] = [
                    'nullable',
                    'string',
                    'max:255',
                ];
            }
        }

        $validated = $request->validate($rules);

        /*
        |--------------------------------------------------------------------------
        | Upload Main Image
        |--------------------------------------------------------------------------
        */

        $fileName = null;

        if ($request->hasFile('main_image')) {

            $file = $request->file('main_image');

            $fileName = time() . '_' . uniqid() . '.' .
                $file->getClientOriginalExtension();

            $file->move(
                public_path('uploads/rooms'),
                $fileName
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Create Room
        |--------------------------------------------------------------------------
        */

        $room = Room::create([
            'type' => $type,

            'name' => $request->name,

            /*
            | Type 1:
            | Generate slug automatically.
            |
            | Type 2:
            | Use the slug entered by the user.
            */
            'slug' => $type == 1
                ? $this->uniqueSlug($request->name, $type)
                : $request->slug,

            'description' => $request->description,

            'bed_type' => $type == 2
                ? $request->bed_type
                : null,

            'guests' => $type == 2
                ? $request->guests
                : null,

            'size' => $type == 2
                ? $request->size
                : null,

            'view' => $type == 2
                ? $request->view
                : null,

            'main_image' => $fileName,

            'status' => $validated['status'],

            'sort_order' => $request->sort_order ?? 0,
        ]);

        /*
        |--------------------------------------------------------------------------
        | Redirect
        |--------------------------------------------------------------------------
        */

        if ((int) $type === 1) {

            return redirect()
                ->route('admin.rooms.index', $type)
                ->with('success', 'Home room added successfully');
        }

        return redirect()
            ->route('admin.rooms.gallery-images-form', [
                'type' => $type,
                'id' => $room->id,
            ])
            ->with('success', 'Room added successfully');
    }

    /**
     * Display room.
     */
    public function show($type, Room $room)
    {
        return view('admin.rooms.show', compact('room', 'type'));
    }

    /**
     * Edit room.
     */
    public function edit($type, Room $room)
    {
        return view('admin.rooms.form', compact('room', 'type'));
    }

    /**
     * Update room.
     */
    public function update(Request $request, $type, Room $room)
    {
        $rules = [
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'description' => [
                'nullable',
                'string',
            ],

            'main_image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:200',
                'dimensions:width=850,height=630',
            ],

            'sort_order' => [
                'nullable',
                'integer',
                'min:0',
            ],

            'status' => [
                'required',
                Rule::in(['active', 'inactive']),
            ],
        ];

        /*
        |--------------------------------------------------------------------------
        | Type 2 Validation
        |--------------------------------------------------------------------------
        |
        | Slug is unique only for the current type.
        | The current room is ignored while updating.
        |
        */
        if ((int) $type === 2) {

            $rules['slug'] = [
                'required',
                'string',
                'alpha_dash',

                Rule::unique('rooms', 'slug')
                    ->where(function ($query) use ($type) {
                        return $query->where('type', $type);
                    })
                    ->ignore($room->id),
            ];

            foreach (['bed_type', 'guests', 'size', 'view'] as $field) {
                $rules[$field] = [
                    'nullable',
                    'string',
                    'max:255',
                ];
            }
        }

        $validated = $request->validate($rules);

        /*
        |--------------------------------------------------------------------------
        | Existing Main Image
        |--------------------------------------------------------------------------
        */

        $fileName = $room->main_image;

        /*
        |--------------------------------------------------------------------------
        | Upload New Main Image
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('main_image')) {

            $file = $request->file('main_image');

            $fileName = time() . '_' . uniqid() . '.' .
                $file->getClientOriginalExtension();

            $file->move(
                public_path('uploads/rooms'),
                $fileName
            );

            /*
            |--------------------------------------------------------------------------
            | Delete Old Image
            |--------------------------------------------------------------------------
            */

            if (
                $room->main_image &&
                file_exists(
                    public_path(
                        'uploads/rooms/' . $room->main_image
                    )
                )
            ) {
                unlink(
                    public_path(
                        'uploads/rooms/' . $room->main_image
                    )
                );
            }
        }

        /*
        |--------------------------------------------------------------------------
        | Update Room
        |--------------------------------------------------------------------------
        */

        $room->update([
            'name' => $request->name,

            /*
            | Type 1:
            | Automatically generate a slug based on type.
            |
            | Type 2:
            | Use the submitted slug.
            */
            'slug' => $type == 1
                ? $this->uniqueSlug(
                    $request->name,
                    $type,
                    $room->id
                )
                : $request->slug,

            'description' => $request->description,

            'bed_type' => $type == 2
                ? $request->bed_type
                : null,

            'guests' => $type == 2
                ? $request->guests
                : null,

            'size' => $type == 2
                ? $request->size
                : null,

            'view' => $type == 2
                ? $request->view
                : null,

            'main_image' => $fileName,

            'status' => $validated['status'],

            'sort_order' => $request->sort_order ?? 0,
        ]);

        /*
        |--------------------------------------------------------------------------
        | Redirect
        |--------------------------------------------------------------------------
        */

        if ((int) $type === 1) {

            return redirect()
                ->route('admin.rooms.index', $type)
                ->with('success', 'Home room updated successfully');
        }

        return redirect()
            ->route('admin.rooms.gallery-images-form', [
                'type' => $type,
                'id' => $room->id,
            ])
            ->with('success', 'Room updated successfully');
    }

    /**
     * Delete room.
     */
    public function destroy($type, Room $room)
    {
        /*
        |--------------------------------------------------------------------------
        | Delete Main Image
        |--------------------------------------------------------------------------
        */

        if (
            $room->main_image &&
            file_exists(
                public_path(
                    'uploads/rooms/' . $room->main_image
                )
            )
        ) {
            unlink(
                public_path(
                    'uploads/rooms/' . $room->main_image
                )
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Delete Gallery Images
        |--------------------------------------------------------------------------
        */

        foreach ($room->galleryImages as $gallery) {

            $path = public_path(
                'uploads/rooms/gallery-images/' .
                    $gallery->image
            );

            if (file_exists($path)) {
                unlink($path);
            }
        }

        /*
        |--------------------------------------------------------------------------
        | Delete Room
        |--------------------------------------------------------------------------
        */

        $room->delete();

        return redirect()
            ->route('admin.rooms.index', $type)
            ->with('success', 'Room deleted successfully');
    }

    /**
     * Generate unique slug based on type.
     *
     * Example:
     *
     * Type 1:
     * deluxe-room
     *
     * Type 2:
     * deluxe-room
     *
     * Type 1 duplicate:
     * deluxe-room-2
     *
     * Type 2 duplicate:
     * deluxe-room-2
     */
    private function uniqueSlug(
        string $name,
        int $type,
        ?int $ignoreId = null
    ): string {
        $slug = Str::slug($name) ?: 'room';

        $candidate = $slug;

        $suffix = 2;

        while (
            Room::where('slug', $candidate)
            ->where('type', $type)
            ->when(
                $ignoreId,
                fn($query) => $query->where(
                    'id',
                    '!=',
                    $ignoreId
                )
            )
            ->exists()
        ) {
            $candidate = $slug . '-' . $suffix++;
        }

        return $candidate;
    }

    /**
     * Toggle publish.
     */
    public function togglePublish($type, $id)
    {
        $room = Room::findOrFail($id);

        $room->update([
            'status' => $room->status === Status::ACTIVE
                ? Status::INACTIVE
                : Status::ACTIVE,
        ]);

        $message = $room->status === Status::ACTIVE
            ? 'Room published successfully'
            : 'Room moved to draft';

        return back()->with('success', $message);
    }

    /**
     * Gallery form.
     */
    public function galleryImagesForm($type, $id)
    {
        abort_if((int) $type === 1, 404);

        $room = Room::findOrFail($id);

        return view(
            'admin.rooms.gallery-images-form',
            compact('room', 'type')
        );
    }

    /**
     * Upload gallery image.
     */
    public function uploadImage(Request $request, $type)
    {
        abort_if((int) $type === 1, 404);

        $request->validate([
            'file' => [
                'required',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:100',
                'dimensions:width=850,height=630',
            ],
        ]);

        $room = Room::findOrFail($request->id);

        $file = $request->file('file');

        $fileName = time() . '_' . uniqid() . '.' .
            $file->getClientOriginalExtension();

        $file->move(
            public_path('uploads/rooms/gallery-images'),
            $fileName
        );

        $gallery = RoomGallery::create([
            'room_id' => $room->id,
            'image' => $fileName,
        ]);

        return response()->json([
            'success' => true,
            'image_id' => $gallery->id,
        ]);
    }

    /**
     * Delete gallery image.
     */
    public function deleteImage(Request $request, $type)
    {
        abort_if((int) $type === 1, 404);

        $gallery = RoomGallery::findOrFail($request->id);

        $path = public_path(
            'uploads/rooms/gallery-images/' .
                $gallery->image
        );

        if (file_exists($path)) {
            unlink($path);
        }

        $gallery->delete();

        return response()->json([
            'success' => true,
        ]);
    }
}
