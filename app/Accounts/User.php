<?php

namespace App\Accounts;

use App\Ccusa\Core\Entity;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

class User extends Entity implements AuthenticatableContract
{
    use Authenticatable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['username', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * 取得使用者身份.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * 確認使用者是否擁有指定身份.
     *
     * @param array|mixed $role
     * @return bool
     */
    public function hasRole($role)
    {
        /* @var $roles \Illuminate\Support\Collection */

        static $roles = null;

        if (is_null($roles)) {
            $roles = $this->load(['roles'])->getRelation('roles')->pluck('name');
        }

        if ($roles->contains('admin')) {
            return true;
        }

        $role = is_array($role) ? $role : func_get_args();

        return collect($role)->diff($roles)->isEmpty();
    }
}
