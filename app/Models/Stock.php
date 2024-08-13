<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Stock extends Model
{
    use HasFactory;
//    use Searchable;

    protected $fillable = [
        'product_id',
        'sotck_qty',
        'pur_id',
        'sell_qty',
        'purches_ret',
        'sell_ret',
        'transfer',
        'available',
        'unit_id',
        'size_id',
        'color_id',
        'status',
        'company_id',
        'branch_id',
        'store_id',
    ];

    protected $searchableFields = ['*'];

    protected  static $stock;

    public static function createOrUpdateUser ($request, $id = null)
    {
//        return $request['product_id'];
        if (isset($id))
        {
            self::$stock = Stock::find($id);
        } else {
            $exiest=Stock::where('product_id',$request['product_id'])->first();
            if (empty($exiest)){
                self::$stock = new Stock();
            }else{
                self::$stock = Stock::find($exiest->id);
            }

        }
        self::$stock->product_id                  = $request['product_id'] ;
        self::$stock->sotck_qty                   = floatval(self::$stock->sotck_qty) + floatval($request['qty']);
        self::$stock->pur_id                 = $request['pur_id'] ?? '';
        self::$stock->sell_qty                    = $request->sell_qty ?? '';
        self::$stock->purches_ret                 = $request->purches_ret ?? '';
        self::$stock->sell_ret                    = $request->sell_ret ?? '';
        self::$stock->transfer                    = $request->transfer ?? '';
        self::$stock->available                   = $request->available ?? '';
        self::$stock->unit_id                     = $request['unit_id'] ?? '';
        self::$stock->size_id                     = $request['size_id'] ?? '';
        self::$stock->unit_id                     = $request['color_id'] ?? '';
        self::$stock->status                      = $request->status ?? '';
        self::$stock->save();
        return self::$stock;
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }
}
