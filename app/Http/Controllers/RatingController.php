<?php

namespace App\Http\Controllers;

use App\Rating;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function getRating($id)
    {
        $comment = new Rating();
        $comments = $comment->getRating($id);
        return apiSuccess($comments);

    }

    public function getVideoRating($id)
    {
        $comment = new Rating();
        $comments = $comment->getVideoRating($id);
        return apiSuccess($comments);

    }
}
