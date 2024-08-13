<?php

namespace App\Models;

use App\Helper\FileUpload;
use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductSerial extends Model
{
    use HasFactory;
//    use Searchable;

    protected $fillable = [
        'product_id',
        'serial_number',
        'emei_number',
        'is_sold',
        'status',
    ];

    protected $searchableFields = ['*'];

    protected $table = 'product_serials';

    protected  static $product_serial;

    public static function createOrUpdateUser ($request, $id = null)
    {
        if (isset($id))
        {
            self::$product_serial = ProductSerial::find($id);
        } else {
            self::$product_serial = new ProductSerial();
        }
        self::$product_serial->product_id                   = $request->product_id ?? '';
        self::$product_serial->serial_number                = $request->serial_number ?? '';
        self::$product_serial->emei_number                  = $request->emei_number ?? '';
        self::$product_serial->is_sold                      = $request->is_sold ?? '';
        self::$product_serial->status                       = $request->status ?? '';
        self::$product_serial->save();

        return self::$product_serial;
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
