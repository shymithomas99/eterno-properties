<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BookingEnquiry;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class BookingEnquiryController extends Controller
{
    public function index(Request $request, DataTables $dataTables)
    {
        if ($request->ajax()) {
            return $dataTables->eloquent(BookingEnquiry::query()->latest())
                ->addIndexColumn()
                ->editColumn('created_at', fn($row) => $row->created_at->format('d M Y'))
                ->addColumn('actions', function ($row) {
                    return '<a href="' . route('admin.booking-enquiry.show', $row) . '" class="btn btn-sm" title="View"><i class="fa fa-eye"></i></a>
                        <a href="#delete-booking-modal" class="btn btn-sm booking-delete" data-toggle="modal" data-href="' . route('admin.booking-enquiry.destroy', $row) . '" title="Delete"><i class="fa fa-trash"></i></a>';
                })
                ->rawColumns(['actions'])
                ->make(true);
        }

        return view('admin.booking-enquiry.index');
    }

    public function show(BookingEnquiry $bookingEnquiry)
    {
        return view('admin.booking-enquiry.show', compact('bookingEnquiry'));
    }

    public function destroy(BookingEnquiry $bookingEnquiry)
    {
        $bookingEnquiry->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Booking enquiry deleted successfully.',
        ]);
    }
}
