<?php

namespace App\Models;

use App\Helper\FileUpload;
use App\Models\Scopes\Searchab;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Hash;

class Company extends Model
{
    use HasFactory;
//    use Searchable;

protected static $company;
    protected $fillable = [
        'name',
        'page_header',
        'address',
        'phone',
        'fax',
        'mobile',
        'web',
        'tin',
        'vat',
        'tin_image',
        'license',
        'license_image',
        'email',
        'logo',
        'status',
        'slug',
    ];

    protected $searchableFields = ['*'];

    public static function createOrUpdateUser ($request, $id = null)
    {
        if (isset($id))
        {
            self::$company = Company::find($id);
        } else {
            self::$company = new Company();
        }
        self::$company->name                       = $request->name ?? '';
        self::$company->page_header                = $request->page_header ?? '';
        self::$company->address                    = $request->address ?? '';
        self::$company->email                      = $request->email ?? '';
        self::$company->phone                      = $request->phone ?? '';
        self::$company->fax                        = $request->fax ?? '';
        self::$company->mobile                     = $request->mobile ?? '';
        self::$company->web                        = $request->web ?? '';
        self::$company->tin                        = $request->tin ?? '';
        self::$company->vat                        = $request->vat ?? '';
        self::$company->license                    = $request->license ?? '';
        self::$company->status                     = $request->status ?? '';
        self::$company->logo                       = FileUpload::imageUpload($request->file('logo'), 'admin/uploaded-files/company/logo/', 'logo', '300', '200', isset($id)? self::$company->logo:'') ;
        self::$company->license_image              = FileUpload::imageUpload($request->file('license_image'), 'admin/uploaded-files/company/license/', 'license', '300', '200', isset($id)? self::$company->license_image:'') ;
        self::$company->tin_image                  = FileUpload::imageUpload($request->file('tin_image'), 'admin/uploaded-files/company/tin/', 'tin', '300', '200', isset($id)? self::$company->tin_image:'') ;
        self::$company->save();
        return self::$company;
    }

    public function branches()
    {
        return $this->hasMany(Branch::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
