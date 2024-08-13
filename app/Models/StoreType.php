<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StoreType extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['name', 'description', 'status', 'slug'];

    protected $searchableFields = ['*'];

    protected $table = 'store_types';

    public function stores()
    {
        return $this->hasMany(Store::class);
    }
}
