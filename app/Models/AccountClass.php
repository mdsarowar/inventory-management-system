<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AccountClass extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'bname',
        'description',
        'user_id',
        'branch_id',
        'company_id'
    ];

    protected $searchableFields = ['*'];

    protected $table = 'account_classes';

    protected static $class;

    public static function createOrUpdateClass ($request, $id = null)
    {
        if (isset($id))
        {
            self::$class = AccountClass::find($id);
        } else {
            self::$class = new AccountClass();
        }
        self::$class->name                       = $request->name ?? '';
        self::$class->bname                      = $request->bname ?? '';
        self::$class->description                = $request->description ?? '';
        self::$class->user_id                    = $request->user_id ?? null;
        self::$class->branch_id                  = $request->branch_id ?? null;
        self::$class->company_id                 = $request->company_id ?? null;
        self::$class->save();
        return self::$class;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}