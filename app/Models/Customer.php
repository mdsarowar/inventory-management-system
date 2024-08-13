<?php

namespace App\Models;

use App\Helper\FileUpload;
use App\Http\Controllers\Admin\People\CustomerController;
use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Model
{
    use HasFactory;
//    use Searchable;

    protected $fillable = [
        'name',
        'email',
        'mobile',
        'nid',
        'cperson',
        'cmobile',
        'creditlimit',
        'balance',
        'rank',
        'address',
        'note',
        'image',
        'status',
        'company_id',
        'branch_id',
        'cus_code',
    ];

    protected $searchableFields = ['*'];

    protected  static $customer;

    public static function createOrUpdateUser ($request, $id = null)
    {
        $lastdata=Product::orderBy('sku','DESC')->first();
        if (isset($id))
        {
            self::$customer = Customer::find($id);
        } else {
            self::$customer = new Customer();
        }
        self::$customer->name                       = $request->name ?? '';
        self::$customer->cus_code                   = $request->cus_code ?? '';
        self::$customer->email                      = $request->email ?? '';
        self::$customer->mobile                     = $request->mobile ?? '';
        self::$customer->nid                        = $request->nid ?? '';
        self::$customer->cperson                    = $request->cperson ?? '';
        self::$customer->cmobile                    = $request->cmobile ?? '';
        self::$customer->creditlimit                = $request->creditlimit ?? '';
        self::$customer->balance                    = $request->balance ?? '';
        self::$customer->rank                       = $request->rank ?? '';
        self::$customer->address                    = $request->address ?? '';
        self::$customer->note                       = $request->note ?? '';
//        self::$customer->branch_id                  = $request->branch_id ?? '';
//        self::$customer->company_id                 = $request->company_id ?? '';
        self::$customer->status                     = $request->status ?? '';
        self::$customer->image                      = FileUpload::imageUpload($request->file('image'), 'admin/uploaded-files/people/customers/', 'cus', '300', '200', isset($id)? self::$customer->image:'') ;
        self::$customer->save();
        return self::$customer;
    }
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
}
