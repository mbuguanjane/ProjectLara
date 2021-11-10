<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Internship;

class PageController extends Controller
{
    public function index()
    {
        $internship=Internship::all();
        return view('pages.index')->with('internship',$internship);
       
    } 
    public function about()
    {
        return view('pages.about');
    }
    public function contact()
    {
        return view('pages.contact');
    }
}
