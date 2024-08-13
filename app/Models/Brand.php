<?php

namespace App\Models;

use App\Helper\FileUpload;
use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Brand extends Model
{
    use HasFactory;
//    use Searchable;


    protected $fillable = ['name', 'image', 'description', 'status', 'slug'];

    protected $searchableFields = ['*'];
    protected  static $brand;
    public static function createOrUpdateUser ($request, $id = null)
    {
        if (isset($id))
        {
            self::$brand = Brand::find($id);
        } else {
            self::$brand = new Brand();
        }
        self::$brand->name                       = $request->name ?? '';
        self::$brand->description                = $request->description ?? '';
        self::$brand->status                     = $request->status ?? '';
        self::$brand->image                      = FileUpload::imageUpload($request->file('image'), 'admin/uploaded-files/product/brand/', 'brand', '300', '200', isset($id)? self::$brand->image:'') ;
        self::$brand->save();
        return self::$brand;
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
