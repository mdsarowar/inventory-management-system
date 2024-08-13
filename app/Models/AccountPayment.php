<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AccountPayment extends Model
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

    protected $table = 'account_payments';

    protected $casts = [
        'date' => 'date'
    ];

    protected static $payment;

    public static function createOrUpdatePayment ($request, $id = null)
    {
        if (isset($id))
        {
            self::$payment = AccountPayment::find($id);
        } else {
            self::$payment = new AccountPayment();
        }
        self::$payment->inv_number             = $request->inv_number ?? null;
        self::$payment->amount                 = $request->amount ?? '';
        self::$payment->note                   = $request->note ?? '';
        self::$payment->date                   = $request->date ?? null;
        self::$payment->user_id                = $request->user_id ?? null;
        self::$payment->branch_id              = $request->branch_id ?? null;
        self::$payment->company_id             = $request->company_id ?? null;
        self::$payment->save();
        return self::$payment;
    }

    public function details()
    {
        return $this->hasMany(AccountPaymentDetails::class, 'payment_id');
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