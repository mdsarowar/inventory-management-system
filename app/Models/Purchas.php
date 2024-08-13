<?php

namespace App\Models;

use App\Helper\FileUpload;
use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Purchas extends Model
{
    use HasFactory;
//    use Searchable;

    protected $fillable = [
        'inv_id',
        'vendor_type',
        'vendor',
        'dis_type',
        'discount',
        'vat_type',
        'vat',
        'tax_type',
        'tax',
        'speed_money',
        'others_name',
        'other_amount',
        'issue_date',
        'freight',
        'less',
        'add_money',
        'cur_id',
        'ref',
        'note',
        'date',
        'due_date',
        'due',
        'sub_total',
        'total',
        'status',
        'company_id',
        'branch_id',
    ];

    protected $searchableFields = ['*'];
    protected  static $purchas;

    public static function createOrUpdateUser ($request,$inv=null, $id = null)
    {
        if (isset($id))
        {
            self::$purchas = Purchas::find($id);
        } else {
            self::$purchas = new Purchas();
        }
        self::$purchas->inv_id                  = $inv ?? '';
        self::$purchas->vendor_type             = $request->vendor_type ?? '';
        if ($request->vendor_type == 'other'){
            self::$purchas->vendor                  = $request->vendor_name ?? '';
        }else{
            self::$purchas->vendor                  = $request->vendor ?? '';
        }
        self::$purchas->dis_type                = $request->dis_type ?? '';
        self::$purchas->discount                = $request->all_discount ?? '';
        self::$purchas->vat_type                = $request->vat_type ?? '';
        self::$purchas->vat                     = $request->all_vat ?? '';
        self::$purchas->tax_type                = $request->tax_type ?? '';
        self::$purchas->tax                     = $request->all_tax ?? '';
        self::$purchas->speed_money             = $request->speed_money ?? '';
        self::$purchas->others_name             = $request->others_name ?? '';
        self::$purchas->other_amount            = $request->other_amount ?? '';
        self::$purchas->issue_date              = $request->issue_date ?? '';
        self::$purchas->freight                 = $request->all_freight ?? '';
        self::$purchas->less                    = $request->less ?? '';
        self::$purchas->add_money               = $request->add_money ?? '';
        self::$purchas->cur_id                  = $request->cur_id ?? '';
        self::$purchas->ref                     = $request->ref ?? '';
        self::$purchas->note                    = $request->note ?? '';
        self::$purchas->date                    = $request->date ?? '';
        self::$purchas->due_date                = $request->due_date ?? '';
        self::$purchas->due                     = $request->due_amount ?? '';
        self::$purchas->sub_total               = $request->all_subtotal ?? '';
        self::$purchas->total                   = $request->total ?? '';
//        self::$purchas->company_id                   = 1;
//        self::$purchas->branch_id                   = 1;
        self::$purchas->status                  = $request->status ?? '';
        self::$purchas->save();
        return self::$purchas;
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

//    public function purchasProducts()
//    {
//        return $this->hasMany(PurchasProduct::class);
//    }
//
//    public function payments()
//    {
//        return $this->hasMany(Payment::class);
//    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
    public function invoice()
    {
        return $this->belongsTo(Invoice::class,'inv_id','id');
    }
    public function Customer()
    {
        return $this->belongsTo(Customer::class,'vendor','id');
    }
//    public function Supplier()
//    {
//        return $this->belongsTo(Supplier::class,'vendor','id');
//    }

    public function productTransections()
    {
        return $this->hasMany(ProductTransection::class);
    }
}
