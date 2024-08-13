<?php

namespace App\Models;

use App\Helper\FileUpload;
use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
//    use Searchable;

    protected $fillable = [
        'name',
        'sku',
        'price',
        'quantity',
        'created_by',
        'image',
        'min_quantity',
        'tex',
        'discount_type',
        'discount',
        'description',
        'brand_id',
        'category_id',
        'size_id',
        'sub_category_id',
        'color_id',
        'child_category_id',
        'unit_id',
        'manufacture_id',
        'status',
        'is_serial',
    ];

    protected $searchableFields = ['*'];


    protected  static $product;

    public static function createOrUpdateUser ($request, $id = null)
    {
        $lastdata=Product::orderBy('sku','DESC')->first();
        if (isset($id))
        {
            self::$product = Product::find($id);
        } else {
            self::$product = new Product();
        }
        self::$product->name                       = $request->name ?? '';
        self::$product->created_by                       = $request->created_by ?? '';
        self::$product->sku                       = isset($id)? self::$product->sku : (isset($lastdata)? $lastdata->sku+1 : 1) ;
        self::$product->price                     = $request->price ?? '';
        self::$product->quantity                  = $request->quantity ?? '';
        self::$product->manufacture_id            = $request->manufacture_id ?? '';
        self::$product->unit_id                   = $request->unit_id ?? '';
        self::$product->child_category_id         = $request->child_category_id ?? '';
        self::$product->color_id                  = $request->color_id ?? '';
        self::$product->sub_category_id           = $request->sub_category_id ?? '';
        self::$product->size_id                   = $request->size_id ?? '';
        self::$product->category_id               = $request->category_id ?? '';
        self::$product->brand_id                   = $request->brand_id ?? '';
        self::$product->discount                = $request->discount ?? '';
        self::$product->discount_type                = $request->discount_type ?? '';
        self::$product->tex                         = $request->tex ?? '';
        self::$product->min_quantity                = $request->min_quantity ?? '';
        self::$product->description                = $request->description ?? '';
        self::$product->status                     = $request->status ?? '';
        self::$product->is_serial                    = $request->is_serial ?? '';
        self::$product->image                      = FileUpload::imageUpload($request->file('image'), 'admin/uploaded-files/product/products/', 'pro', '300', '200', isset($id)? self::$product->image:'') ;
        self::$product->save();
        return self::$product;
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class);
    }

    public function childCategory()
    {
        return $this->belongsTo(ChildCategory::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function size()
    {
        return $this->belongsTo(Size::class);
    }

    public function color()
    {
        return $this->belongsTo(Color::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function manufacture()
    {
        return $this->belongsTo(Manufacture::class);
    }
    public function productSerials()
    {
        return $this->hasMany(ProductSerial::class);
    }
}
