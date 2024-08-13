<?php

namespace App\Models;

use App\Helper\FileUpload;
use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SubCategory extends Model
{
    use HasFactory;
//    use Searchable;

    protected $fillable = [
        'category_id',
        'name',
        'sub_cat_code',
        'description',
        'created_by',
        'image',
        'status',
        'slug',
    ];

    protected $searchableFields = ['*'];

    protected $table = 'sub_categories';


    protected  static $sub_category;

    public static function createOrUpdateUser ($request, $id = null)
    {
        $lastdata=SubCategory::orderBy('sub_cat_code','DESC')->first();
        if (isset($id))
        {
            self::$sub_category = SubCategory::find($id);
        } else {
            self::$sub_category = new SubCategory();
        }
        self::$sub_category->name                       = $request->name ?? '';
        self::$sub_category->created_by                 = $request->created_by ?? '';
        self::$sub_category->category_id                = $request->category_id ?? '';
        self::$sub_category->sub_cat_code               = isset($id)? self::$sub_category->sub_cat_code : (isset($lastdata)? $lastdata->sub_cat_code+1 : 1) ;
        self::$sub_category->description                = $request->description ?? '';
        self::$sub_category->status                     = $request->status ?? '';
        self::$sub_category->image                      = FileUpload::imageUpload($request->file('image'), 'admin/uploaded-files/product/sub_category/', 'sub_cat', '300', '200', isset($id)? self::$sub_category->image:'') ;
        self::$sub_category->save();
        return self::$sub_category;
    }


    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function childCategories()
    {
        return $this->hasMany(ChildCategory::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
