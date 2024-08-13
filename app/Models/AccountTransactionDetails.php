<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AccountTransactionDetails extends Model
{
    use HasFactory;
    // use Searchable;

    protected $fillable = [
        'transaction_id',
        'transaction_type',
        'inv_number',
        'credit_id',
        'debit_id',
        'amount',
        'note',
        'date',
        'cheque_id',
        'cheque_date',
        'reference',
        'user_id',
        'branch_id',
        'company_id'
    ];

    protected $searchableFields = ['*'];

    protected $table = 'account_transaction_details';

    protected $casts = [
        'date' => 'date',
        'cheque_date' => 'datetime'
    ];

    protected static $transaction;

    public static function createOrUpdateTransactionDetails ($request, $id = null)
    {
        if (isset($id))
        {
            self::$transaction = AccountTransactionDetails::find($id);
        } else {
            self::$transaction = new AccountTransactionDetails();
        }
        self::$transaction->transaction_id         = $request->transaction_id ?? null;
        self::$transaction->transaction_type       = $request->transaction_type ?? null;
        self::$transaction->inv_number             = $request->inv_number ?? null;
        self::$transaction->credit_id              = $request->credit_id ?? null;
        self::$transaction->debit_id               = $request->debit_id ?? null;
        self::$transaction->amount                 = $request->amount ?? '';
        self::$transaction->note                   = $request->note ?? '';
        self::$transaction->date                   = $request->date ?? null;
        self::$transaction->cheque_id              = $request->cheque_id ?? null;
        self::$transaction->cheque_date            = $request->cheque_date ?? null;
        self::$transaction->reference              = $request->reference ?? null;
        self::$transaction->user_id                = $request->user_id ?? null;
        self::$transaction->branch_id              = $request->branch_id ?? null;
        self::$transaction->company_id             = $request->company_id ?? null;
        self::$transaction->save();
        return self::$transaction;
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