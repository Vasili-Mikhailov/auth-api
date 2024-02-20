<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSession extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'users_sessions';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'user_id';

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
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'access_token',
    ];

    /**
     * Get the user to whom the session belongs.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Update or create session
     *
     * @param  array  $userInfo
     * @return UserSession
     */
    public static function createOrUpdateUserSession($userInfo)
    {
        $session = UserSession::where('user_id', $userInfo['id'])->first();
        if($session){
            $session->access_token = $userInfo['access_token'];
            $session->save();
        } else {
            $session = new UserSession;
            $session->user_id = $userInfo['id'];
            $session->access_token = $userInfo['access_token'];
            $session->save();
        }
        return $session;
    }
}
