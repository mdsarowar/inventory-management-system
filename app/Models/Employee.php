<?php

namespace App\Models;

use App\Helper\FileUpload;
use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employee extends Model
{
    use HasFactory;
//    use Searchable;

    protected $fillable = [
        'department_id',
        'name',
        'designation_id',
        'fname',
        'mname',
        'mobile',
        'phone',
        'email',
        'nid',
        'dob',
        'joining_date',
        'salary',
        'status',
        'image',
        'address',
        'per_address',
        'company_id',
        'branch_id',
    ];

    protected $searchableFields = ['*'];

    protected  static $employee;

    public static function createOrUpdateUser ($request, $id = null)
    {
//        $lastdata=Product::orderBy('sku','DESC')->first();
        if (isset($id))
        {
            self::$employee = Employee::find($id);
        } else {
            self::$employee = new Employee();
        }
        self::$employee->name                       = $request->name ?? '';
        self::$employee->department_id              = $request->department_id ?? '';
        self::$employee->designation_id             = $request->designation_id ?? '';
        self::$employee->fname                     = $request->fname ?? '';
        self::$employee->mname                        = $request->mname ?? '';
        self::$employee->mobile                    = $request->mobile ?? '';
        self::$employee->phone                    = $request->phone ?? '';
        self::$employee->email                = $request->email ?? '';
        self::$employee->nid                    = $request->nid ?? '';
        self::$employee->dob                       = $request->dob ?? '';
        self::$employee->joining_date                    = $request->joining_date ?? '';
        self::$employee->salary                    = $request->salary ?? '';
        self::$employee->address                    = $request->address ?? '';
        self::$employee->per_address                       = $request->per_address ?? '';
//        self::$employee->branch_id                  = $request->branch_id ?? '';
//        self::$employee->company_id                 = $request->company_id ?? '';
        self::$employee->status                     = $request->status ?? '';
        self::$employee->image                      = FileUpload::imageUpload($request->file('image'), 'admin/uploaded-files/people/customers/', 'cus', '300', '200', isset($id)? self::$employee->image:'') ;
        self::$employee->save();
        return self::$employee;
    }
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function designation()
    {
        return $this->belongsTo(Designation::class);
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
