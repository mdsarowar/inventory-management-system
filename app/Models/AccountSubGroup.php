<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AccountSubGroup extends Model
{
    use HasFactory;

    protected $fillable = [
        'class_id',
        'group_id',
        'name',
        'bname',
        'description',
        'user_id',
        'branch_id',
        'company_id',
    ];

    protected $searchableFields = ['*'];

    protected $table = 'account_sub_groups';

    protected static $sub_group;

    public static function createOrUpdateSubGroup ($request, $id = null)
    {
        if (isset($id))
        {
            self::$sub_group = AccountSubGroup::find($id);
        } else {
            self::$sub_group = new AccountSubGroup();
        }
        self::$sub_group->class_id                   = $request->class_id ?? null;
        self::$sub_group->group_id                   = $request->group_id ?? null;
        self::$sub_group->name                       = $request->name ?? '';
        self::$sub_group->bname                      = $request->bname ?? '';
        self::$sub_group->description                = $request->description ?? '';
        self::$sub_group->user_id                    = $request->user_id ?? null;
        self::$sub_group->branch_id                  = $request->branch_id ?? null;
        self::$sub_group->company_id                 = $request->company_id ?? null;
        self::$sub_group->save();
        return self::$sub_group;
    }

    public function class()
    {
        return $this->belongsTo(AccountClass::class);
    }
    
    public function group()
    {
        return $this->belongsTo(AccountGroup::class);
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