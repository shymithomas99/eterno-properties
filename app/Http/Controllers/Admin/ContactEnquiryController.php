<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactEnquiry;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ContactEnquiryController extends Controller
{
    public function index(Request $request, DataTables $dataTables)
    {
        if ($request->ajax()) {

            $query = ContactEnquiry::latest();

            return $dataTables->eloquent($query)

                ->addIndexColumn()

                ->editColumn('created_at', function ($row) {

                    return $row->created_at->format('d M Y');
                })

                ->addColumn('actions', function ($row) {

                    return '

                    <a href="' . route('admin.contact-enquiry.show', $row) . '"
                        class="btn btn-sm"
                        title="View">

                        <i class="fa fa-eye"></i>

                    </a>

                    <a href="#delete-contact-modal"
                        class="btn btn-sm contact-delete"
                        data-toggle="modal"
                        data-href="' . route('admin.contact-enquiry.destroy', $row) . '"
                        title="Delete">

                        <i class="fa fa-trash"></i>

                    </a>

                    ';
                })

                ->rawColumns(['actions'])

                ->make(true);
        }

        return view('admin.contact-enquiry.index');
    }

    public function show(ContactEnquiry $contactEnquiry)
    {
        return view(
            'admin.contact-enquiry.show',
            compact('contactEnquiry')
        );
    }


    public function destroy(ContactEnquiry $contactEnquiry)
    {
        $contactEnquiry->delete();

        return response()->json([

            'status' => 'success',

            'message' => 'Message deleted successfully.'

        ]);
    }
}