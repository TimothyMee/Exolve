<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Rating;
use App\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function addView($id)
    {
        $video = new Video();
        $result = $video->increaseViewCount($id);
        return apiSuccess($result, 'View Count Updated Successfully', 200);
    }

    public function getAllVideos()
    {
        try{
            $video = new Video();
            $result  = $video->getAll();
            return apiSuccess($result, 'fetched Results Successfully', 200);
        }
        catch (\Exception $e){
            return apiFailure($e);
        }
    }

    public function OpenVideoDetails($id)
    {
        return view('detail')->with('id', $id);
    }

    public function getVideoDetails($id)
    {
        $video = new Video();
        $video = $video->getVideo($id);
        return apiSuccess($video);
    }

    public function getPending()
    {
        $video = new Video();
        $result  = $video->getUnapproved();
        return apiSuccess($result, 'fetched Results Successfully', 200);
    }

    public function adminGetVideo($id)
    {
        $video = new Video();
        $result = $video->getVideo($id);
//        $result[0]['tags'] = json_decode($result[0]['tags']);
        return view('admin.details')->with('video', $result);
    }

    public function comment(Request $request, Video $video, Comment $comment)
    {
        try
        {
            $request = $request->all();
            $result = $video->increaseCommentCount($request['id']);
            $result  = $comment->addNew($request);
            return apiSuccess($result);
        }
        catch(\Exception $e)
        {
            return apiFailure($e);
        }
    }

    public function rateVideo(Request $request, Rating $rating)
    {
        try
        {
            $request = $request->all();
            $result  = $rating->addNew($request);
            return apiSuccess($result);
        }
        catch(\Exception $e)
        {
            return apiFailure($e);
        }
    }

    public function search($param)
    {
        $video = new Video();
        $result = $video->search($param);

        return apiSuccess($result);
    }
}
