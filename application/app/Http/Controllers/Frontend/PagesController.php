<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Banner;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banners = Banner::orderBy('id', 'ASC') ->get();
        return view('frontend.index', compact('banners'));
    }

    /**
     * Display a user login page
     *
     * @return \Illuminate\Http\Response
     */
    public function userLogin()
    {
        return view('frontend.cus_login');
    }
    public function userRegister()
    {
        return view('frontend.cus_reg');
    }
    public function userDashboard()
    {
        return view('frontend.dashboard');
    }
    public function editProfile()
    {
        return view('frontend.editdashboard');
    }
    public function vendorRegister()
    {
        return view('frontend.ven_reg');
    }
    public function vendorDashboard()
    {
        return view('frontend.vendor_dashboard');
    }
    public function editVendorProfile()
    {
        return view('frontend.editvendor_dashboard');
    }

}
