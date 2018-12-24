<?php

namespace App\Http\Controllers;

use App\Category;
use App\Mail\approvedMail;
use App\User;
use App\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function getStatistics()
    {
        $video = new Video();
        $TotalNumberOfVideos = $video->getAll();
        $UnapprovedVideos = $video->getUnapproved();

        $user = new User();
        $totalUsers = $user->getUsers();

        $TotalNumberOfVideos = $TotalNumberOfVideos->count();
        $UnapprovedVideos = $UnapprovedVideos->count();
        $totalUsers = $totalUsers->count();

        $result = ['totalVideos' => $TotalNumberOfVideos, 'newVideos' => $UnapprovedVideos, 'totalUsers' => $totalUsers];

        return apiSuccess($result);
    }

    public function getUsers()
    {
        $user = new User();
        $totalUsers = $user->getUsers();
        return apiSuccess($totalUsers);
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

        $videoDetails = $video->getVideo($id);
        $title = $videoDetails[0]->title;

        Mail::to($videoDetails[0]->user->email)->send(new approvedMail($title));

        return redirect()->back()->with('success', 'Successfully Approved the video');
    }

    public function remove($id)
    {
        $video = new Video();
        $result = $video->Remove($id);
        return redirect()->back()->with('success', 'Successfully Removed the video');
    }

}
