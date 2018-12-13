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
}
