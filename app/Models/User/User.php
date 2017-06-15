<?php

namespace App\Models\User;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Authenticatable
{
    /**
     * Laravel traits
     */
    use Notifiable;

    /**
     * Package traits
     */
    use EntrustUserTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'email',
        'first_name',
        'last_name',
        'location',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $appends = ['nameOrUsername'];

    public function getNameOrUsernameAttribute()
    {
        return $this->getNameOrUsername();
    }

    /*
    |--------------------------------------------------------------------------
    | Helpers
    |--------------------------------------------------------------------------
    |
    */

    /**
     * Returns first name attribute of this user
     *
     * @return string | null
     */
    public function getName()
    {
        if ($this->first_name) {
            return $this->first_name;
        }

        return null;
    }

    /**
     * Returns first name (if exists)
     * or username i.e login of the user
     *
     * @return string
     */
    public function getNameOrUsername()
    {
        return $this->getName() ?: $this->username;
    }

    /**
     * Checks if the user owns related model
     *
     * @param  Model $related
     * @return boolean
     */
    public function owns($related)
    {
        return $this->id === $related->user_id;
    }

    /**
     * Checks if this user has any role
     *
     * @return boolean
     */
    public function isAuthorised()
    {
        return $this->hasRole(['developer', 'moderator', 'admin']);
    }

    /**
     * Persists news item to the DB on behalf of the user
     *
     * @param  News   $news
     * @return  News   $news
     */
    public function publish(News $news)
    {
        $this->news()->save($news);
    }

    /*
    |--------------------------------------------------------------------------
    | Relations with other tables
    |--------------------------------------------------------------------------
    |
    */

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function news()
    {
        return $this->hasMany(News::class);
    }
}
