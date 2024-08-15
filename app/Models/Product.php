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
        'bname',
        'code',
        'category_id',
        'sub_category_id',
        'child_category_id',
        'brand_id',
        'manufacture_id',
        'manufacture_id',
        'unit_id',
        'purmode',
        'country',
        'certificate',
        'min_stock',
        'model',
        'brand_no',
        'cost',
        'price',
        'warranty',
        'barcode',
        'image',
        'status',
        'description',
    ];

    protected $searchableFields = ['*'];


    protected  static $product;

    public static function createOrUpdateUser ($request, $id = null)
    {
//        $lastdata=Product::orderBy('sku','DESC')->first();
        if (isset($id))
        {
            self::$product = Product::find($id);
        } else {
            self::$product = new Product();
        }
        self::$product->name                       = $request->name ?? '';
        self::$product->bname                       = $request->bname ?? '';
        self::$product->code                       = $request->code ?? '';
        self::$product->category_id                       = $request->category_id ?? '';
        self::$product->sub_category_id                 = $request->sub_category_id ?: null;
        self::$product->child_category_id                  = $request->child_category_id ?: null;
        self::$product->brand_id                       = $request->brand_id ?? '';
        self::$product->manufacture_id                       = $request->manufacture_id ?? '';
        self::$product->unit_id                       = $request->unit_id ?? '';
        self::$product->purmode                       = $request->purmode ?? '';
        self::$product->country                       = $request->country ?? '';
        self::$product->certificate                       = $request->certificate ?? '';
        self::$product->min_stock                       = $request->min_stock ?? '';
        self::$product->model                       = $request->model ?? '';
        self::$product->brand_no                       = $request->brand_no ?? '';
        self::$product->cost                       = $request->cost ?? '';
        self::$product->price                       = $request->price ?? '';
        self::$product->warranty                       = $request->warranty ?? '';
        self::$product->barcode                       = $request->barcode ?? '';
        self::$product->description                = $request->description ?? '';
        self::$product->status                     = $request->status ?? '';
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
