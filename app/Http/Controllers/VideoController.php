<?php

namespace App\Http\Controllers;

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

    public function getVideo($id)
    {
        $video = new Video();
        $result = $video->getVideo($id);
        return $result;
    }

    public function getPending()
    {
        $video = new Video();
        $result  = $video->getUnapproved();
        return apiSuccess($result, 'fetched Results Successfully', 200);
    }
}
