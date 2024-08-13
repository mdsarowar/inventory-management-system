<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BankTransaction extends Model
{
    use HasFactory;
    // use Searchable;

    protected $fillable = [
        'account_no',
        'account_name',
        'bank_name',
        'branch_name',
        'amount',
        'currency',
        'transaction_date',
        'status',
        'note',
        'user_id',
        'branch_id',
        'company_id'
    ];

    protected $searchableFields = ['*'];

    protected $table = 'bank_transactions';

    protected static $transaction;

    public static function createOrUpdateBankTransaction ($request, $id = null)
    {
        if (isset($id))
        {
            self::$transaction = BankTransaction::find($id);
        } else {
            self::$transaction = new BankTransaction();
        }
        self::$transaction->account_no                 = $request['account_no'] ?? '';
        self::$transaction->account_name               = $request['account_name'] ?? '';
        self::$transaction->bank_name                  = $request['bank_name'] ?? '';
        self::$transaction->branch_name                = $request['branch_name'] ?? '';
        self::$transaction->amount                     = $request['amount'] ?? null;
        self::$transaction->currency                   = $request['currency'] ?? '';
        self::$transaction->transaction_date           = $request['transaction_date'] ?? null;
        self::$transaction->status                     = $request['status'] ?? '';
        self::$transaction->note                       = $request->note ?? '';
        self::$transaction->user_id                    = $request['user_id'] ?? null;
        self::$transaction->branch_id                  = $request['branch_id'] ?? null;
        self::$transaction->company_id                 = $request['company_id'] ?? null;
        self::$transaction->save();
        return self::$transaction;
    }

    public function details()
    {
        return $this->hasMany(BankTransactionDetails::class, 'transaction_id');
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
