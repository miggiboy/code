<?php

namespace App\Models\User;

use Zizaco\Entrust\EntrustPermission;

class Permission extends EntrustPermission
{
    /**
     * The model is mass assignable
     *
     * @var array
     */
    protected $guarded = [];
}
