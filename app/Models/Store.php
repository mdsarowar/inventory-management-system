<?php

namespace App\Models;

use App\Helper\FileUpload;
use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Store extends Model
{
    use HasFactory;
//    use Searchable;
    protected static $store;
    protected $fillable = [
        'name',
        'address',
        'store_code',
        'mobile',
        'incharge',
        'status',
        'slug',
        'company_id',
    ];

    public static function createOrUpdateUser ($request, $id = null)
    {
        $lastdata=Store::orderBy('store_code','DESC')->first();
        if (isset($id))
        {
            self::$store = Store::find($id);
        } else {
            self::$store = new Store();
        }
        self::$store->name                       = $request->name ?? '';
        self::$store->address                    = $request->address ?? '';
        self::$store->incharge                   = $request->incharge ?? '';
        self::$store->store_code                 = isset($id)? self::$store->store_code : (isset($lastdata)? $lastdata->store_code+1 : 1) ;
        self::$store->mobile                     = $request->mobile ?? '';
        self::$store->company_id                 = $request->company_id ?? '';
        self::$store->status                     = $request->status ?? '';
        self::$store->save();
        return self::$store;
    }
    protected $searchableFields = ['*'];

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
    public function user()
    {
//        return $this->belongsTo(User::class);
        return $this->belongsTo(User::class,'incharge','id');
    }
    public function storeType()
    {
        return $this->belongsTo(StoreType::class);
    }
}
