<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BankTransfer extends Model
{
    use HasFactory;
    // use Searchable;

    protected $fillable = [
        'transaction_id',
        'account_no',
        'account_name',
        'bank_name',
        'branch_name',
        'receiver_account_no',
        'receiver_account_name',
        'amount',
        'currency',
        'transfer_date',
        'status',
        'note',
        'user_id',
        'branch_id',
        'company_id'
    ];

    protected $searchableFields = ['*'];

    protected $table = 'bank_transfers';

    protected static $transfer;

    public static function createOrUpdateBankTransfer ($request, $id = null)
    {
        if (isset($id))
        {
            self::$transfer = BankTransfer::find($id);
        } else {
            self::$transfer = new BankTransfer();
        }
        self::$transfer->transaction_id             = $request->transaction_id ?? null;
        self::$transfer->account_no                 = $request->account_no ?? '';
        self::$transfer->account_name               = $request->account_name ?? '';
        self::$transfer->bank_name                  = $request->bank_name ?? '';
        self::$transfer->branch_name                = $request->branch_name ?? '';
        self::$transfer->receiver_account_no        = $request->receiver_account_no ?? '';
        self::$transfer->receiver_account_name      = $request->receiver_account_name ?? '';
        self::$transfer->amount                     = $request->amount ?? null;
        self::$transfer->currency                   = $request->currency ?? '';
        self::$transfer->transfer_date              = $request->transfer_date ?? null;
        self::$transfer->status                     = $request->status ?? '';
        self::$transfer->note                       = $request->note ?? '';
        self::$transfer->user_id                    = $request->user_id ?? null;
        self::$transfer->branch_id                  = $request->branch_id ?? null;
        self::$transfer->company_id                 = $request->company_id ?? null;
        self::$transfer->save();
        return self::$transfer;
    }

    public function transaction()
    {
        return $this->belongsTo(BankTransaction::class, 'transaction_id');
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