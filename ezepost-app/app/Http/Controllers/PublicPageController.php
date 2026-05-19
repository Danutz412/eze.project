<?php
namespace App\Http\Controllers;

use App\Models\Plan;

class PublicPageController extends Controller
{
    public function home() { return view('public.home'); }
    public function download() { return view('public.download'); }
    public function about() { return view('public.about'); }
    public function contact() { return view('public.contact'); }

    public function pricing()
    {
        $plans = Plan::where('is_active', true)->orderBy('id')->get();
        return view('public.pricing', compact('plans'));
    }
}
