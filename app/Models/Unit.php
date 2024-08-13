<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Unit extends Model
{
    use HasFactory;
//    use Searchable;

    protected $fillable = ['name', 'bname', 'symbol', 'status'];

    protected $searchableFields = ['*'];

    protected static $unit;

    public static function createOrUpdateUnit ($request, $id = null)
    {
        if (isset($id))
        {
            self::$unit = Unit::find($id);
        } else {
            self::$unit = new Unit();
        }
        self::$unit->name                       = $request->name ?? '';
        self::$unit->bname                       = $request->bname ?? '';
        self::$unit->symbol                       = $request->symbol ?? '';
        self::$unit->status                     = $request->status ?? '';
        self::$unit->save();
        return self::$unit;
    }
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
