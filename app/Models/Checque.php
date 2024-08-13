<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Checque extends Model
{
    use HasFactory;
//    use Searchable;

    protected $fillable = [
        'quntity',
        'is_serial',
        'reference',
        'description',
        'status',
        'bank_account_id',
        'company_id',
        'branch_id',
    ];

    protected $searchableFields = ['*'];

    protected  static $checque;

    public static function createOrUpdateUser ($request, $id = null)
    {
        if (isset($id))
        {
            self::$checque = Checque::find($id);
        } else {
            self::$checque = new Checque();
        }
        self::$checque->quntity                   = $request->quntity ?? '';
        self::$checque->is_serial                 = $request->is_serial ?? '';
        self::$checque->reference                 = $request->reference ?? '';
        self::$checque->description               = $request->description ?? '';
        self::$checque->bank_account_id           = $request->bank_account_id ?? '';
        self::$checque->company_id                = $request->company_id ?? '';
        self::$checque->branch_id                 = $request->branch_id ?? '';
        self::$checque->status                    = $request->status ?? '';
        self::$checque->save();

        return self::$checque;
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
        return $this->hasMany(Payment::class);
    }

    public function checqueSerials()
    {
        return $this->hasMany(ChecqueSerial::class);
    }
}
