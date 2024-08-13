<?php

namespace App\Models;

use App\Helper\FileUpload;
use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;
//    use Searchable;

    protected $fillable = [
        'name',
        'category_Code',
        'description',
        'image',
        'created_by',
        'status',
        'slug',
    ];

    protected $searchableFields = ['*'];

    protected  static $category;

    public static function createOrUpdateUser ($request, $id = null)
    {
        $lastdata=Category::orderBy('category_Code','DESC')->first();
        if (isset($id))
        {
            self::$category = Category::find($id);
        } else {
            self::$category = new Category();
        }
        self::$category->name                       = $request->name ?? '';
        self::$category->created_by                       = $request->created_by ?? '';
        self::$category->category_Code                = isset($id)? self::$category->category_Code : (isset($lastdata)? $lastdata->category_Code+1 : 1) ;
        self::$category->description                = $request->description ?? '';
        self::$category->status                     = $request->status ?? '';
        self::$category->image                      = FileUpload::imageUpload($request->file('image'), 'admin/uploaded-files/product/category/', 'category', '300', '200', isset($id)? self::$category->image:'') ;
        self::$category->save();
        return self::$category;
    }

    public function subCategories()
    {
        return $this->hasMany(SubCategory::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
