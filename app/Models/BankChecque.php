<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BankChecque extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'bank_account_id',
        'quntity',
        'is_serial',
        'reference',
        'issue_date',
        'amount',
        'note',
        'user_id',
        'status',
        'company_id',
        'branch_id',
    ];

    protected $searchableFields = ['*'];

    protected $table = 'bank_checques';


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
        self::$transfer->quntity                   = $request->quntity ?? '';
        self::$transfer->is_serial                  = $request->is_serial ?? '';
        self::$transfer->reference                = $request->reference ?? '';
        self::$transfer->issue_date                 = $request->issue_date ?? null;
        self::$transfer->amount                     = $request->amount ?? null;
        self::$transfer->status                     = $request->status ?? '';
        self::$transfer->note                       = $request->note ?? '';
        self::$transfer->user_id                    = $request->user_id ?? null;
        self::$transfer->branch_id                  = $request->branch_id ?? null;
        self::$transfer->company_id                 = $request->company_id ?? null;
        self::$transfer->save();
        return self::$transfer;
    }


    public function bankAccount()
    {
        return $this->belongsTo(BankAccount::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, 'bankChecque_id');
    }

    public function checqueSerials()
    {
        return $this->hasMany(ChecqueSerial::class);
    }
}
