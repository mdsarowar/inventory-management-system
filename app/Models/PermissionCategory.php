<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PermissionCategory extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['title', 'description', 'slug', 'status'];

    protected $searchableFields = ['*'];

    protected $table = 'permission_categories';

    public function permissions()
    {
        return $this->hasMany(Permission::class);
    }
}
