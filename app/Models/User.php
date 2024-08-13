<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;
use App\Helper\FileUpload;

class User extends Authenticatable
{
    use HasRoles;
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'image',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static $user;

    public static function createOrUpdateUser ($request, $id = null)
    {
        if (isset($id))
        {
            self::$user = User::find($id);
        } else {
            self::$user = new User();
        }
        self::$user->name                       = $request->name ?? '';
        self::$user->email                      = $request->email ?? '';
        self::$user->image                      = FileUpload::imageUpload($request->file('image'), 'admin/uploaded-files/users/', 'user', '300', '200', isset($id)? self::$user->image:'') ;
        self::$user->password                   =  Hash::make($request->password);
        self::$user->save();
        return self::$user;
    }

    public function getRoleNames()
    {
        return $this->belongsToMany(Role::class);
    }
    public function companies()
    {
        return $this->belongsToMany(Company::class);
    }

    // public function isSuperAdmin(): bool
    // {
    //     return $this->hasRole('super-admin');
    // }
}
