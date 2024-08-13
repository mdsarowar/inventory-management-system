<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BankMobile extends Model
{
    use HasFactory;
    // use Searchable;

    protected $fillable = [
        'mfs_provider',         // Name of the mobile financial service provider (e.g., bKash, Nagad, Upay, etc.)
        'account_no',       // Unique account number for the mobile bank
        'account_name',         // Name associated with the mobile bank account
        'balance',              // Current balance of the account
        'deposit',
        'withdrawn',
        'note',
        'user_id',
        'branch_id',
        'company_id'
    ];

    protected $searchableFields = ['*'];

    protected $table = 'bank_mobiles';

    protected static $mfs;

    public static function createOrUpdateBankMobile ($request, $id = null)
    {
        if (isset($id))
        {
            self::$mfs = BankMobile::find($id);
        } else {
            self::$mfs = new BankMobile();
        }
        self::$mfs->mfs_provider               = $request->mfs_provider ?? '';
        self::$mfs->account_no                 = $request->account_no ?? '';
        self::$mfs->account_name               = $request->account_name ?? '';
        self::$mfs->balance                    = $request->balance ?? null;
        self::$mfs->deposit                    = $request->deposit ?? null;
        self::$mfs->withdrawn                  = $request->withdrawn ?? null;
        self::$mfs->note                       = $request->note ?? '';
        self::$mfs->user_id                    = $request->user_id ?? null;
        self::$mfs->branch_id                  = $request->branch_id ?? null;
        self::$mfs->company_id                 = $request->company_id ?? null;
        self::$mfs->save();
        return self::$mfs;
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