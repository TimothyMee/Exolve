<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'email', 'phone', 'password', 'image', 'role',  'isLive', 'deleted_by', 'deleted_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     *  Create new user
     * @param user
     * @return user Object
     */
    public function createNew($user)
    {
        $user['role'] = "user";
        $user['password'] = bcrypt($user['password']);
        return $this->create($user);
    }

    public function edit($data)
    {
        return $this->where('id', auth()->id())
                    ->update(['email' => $data['email'],
                                'username' => $data['username'],
                                'phone' => $data['phone'],
                                'image' => $data['image']]);
    }

    public function getUsers()
    {
        return $this->where('role', 'user')->get();
    }

    public function getAll()
    {
        return $this->all();
    }
}
