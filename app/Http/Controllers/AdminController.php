<?php

namespace App\Http\Controllers;

use App\Category;
use App\User;
use App\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function categories()
    {
        $category = new Category();
        $result = $category->getAll();;
        return view('admin.categories')->with('categories', $result);
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
