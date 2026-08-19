@extends('admin.layouts.app')

@section('title', 'Booking Enquiry')

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Booking Enquiry Details</h1>
            <a href="{{ route('admin.booking-enquiry.index') }}" class="btn btn-secondary btn-sm">
                <i class="fa fa-arrow-left"></i> Back
            </a>
        </div>

        <div class="card shadow">
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th width="20%">Name</th>
                        <td>{{ $bookingEnquiry->name }}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{ $bookingEnquiry->email }}</td>
                    </tr>
                    <tr>
                        <th>Phone</th>
                        <td>{{ $bookingEnquiry->phone }}</td>
                    </tr>
                    <tr>
                        <th>Preferred Room</th>
                        <td>{{ $bookingEnquiry->resort }}</td>
                    </tr>
                    <tr>
                        <th>Submitted On</th>
                        <td>{{ $bookingEnquiry->created_at->format('d M Y h:i A') }}</td>
                    </tr>
                    <tr>
                        <th>Message</th>
                        <td>{!! nl2br(e($bookingEnquiry->message)) !!}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
@endsection
