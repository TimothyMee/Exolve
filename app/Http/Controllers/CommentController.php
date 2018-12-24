<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;

class CommentController extends Controller
{

    public function getComment($id)
    {
        $comment = new Comment();
        $comments = $comment->getComments($id);
        return apiSuccess($comments);

    }
}
