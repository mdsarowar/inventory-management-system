<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AccountBankTransaction extends Model
{
    use HasFactory;
    // use Searchable;

    protected $fillable = [
        'inv_number',
        'amount',
        'note',
        'date',
        'user_id',
        'branch_id',
        'company_id',
    ];

    protected $searchableFields = ['*'];

    protected $table = 'account_bank_transactions';

    protected $casts = [
        'date' => 'date'
    ];

    protected static $bank_transaction;

    public static function createOrUpdateBankTransaction ($request, $id = null)
    {
        if (isset($id))
        {
            self::$bank_transaction = AccountBankTransaction::find($id);
        } else {
            self::$bank_transaction = new AccountBankTransaction();
        }
        self::$bank_transaction->inv_number             = $request->inv_number ?? null;
        self::$bank_transaction->amount                 = $request->amount ?? '';
        self::$bank_transaction->note                   = $request->note ?? '';
        self::$bank_transaction->date                   = $request->date ?? null;
        self::$bank_transaction->user_id                = $request->user_id ?? null;
        self::$bank_transaction->branch_id              = $request->branch_id ?? null;
        self::$bank_transaction->company_id             = $request->company_id ?? null;
        self::$bank_transaction->save();
        return self::$bank_transaction;
    }

    public function details()
    {
        return $this->hasMany(AccountBankTransactionDetails::class, 'bank_tran_id');
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