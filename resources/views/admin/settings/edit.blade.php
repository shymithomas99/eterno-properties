@extends('admin.layouts.app')
@section('title', 'Settings')
@section('content')
    <div class="container-fluid">
        {{-- Page Header --}}
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800"> Settings </h1>
        </div>
        {{-- Success Message --}}
        @if (session('success'))
            <div class="alert alert-success"> {{ session('success') }} </div>
        @endif
        {{-- Validation Errors --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('admin.settings.update') }}" method="POST">
            @csrf
            @method('PUT')
            {{-- Contact Information --}}
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"> Contact Information </h6>
                </div>
                <div class="card-body">
                    {{-- Phone Numbers --}}
                    <div class="row">
                        {{-- Phone 1 --}}
                        <div class="form-group col-md-4"> <label> <strong>Phone Number 1</strong>
                            </label> <input type="text" name="phone_1" class="form-control"
                                value="{{ old('phone_1', $settings->phone_1) }}" placeholder=""> </div>

                        {{-- Phone 2 --}}
                        <div class="form-group col-md-4"> <label> <strong>Phone Number 2</strong>
                            </label> <input type="text" name="phone_2" class="form-control"
                                value="{{ old('phone_2', $settings->phone_2) }}" placeholder="Enter your phone number">
                        </div>

                        {{-- Phone 3 --}}
                        <div class="form-group col-md-4"> <label> <strong>Phone Number 3</strong>
                            </label> <input type="text" name="phone_3" class="form-control"
                                value="{{ old('phone_3', $settings->phone_3) }}" placeholder="Enter your phone number">
                        </div>
                    </div>
                    {{-- Email Addresses --}}
                    <div class="row">
                        {{-- Email 1 --}}
                        <div class="form-group col-md-6">
                            <label> <strong>Email 1</strong>
                            </label>
                            <input type="email" name="email_1" class="form-control"
                                value="{{ old('email_1', $settings->email_1) }}" placeholder="Enter your email id">
                        </div>
                        {{-- Email 2 --}}
                        <div class="form-group col-md-6">
                            <label> <strong>Email 2</strong> </label>
                            <input type="email" name="email_2" class="form-control"
                                value="{{ old('email_2', $settings->email_2) }}" placeholder="Enter your email id">
                        </div>
                    </div>
                    {{-- Address --}}
                    <div class="row">
                        <div class="form-group col-md-12"> <label> <strong>Address</strong> </label>
                            <textarea name="address_1" class="form-control" rows="4" placeholder="Enter your company address">{{ old('address_1', $settings->address_1) }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Social Media --}} <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"> Social Media </h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        {{-- X / Twitter --}}
                        <div class="form-group col-md-6"> <label> <strong>X /
                                    Twitter URL</strong> </label> <input type="text" name="twitter_url"
                                class="form-control" value="{{ old('twitter_url', $settings->twitter_url) }}"
                                placeholder="https://x.com/yourusername"> </div>
                        {{-- YouTube --}}
                        <div class="form-group col-md-6"> <label> <strong>YouTube URL</strong> </label> <input
                                type="text" name="youtube_url" class="form-control"
                                value="{{ old('youtube_url', $settings->youtube_url) }}"
                                placeholder="https://youtube.com/@yourchannel"> </div>
                        {{-- Instagram --}}
                        <div class="form-group col-md-6"> <label> <strong>Instagram URL</strong> </label> <input
                                type="text" name="instagram_url" class="form-control"
                                value="{{ old('instagram_url', $settings->instagram_url) }}"
                                placeholder="https://instagram.com/yourusername"> </div>
                        {{-- Facebook --}}
                        <div class="form-group col-md-6"> <label> <strong>Facebook URL</strong> </label> <input
                                type="text" name="facebook_url" class="form-control"
                                value="{{ old('facebook_url', $settings->facebook_url) }}"
                                placeholder="https://facebook.com/yourpage"> </div>
                    </div>
                </div>
            </div>
            {{-- Submit --}}
            <div class="mb-4"> <button type="submit" class="btn btn-primary"> <i class="fas fa-save"></i> Save
                    Settings </button> </div>
        </form>
    </div>
@endsection
