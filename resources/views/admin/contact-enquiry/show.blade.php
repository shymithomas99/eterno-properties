@extends('admin.layouts.app')

@section('title', 'Contact Enquiry')

@section('content')

    <div class="container-fluid">

        <div class="d-sm-flex align-items-center justify-content-between mb-4">

            <h1 class="h3 mb-0 text-gray-800">
                Contact Enquiry Details
            </h1>

            <a href="{{ route('admin.contact-enquiry.index') }}" class="btn btn-secondary btn-sm">

                <i class="fa fa-arrow-left"></i>

                Back

            </a>

        </div>

        <div class="card shadow">

            <div class="card-body">

                <table class="table table-bordered">

                    <tr>

                        <th width="20%">Name</th>

                        <td>{{ $contactEnquiry->name }}</td>

                    </tr>

                    <tr>

                        <th>Email</th>

                        <td>{{ $contactEnquiry->email }}</td>

                    </tr>

                    <tr>

                        <th>Phone</th>

                        <td>{{ $contactEnquiry->phone }}</td>

                    </tr>

                    <tr>

                        <th>Interested Resort</th>

                        <td>{{ $contactEnquiry->resort }}</td>

                    </tr>

                    <tr>

                        <th>Submitted On</th>

                        <td>{{ $contactEnquiry->created_at->format('d M Y h:i A') }}</td>

                    </tr>

                    <tr>

                        <th>Message</th>

                        <td>

                            {!! nl2br(e($contactEnquiry->message)) !!}

                        </td>

                    </tr>

                </table>

            </div>

        </div>

    </div>

@endsection
