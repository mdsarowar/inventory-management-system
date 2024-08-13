<?php

namespace App\Models;

use App\Helper\FileUpload;
use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Branch extends Model
{
    use HasFactory;
//    use Searchable;
protected static $branch;
    protected $fillable = [
        'name',
        'page_header',
        'address',
        'branch_code',
        'phone',
        'mobile',
        'fax',
        'email',
        'web',
        'logo',
        'status',
        'slug',
        'company_id',
    ];

    protected $searchableFields = ['*'];

    public static function createOrUpdateUser ($request, $id = null)
    {
        $lastbranch=Branch::orderBy('branch_code','DESC')->first();
        if (isset($id))
        {
            self::$branch = Branch::find($id);
        } else {
            self::$branch = new Branch();
        }
        self::$branch->name                       = $request->name ?? '';
        self::$branch->page_header                = $request->page_header ?? '';
        self::$branch->address                    = $request->address ?? '';
        self::$branch->email                      = $request->email ?? '';
        self::$branch->phone                      = $request->phone ?? '';
        self::$branch->fax                        = $request->fax ?? '';
        self::$branch->branch_code                = isset($id)? self::$branch->branch_code : (isset($lastbranch)? $lastbranch->branch_code+1 : 1) ;
        self::$branch->mobile                     = $request->mobile ?? '';
        self::$branch->web                        = $request->web ?? '';
        self::$branch->company_id                 = $request->company_id ?? '';
        self::$branch->status                     = $request->status ?? '';
        self::$branch->logo                       = FileUpload::imageUpload($request->file('logo'), 'admin/uploaded-files/company/branch/', 'branch', '300', '200', isset($id)? self::$branch->logo:'') ;
        self::$branch->save();
        return self::$branch;
    }
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function stores()
    {
        return $this->hasMany(Store::class);
    }
}
