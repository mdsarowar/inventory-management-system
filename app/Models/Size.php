<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Size extends Model
{
    use HasFactory;
//    use Searchable;

    protected $fillable = ['name', 'bname', 'symbol', 'status'];

    protected $searchableFields = ['*'];

    protected static $size;

    public static function createOrUpdateSize ($request, $id = null)
    {
        if (isset($id))
        {
            self::$size = Size::find($id);
        } else {
            self::$size = new Size();
        }
        self::$size->name                       = $request->name ?? '';
        self::$size->bname                       = $request->bname ?? '';
        self::$size->symbol                       = $request->symbol ?? '';
        self::$size->status                     = $request->status ?? '';
        self::$size->save();
        return self::$size;
    }
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
