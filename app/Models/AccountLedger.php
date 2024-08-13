<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AccountLedger extends Model
{
    use HasFactory;
    // use Searchable;

    protected $fillable = [
        'class_id',
        'group_id',
        'subgroup_id',
        'name',
        'bname',
        'description',
        'user_id',
        'branch_id',
        'company_id',
    ];

    protected $searchableFields = ['*'];

    protected $table = 'account_ledgers';

    protected static $ledger;

    public static function createOrUpdateLedger ($request, $id = null)
    {
        if (isset($id))
        {
            self::$ledger = AccountLedger::find($id);
        } else {
            self::$ledger = new AccountLedger();
        }
        self::$ledger->class_id                   = $request->class_id ?? null;
        self::$ledger->group_id                   = $request->group_id ?? null;
        self::$ledger->subgroup_id                = $request->subgroup_id ?? null;
        self::$ledger->name                       = $request->name ?? '';
        self::$ledger->bname                      = $request->bname ?? '';
        self::$ledger->description                = $request->description ?? '';
        self::$ledger->user_id                    = $request->user_id ?? null;
        self::$ledger->branch_id                  = $request->branch_id ?? null;
        self::$ledger->company_id                 = $request->company_id ?? null;
        self::$ledger->save();
        return self::$ledger;
    }

    public function class()
    {
        return $this->belongsTo(AccountClass::class);
    }
    
    public function group()
    {
        return $this->belongsTo(AccountGroup::class);
    }

    public function sub_group()
    {
        return $this->belongsTo(AccountSubGroup::class, 'subgroup_id');
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