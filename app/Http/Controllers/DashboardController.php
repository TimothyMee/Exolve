<?php

namespace App\Http\Controllers;

use App\Category;
use App\Video;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function index()
    {
        $video = new Video();
        $data['viewCount'] = $video->getViewCount();
        $data['videoCount'] = $video->getVideos()->count();

        return view('dashboard.index') ->with('data', $data);
    }

    public function add()
    {
        $category = new Category();
        $result = $category->getAll();
        return view('dashboard.add')->with('categories', $result);
    }

    public function addVideo(Request $request, Video $video)
    {
        try
        {
            /**Processing video*/
            $fileName = Carbon::now()->timestamp . '-' . $request['title'].'-' .auth()->user()->name;
            $filepath = storage_path('app/public/videos');

            $file = $request->file('video');
            $fileName = $fileName.$file->getClientOriginalName();
            $result = $file->move($filepath,$fileName);


            /** Create video*/
            if ($result){
                $request = $request->all();
                $request['video'] = asset('storage/videos/'. $fileName);
                $createdVideo = $video->createNew($request);
                return redirect()->back()->with('success', $createdVideo['title']);
            }
        }
        catch (\Exception $e)
        {
            return redirect()->back()->with('error', $e);
        }

    }

    public function pending()
    {
        $video = new Video();
        $result = $video->getVideos();
        return view('dashboard.pending')->with('videos', $result);
    }

    public function promote()
    {
        try
        {
            $video = new Video();
            $result = $video->getNotLiveVideos();
            return view('dashboard.promote')->with('videos', $result);
        }
        catch(\Exception $e)
        {
            return redirect()->back()->with('error', $e);
        }
    }

    public function goLive($id)
    {
       try
       {
           $video = new Video();
           $result = $video->goLive($id);

           if ($result){
               $videoDetails = $video->getVideo($id);
               return redirect()->back()->with('success', $videoDetails[0]['title']);
           }
           return redirect()->back()->with('error', $id);
       }
       catch (\Exception $e)
       {
           return redirect()->back()->with('error', $e);
       }
    }
}
