<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Permission extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'permission_category_id',
        'title',
        'description',
        'slug',
        'is_default',
        'status',
    ];

    protected $searchableFields = ['*'];

    public function permissionCategory()
    {
        return $this->belongsTo(PermissionCategory::class);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
}
