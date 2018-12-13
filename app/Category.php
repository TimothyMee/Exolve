<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'created_by', 'is_active'];

    public function createNew($data)
    {
        $data['created_by'] = auth()->id();
        return $this->create($data);
    }

    public function getAll()
    {
        return $this->all();
    }

    public function getAllWithVideos()
    {
        return $this->where('is_active', 1)
                    ->with('video')
                    ->get();
    }

    public function video()
    {
        return $this->hasMany('App\Video')->where('isLive', 1);
    }
}
