<?php

namespace App\Models;

use App\Helper\FileUpload;
use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Supplier extends Model
{
    use HasFactory;
//    use Searchable;

    protected $fillable = [
        'name',
        'sup_code',
        'mobile',
        'email',
        'nid',
        'cperson',
        'cmobile',
        'creditlimit',
        'balance',
        'rank',
        'image',
        'address',
        'note',
        'status',
        'company_id',
        'branch_id',
    ];

    protected $searchableFields = ['*'];


    protected  static $supplier;

    public static function createOrUpdateUser ($request, $id = null)
    {
//        $lastdata=Product::orderBy('sku','DESC')->first();
        if (isset($id))
        {
            self::$supplier = Supplier::find($id);
        } else {
            self::$supplier = new Supplier();
        }
        self::$supplier->name                           = $request->name ?? '';
        self::$supplier->sup_code                       = $request->sup_code ?? '';
        self::$supplier->email                          = $request->email ?? '';
        self::$supplier->mobile                         = $request->mobile ?? '';
        self::$supplier->nid                            = $request->nid ?? '';
        self::$supplier->cperson                        = $request->cperson ?? '';
        self::$supplier->cmobile                        = $request->cmobile ?? '';
        self::$supplier->creditlimit                    = $request->creditlimit ?? '';
        self::$supplier->balance                        = $request->balance ?? '';
        self::$supplier->rank                           = $request->rank ?? '';
        self::$supplier->address                        = $request->address ?? '';
        self::$supplier->note                           = $request->note ?? '';
//        self::$supplier->branch_id                      = $request->branch_id ?? '';
//        self::$supplier->company_id                     = $request->company_id ?? '';
        self::$supplier->status                         = $request->status ?? '';
        self::$supplier->image                          = FileUpload::imageUpload($request->file('image'), 'admin/uploaded-files/people/suppliers/', 'sup', '300', '200', isset($id)? self::$supplier->image:'') ;
        self::$supplier->save();
        return self::$supplier;
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
