<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $fillable = ['user_id', 'title', 'category_id', 'description', 'status', 'admin_id',
                            'video', 'tags', 'views', 'comments', 'isLive'];

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function comment()
    {
        return $this->hasMany('App\Comment');
    }

    public function createNew($data)
    {
        $data['user_id'] = auth()->id();
        $data['status'] = "pending";
        return $this->create($data);
    }

    public function getAll()
    {
        return $this->with('user', 'category')->get();
    }

    public function getVideo($id)
    {
        return $this->where('id', $id)
                    ->with('category','user')
                    ->get();
    }

    public function getVideos()
    {
        return $this->where('user_id', auth()->id())
                    ->with('user', 'category')
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

    public function increaseCommentCount($id)
    {
        return $this->where('id', $id)
            ->increment('comments');
    }

    public function getUnapproved()
    {
        return $this->where('status', "pending")
                    ->with('user', 'category')
                    ->get();
    }

    public function Approve($id)
    {
        return $this->where('id', $id)
                    ->update(['status' => 'approved', 'isLive' => 1]);
    }

    public function Remove($id)
    {
        return $this->where('id', $id)
            ->update(['status' => 'pending', 'isLive' => 0]);
    }

    public function search($param)
    {
        return $this->where('title', 'like', "%{$param}%")
            ->orWhere('tags', 'like', "%{$param}%")
            ->get();
    }
}
