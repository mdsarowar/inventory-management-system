<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Invoice extends Model
{
    use HasFactory;
//    use Searchable;

    protected $fillable = [
        'type',
        'bank_type',
        'bank_id',
        'name',
        'vendor_type',
        'date',
        'due_date',
        'amount',
        'paid_amount',
        'due_amount',
        'status',
        'user_id',
        'branch_id',
        'company_id',
    ];

    protected $searchableFields = ['*'];

    protected  static $invoice;

    public static function createOrUpdateUser ($request, $id = null)
    {
        if (isset($id))
        {
            self::$invoice = Invoice::find($id);
        } else {
            self::$invoice = new Invoice();
        }
        self::$invoice->type                  = $request['type'] ?? '';
        self::$invoice->bank_type                  = $request['bank_type'] ?? '';
        self::$invoice->bank_id                  = $request['bank_id'] ?? '';
        self::$invoice->name             = $request['name']?? '';
        self::$invoice->vendor_type             = $request['vendor_type']?? '';
        self::$invoice->date                  = $request['date'] ?? '';
        self::$invoice->due_date                = $request['due_date'] ?? '';
        self::$invoice->amount                = $request['amount'] ?? '';
        self::$invoice->paid_amount                = $request['paid_amount'] ?? '';
        self::$invoice->due_amount                     = $request['due_amount'] ?? '';
        self::$invoice->status                = $request['status'] ?? '';
//        self::$invoice->user_id                     = $request['user_id'] ?? '';
//        self::$invoice->branch_id             = $request['branch_id'] ?? '';
//        self::$invoice->company_id             = $request['company_id'] ?? '';
        self::$invoice->save();
        return self::$invoice;
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
