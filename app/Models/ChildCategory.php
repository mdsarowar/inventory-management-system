<?php

namespace App\Models;

use App\Helper\FileUpload;
use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ChildCategory extends Model
{
    use HasFactory;
//    use Searchable;

    protected $fillable = [
        'name',
        'sub_cat_id',
        'child_code',
        'created_by',
        'description',
        'cat_id',
        'status',
        'image',
        'slug',
    ];

    protected $searchableFields = ['*'];

    protected $table = 'child_categories';

    protected  static $child_category;

    public static function createOrUpdateUser ($request, $id = null)
    {
        $lastdata=ChildCategory::orderBy('child_code','DESC')->first();
        if (isset($id))
        {
            self::$child_category = ChildCategory::find($id);
        } else {
            self::$child_category = new ChildCategory();
        }
        self::$child_category->name                       = $request->name ?? '';
        self::$child_category->created_by                       = $request->created_by ?? '';
        self::$child_category->cat_id                = $request->cat_id ?? '';
        self::$child_category->sub_cat_id                = $request->sub_cat_id ?? '';
        self::$child_category->child_code               = isset($id)? self::$child_category->child_code : (isset($lastdata)? $lastdata->child_code+1 : 1) ;
        self::$child_category->description                = $request->description ?? '';
        self::$child_category->status                     = $request->status ?? '';
        self::$child_category->image                      = FileUpload::imageUpload($request->file('image'), 'admin/uploaded-files/product/child_category/', 'child', '300', '200', isset($id)? self::$child_category->image:'') ;
        self::$child_category->save();
        return self::$child_category;
    }
    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class,'sub_cat_id','id');
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
