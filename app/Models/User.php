<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'city',
        'country',
    ];

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Indicates if the model's ID is auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Get the session associated with the user.
     */
    public function session()
    {
        return $this->hasOne(UserSession::class);
    }

    /**
     * Update or create user
     *
     * @param  array  $userInfo
     * @return array
     */
    public static function createOrUpdateUser($userInfo)
    {
        $user = User::find($userInfo['id']);
        if($user){
            $user->id = $userInfo['id'];
            $user->first_name = $userInfo['first_name'];
            $user->last_name = $userInfo['last_name'];
            $user->city = $userInfo['city'];
            $user->country = $userInfo['country'];
            $user->save();
        } else {
            $user = new User;
            $user->id = $userInfo['id'];
            $user->first_name = $userInfo['first_name'];
            $user->last_name = $userInfo['last_name'];
            $user->city = $userInfo['city'];
            $user->country = $userInfo['country'];
            $user->save();
        }
        return $user->toArray();
    }
}
