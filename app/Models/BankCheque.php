<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BankCheque extends Model
{
    use HasFactory;
    // use Searchable;

    protected $fillable = [
        'bank_account_id',
        'inv_type',
        'cheque_no',
        'cheque_date',
        'cheque_bank',
        'issue_date',
        'amount',
        'status',
        'payee_name',
        'payee_account_number',
        'note',
        'user_id',
        'branch_id',
        'company_id'
    ];

    protected $searchableFields = ['*'];

    protected $table = 'bank_cheques';

    protected static $transfer;

    public static function createOrUpdateBankCheque ($request, $id = null)
    {
        if (isset($id))
        {
            self::$transfer = BankCheque::find($id);
        } else {
            self::$transfer = new BankCheque();
        }
        self::$transfer->bank_account_id            = $request->bank_account_id ?? '';
        self::$transfer->inv_type                   = $request->inv_type ?? '';
        self::$transfer->cheque_no                  = $request->cheque_no ?? '';
        self::$transfer->cheque_date                = $request->cheque_date ?? '';
        self::$transfer->cheque_bank                = $request->cheque_bank ?? null;
        self::$transfer->issue_date                 = $request->issue_date ?? null;
        self::$transfer->amount                     = $request->amount ?? null;
        self::$transfer->status                     = $request->status ?? '';
        self::$transfer->payee_name                 = $request->payee_name ?? '';
        self::$transfer->payee_account_number       = $request->payee_account_number ?? '';
        self::$transfer->note                       = $request->note ?? '';
        self::$transfer->user_id                    = $request->user_id ?? null;
        self::$transfer->branch_id                  = $request->branch_id ?? null;
        self::$transfer->company_id                 = $request->company_id ?? null;
        self::$transfer->save();
        return self::$transfer;
    }

    public function bank_account()
    {
        return $this->belongsTo(BankAccount::class, 'bank_account_id');
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
