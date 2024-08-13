<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BankAccount extends Model
{
    use HasFactory;
    // use Searchable;

    protected $fillable = [
        'bank_id',
        'branch_name',
        'branch_code',
        'branch_address',
        'account_no',
        'account_holder',
        'balance',
        'status',
        'user_id',
        'branch_id',
        'company_id'
    ];

    protected $searchableFields = ['*'];

    protected $table = 'bank_accounts';

    protected static $account;

    public static function createOrUpdateBankAccount ($request, $id = null)
    {
        if (isset($id))
        {
            self::$account = BankAccount::find($id);
        } else {
            self::$account = new BankAccount();
        }
        self::$account->bank_id                    = $request->bank_id ?? null;
        self::$account->branch_name                = $request->branch_name ?? '';
        self::$account->branch_code                = $request->branch_code ?? '';
        self::$account->branch_address             = $request->branch_address ?? '';
        self::$account->account_no                 = $request->account_no ?? '';
        self::$account->account_holder             = $request->account_holder ?? '';
        self::$account->balance                    = $request->balance ?? null;
        self::$account->status                     = $request->status ?? '';
        self::$account->user_id                    = $request->user_id ?? null;
        self::$account->branch_id                  = $request->branch_id ?? null;
        self::$account->company_id                 = $request->company_id ?? null;
        self::$account->save();
        return self::$account;
    }

    public function bank()
    {
        return $this->belongsTo(Bank::class, 'bank_id');
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