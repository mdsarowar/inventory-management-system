<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Color extends Model
{
    use HasFactory;
//    use Searchable;

    protected $fillable = ['name', 'bname', 'symbol', 'status'];

    protected $searchableFields = ['*'];

    protected static $color;

    public static function createOrUpdateColor ($request, $id = null)
    {
        if (isset($id))
        {
            self::$color = Color::find($id);
        } else {
            self::$color = new Color();
        }
        self::$color->name                       = $request->name ?? '';
        self::$color->bname                       = $request->bname ?? '';
        self::$color->symbol                       = $request->symbol ?? '';
        self::$color->status                     = $request->status ?? '';
        self::$color->save();
        return self::$color;
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
