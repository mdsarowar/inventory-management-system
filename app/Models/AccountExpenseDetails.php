<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AccountExpenseDetails extends Model
{
    use HasFactory;
    // use Searchable;

    protected $fillable = [
        'expense_id',
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

    protected $table = 'account_expense_details';

    protected $casts = [
        'date' => 'date',
        'cheque_date' => 'datetime',
    ];

    protected static $expense;

    public static function createOrUpdateExpenseDetails ($request, $id = null)
    {
        if (isset($id))
        {
            self::$expense = AccountExpenseDetails::find($id);
        } else {
            self::$expense = new AccountExpenseDetails();
        }
        self::$expense->expense_id             = $request->expense_id ?? null;
        self::$expense->inv_number             = $request->inv_number ?? null;
        self::$expense->credit_id              = $request->credit_id ?? null;
        self::$expense->debit_id               = $request->debit_id ?? null;
        self::$expense->amount                 = $request->amount ?? '';
        self::$expense->note                   = $request->note ?? '';
        self::$expense->date                   = $request->date ?? null;
        self::$expense->cheque_id              = $request->cheque_id ?? null;
        self::$expense->cheque_date            = $request->cheque_date ?? null;
        self::$expense->reference              = $request->reference ?? null;
        self::$expense->user_id                = $request->user_id ?? null;
        self::$expense->branch_id              = $request->branch_id ?? null;
        self::$expense->company_id             = $request->company_id ?? null;
        self::$expense->save();
        return self::$expense;
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