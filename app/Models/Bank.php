<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Bank extends Model
{
    use HasFactory;
    // use Searchable;

    protected $fillable = [
        'name',
        'short_name',
        'description',
        'status',
        'user_id',
        'branch_id',
        'company_id'
    ];

    protected $searchableFields = ['*'];

    protected $table = 'banks';

    protected static $bank;

    public static function createOrUpdateBank ($request, $id = null)
    {
        if (isset($id))
        {
            self::$bank = Bank::find($id);
        } else {
            self::$bank = new Bank();
        }
        self::$bank->name                       = $request->name ?? '';
        self::$bank->short_name                 = $request->short_name ?? '';
        self::$bank->description                = $request->description ?? '';
        self::$bank->status                     = $request->status ?? '';
        self::$bank->user_id                    = $request->user_id ?? null;
        self::$bank->branch_id                  = $request->branch_id ?? null;
        self::$bank->company_id                 = $request->company_id ?? null;
        self::$bank->save();
        return self::$bank;
    }

    public function accounts()
    {
        return $this->hasMany(BankAccount::class);
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