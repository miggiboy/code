<?php

namespace App\Models\User;

use Illuminate\Foundation\Auth\User as Authenticatable;

use Zizaco\Entrust\Traits\EntrustUserTrait;

use Laravelrus\LocalizedCarbon\{
    Traits\LocalizedEloquentTrait
};

class User extends Authenticatable
{
    /**
     * Package traits
     */
    use LocalizedEloquentTrait;
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
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'is_active'     => 'boolean',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function toggleActiveStatus()
    {
        $this->is_active = ! $this->is_active;

        return $this;
    }

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
     * Checks if this user has any role
     *
     * @return boolean
     */
    public function isInTeam()
    {
        $teamMembers = explode(
            '|', config('entrust.roles.groups.team')
        );

        return $this->hasRole($teamMembers);
    }

    /**
     * Check if user is not in web-site team
     * @return boolean
     */
    public function isNotInTeam()
    {
        return ! $this->isInTeam();
    }

    public function isNotActive()
    {
        return ! $this->is_active;
    }

    public function hasNoAccess()
    {
        return $this->isNotInTeam() || $this->isNotActive();
    }

    public function scopeTeam($query)
    {
        return $query->has('roles');
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
