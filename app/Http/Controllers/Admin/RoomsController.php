<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\RoomGallery;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RoomsController extends Controller
{
    /**
     * Display rooms.
     */
    public function index()
    {
        $rooms = Room::orderBy('sort_order')
            ->orderBy('id', 'desc')
            ->paginate(20);

        return view('admin.rooms.index', compact('rooms'));
    }

    /**
     * Create room.
     */
    public function create()
    {
        $room = new Room();

        return view('admin.rooms.form', compact('room'));
    }

    /**
     * Store room.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'slug' => [
                'required',
                'string',
                'alpha_dash',
                'unique:rooms,slug',
            ],

            'description' => [
                'nullable',
                'string',
            ],

            'bed_type' => [
                'nullable',
                'string',
                'max:255',
            ],

            'guests' => [
                'nullable',
                'string',
                'max:255',
            ],

            'size' => [
                'nullable',
                'string',
                'max:255',
            ],

            'view' => [
                'nullable',
                'string',
                'max:255',
            ],

            'main_image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:100',
                'dimensions:width=850,height=630',
            ],

            'sort_order' => [
                'nullable',
                'integer',
                'min:0',
            ],
        ]);

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

        $room = Room::create([
            'name' => $request->name,
            'slug' => $request->slug,
            'description' => $request->description,
            'bed_type' => $request->bed_type,
            'guests' => $request->guests,
            'size' => $request->size,
            'view' => $request->view,
            'main_image' => $fileName,
            'published' => $request->boolean('published'),
            'sort_order' => $request->sort_order ?? 0,
        ]);

        return redirect()
            ->route('admin.rooms.gallery-images-form', $room->id)
            ->with('success', 'Room added successfully');
    }

    /**
     * Display room.
     */
    public function show(Room $room)
    {
        return view('admin.rooms.show', compact('room'));
    }

    /**
     * Edit room.
     */
    public function edit(Room $room)
    {
        return view('admin.rooms.form', compact('room'));
    }

    /**
     * Update room.
     */
    public function update(Request $request, Room $room)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'slug' => [
                'required',
                'string',
                'alpha_dash',
                Rule::unique('rooms', 'slug')
                    ->ignore($room->id),
            ],

            'description' => [
                'nullable',
                'string',
            ],

            'bed_type' => [
                'nullable',
                'string',
                'max:255',
            ],

            'guests' => [
                'nullable',
                'string',
                'max:255',
            ],

            'size' => [
                'nullable',
                'string',
                'max:255',
            ],

            'view' => [
                'nullable',
                'string',
                'max:255',
            ],

            'main_image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:100',
                'dimensions:width=850,height=630',
            ],

            'sort_order' => [
                'nullable',
                'integer',
                'min:0',
            ],
        ]);

        $fileName = $room->main_image;

        if ($request->hasFile('main_image')) {

            $file = $request->file('main_image');

            $fileName = time() . '_' . uniqid() . '.' .
                $file->getClientOriginalExtension();

            $file->move(
                public_path('uploads/rooms'),
                $fileName
            );

            if (
                $room->main_image &&
                file_exists(
                    public_path(
                        'uploads/rooms/' .
                            $room->main_image
                    )
                )
            ) {
                unlink(
                    public_path(
                        'uploads/rooms/' .
                            $room->main_image
                    )
                );
            }
        }

        $room->update([
            'name' => $request->name,
            'slug' => $request->slug,
            'description' => $request->description,
            'bed_type' => $request->bed_type,
            'guests' => $request->guests,
            'size' => $request->size,
            'view' => $request->view,
            'main_image' => $fileName,
            'published' => $request->boolean('published'),
            'sort_order' => $request->sort_order ?? 0,
        ]);

        return redirect()
            ->route('admin.rooms.gallery-images-form', $room->id)
            ->with('success', 'Room updated successfully');
    }

    /**
     * Delete room.
     */
    public function destroy(Room $room)
    {
        if (
            $room->main_image &&
            file_exists(
                public_path(
                    'uploads/rooms/' .
                        $room->main_image
                )
            )
        ) {
            unlink(
                public_path(
                    'uploads/rooms/' .
                        $room->main_image
                )
            );
        }

        foreach ($room->galleryImages as $gallery) {

            $path = public_path(
                'uploads/rooms/gallery-images/' .
                    $gallery->image
            );

            if (file_exists($path)) {
                unlink($path);
            }
        }

        $room->delete();

        return redirect()
            ->route('admin.rooms.index')
            ->with('success', 'Room deleted successfully');
    }

    /**
     * Toggle publish.
     */
    public function togglePublish($id)
    {
        $room = Room::findOrFail($id);

        $room->update([
            'published' => !$room->published,
        ]);

        $message = $room->published
            ? 'Room published successfully'
            : 'Room moved to draft';

        return back()->with('success', $message);
    }

    /**
     * Gallery form.
     */
    public function galleryImagesForm($id)
    {
        $room = Room::findOrFail($id);

        return view(
            'admin.rooms.gallery-images-form',
            compact('room')
        );
    }

    /**
     * Upload gallery image.
     */
    public function uploadImage(Request $request)
    {
        // $request->validate([
        //     'file' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        // ]);

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
    public function deleteImage(Request $request)
    {
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
