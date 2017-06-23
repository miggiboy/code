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

    public function getNameOrUsernameAttribute()
    {
        return $this->getNameOrUsername();
    }

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
        $insiders = explode('|', config('entrust.roles.insiders'));

        return $this->hasRole($insiders);
    }

    /**
     * Relations
     */

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}
