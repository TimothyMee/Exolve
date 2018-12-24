<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['video_id', 'user_id', 'comment'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function addNew($data)
    {
        $data['video_id'] = $data['id'];
        $data['user_id'] = auth()->id();
        return $this->create($data);
    }

    public function getComments($id)
    {
        return $this->where('video_id' , $id)
                    ->with('user')
                    ->orderBy('created_at', 'desc')
                    ->get();
    }
}
