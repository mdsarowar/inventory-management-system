<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AccountGroup extends Model
{
    use HasFactory;

    protected $fillable = [
        'class_id',
        'name',
        'description',
        'bname',
        'user_id',
        'branch_id',
        'company_id',
    ];

    protected $searchableFields = ['*'];

    protected $table = 'account_groups';

    protected static $group;

    public static function createOrUpdateGroup ($request, $id = null)
    {
        if (isset($id))
        {
            self::$group = AccountGroup::find($id);
        } else {
            self::$group = new AccountGroup();
        }
        self::$group->class_id                   = $request->class_id ?? null;
        self::$group->name                       = $request->name ?? '';
        self::$group->bname                      = $request->bname ?? '';
        self::$group->description                = $request->description ?? '';
        self::$group->user_id                    = $request->user_id ?? null;
        self::$group->branch_id                  = $request->branch_id ?? null;
        self::$group->company_id                 = $request->company_id ?? null;
        self::$group->save();
        return self::$group;
    }

    public function class()
    {
        return $this->belongsTo(AccountClass::class);
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