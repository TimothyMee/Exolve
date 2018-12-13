<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $fillable = ['user_id', 'title', 'category_id', 'description', 'status', 'admin_id',
                            'video', 'likes', 'views', 'comments', 'isLive'];

    public function createNew($data)
    {
        $data['user_id'] = auth()->id();
        $data['status'] = "pending";
        return $this->create($data);
    }

    public function getVideo($id)
    {
        return $this->where('id', $id)
                    ->get();
    }

    public function getVideos()
    {
        return $this->where('user_id', auth()->id())
                    ->get();
    }

    public function getNotLiveVideos()
    {
        return $this->where('user_id', auth()->id())
                    ->where('isLive', 0)
                    ->where('status', 'approved')
                    ->get();
    }

    public function getViewCount(){
        return $this->where('user_id', auth()->id())
                    ->sum('views');
    }

    public function goLive($id)
    {
        return $this->where('id', $id)
                    ->update(['isLive' => 1]);
    }

    public function increaseViewCount($id)
    {
        return $this->where('id', $id)
                    ->increment('views');
    }

    public function getUnapproved()
    {
        return $this->where('status', "pending")
                    ->get();
    }

    public function Approve($id)
    {
        return $this->where('id', $id)
                    ->update(['status' => 'approved']);
    }
}
