<?php

namespace App\Http\Controllers;

use App\Category;
use App\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        $category = new Category();
        $result = $category->getAll();;
        return view('admin.index')->with('categories', $result);
    }

    public function video()
    {
        $video = new Video();
        $result = $video->getUnapproved();;
        return view('admin.video')->with('videos', $result);
    }

    public function approve($id)
    {
        $video = new Video();
        $result = $video->Approve($id);
        return redirect()->back()->with('success', 'Successfully Approved the video');
    }

}
