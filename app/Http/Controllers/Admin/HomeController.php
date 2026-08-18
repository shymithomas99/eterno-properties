<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactEnquiry;
use App\Models\Experience;
use App\Models\Gallery;
use App\Models\Newsletter;
use App\Models\Offer;
use App\Models\Resort;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $resortCount = Resort::count();
        $offerCount = Offer::where('type', 2)->count();
        $experienceCount = Experience::where('type', 2)->count();
        $galleryCount = Gallery::where('type', 2)->count();
        $contactEnqCount = ContactEnquiry::count();
        $newsletterSubCount = Newsletter::count();

        return view('admin.home', compact('resortCount', 'offerCount', 'experienceCount', 'galleryCount', 'contactEnqCount', 'newsletterSubCount'));
    }
}
