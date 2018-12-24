<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $fillable = ['video_id', 'user_id', 'rating'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function addNew($data)
    {
        $results = $this->where('video_id', $data['id'])
                        ->where('user_id', auth()->id())
                        ->get();
        if(count($results) != 0)
        {
            return $this->where('video_id', $data['id'])
                        ->where('user_id', auth()->id())
                        ->update(['rating' => $data['rating']]);
        }
        else
        {
            $data['video_id'] = $data['id'];
            $data['user_id'] = auth()->id();
            return $this->create($data);
        }
    }

    public function getRating($id)
    {
        return $this->where('video_id' , $id)
                    ->where('user_id', auth()->id())
                    ->with('user')
                    ->get();
    }

    public function getVideoRating($id)
    {
        return $this->where('video_id' , $id)
                    ->with('user')
                    ->avg('rating');
    }
}
