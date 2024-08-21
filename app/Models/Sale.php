<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{

    use HasFactory;
//    use Searchable;

    protected $fillable = [
        'inv_id',
        'sale_inv',
//        'vendor_type',
        'vendor',
        'wkname',
        'wkphone',
        'wkemail',
        'wkaddress',
        'wkdistrict',
        'fractional_dis',
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
    protected  static $sale;

    public static function createOrUpdateUser ($request,$inv=null, $id = null)
    {
        if (isset($id))
        {
            self::$sale = Sale::find($id);
        } else {
            self::$sale = new Sale();
        }
        self::$sale->inv_id                  = $inv ?? '';
//        self::$sale->vendor_type             = $request->vendor_type ?? '';
//        if ($request->vendor_type == 'other'){
        self::$sale->vendor                  = $request->vendor ?? '';
//        }else{
//            self::$sale->vendor                  = $request->vendor ?? '';
//        }
        self::$sale->sale_inv                ='SAL-' .date('YmdHis');
        self::$sale->dis_type                = $request->dis_type ?? '';
        self::$sale->wkname                = $request->wkname ?? '';
        self::$sale->wkphone                = $request->wkphone ?? '';
        self::$sale->wkemail                = $request->wkemail ?? '';
        self::$sale->wkaddress                = $request->wkaddress ?? '';
        self::$sale->wkdistrict                = $request->wkdistrict ?? '';
        self::$sale->discount                = $request->all_discount ?? '';
        self::$sale->vat_type                = $request->vat_type ?? '';
        self::$sale->vat                     = $request->all_vat ?? '';
        self::$sale->tax_type                = $request->tax_type ?? '';
        self::$sale->tax                     = $request->all_tax ?? '';
        self::$sale->speed_money             = $request->speed_money ?? '';
        self::$sale->others_name             = $request->others_name ?? '';
        self::$sale->other_amount            = $request->other_amount ?? '';
        self::$sale->issue_date              = $request->issue_date ?? '';
        self::$sale->freight                 = $request->all_freight ?? '';
        self::$sale->fractional_dis                 = $request->fractional_dis ?? '';
        self::$sale->less                    = $request->less ?? '';
        self::$sale->add_money               = $request->add_money ?? '';
        self::$sale->cur_id                  = $request->cur_id ?? '';
        self::$sale->ref                     = $request->ref ?? '';
        self::$sale->note                    = $request->note ?? '';
        self::$sale->date                    = $request->date ?? '';
        self::$sale->due_date                = $request->due_date ?? '';
        self::$sale->due                     = $request->due_amount ?? '';
        self::$sale->sub_total               = $request->all_subtotal ?? '';
        self::$sale->total                   = $request->total ?? '';
//        self::$sale->company_id                   = 1;
//        self::$sale->branch_id                   = 1;
        self::$sale->status                  = $request->status ?? '';
        self::$sale->save();
        return self::$sale;
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
