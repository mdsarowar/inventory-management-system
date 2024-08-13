<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AccountReceive extends Model
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

    protected $table = 'account_receives';

    protected $casts = [
        'date' => 'date'
    ];

    protected static $receive;

    public static function createOrUpdateReceive ($request, $id = null)
    {
        if (isset($id))
        {
            self::$receive = AccountReceive::find($id);
        } else {
            self::$receive = new AccountReceive();
        }
        self::$receive->inv_number             = $request->inv_number ?? null;
        self::$receive->amount                 = $request->amount ?? '';
        self::$receive->note                   = $request->note ?? '';
        self::$receive->date                   = $request->date ?? null;
        self::$receive->user_id                = $request->user_id ?? null;
        self::$receive->branch_id              = $request->branch_id ?? null;
        self::$receive->company_id             = $request->company_id ?? null;
        self::$receive->save();
        return self::$receive;
    }

    public function details()
    {
        return $this->hasMany(AccountReceiveDetails::class, 'receive_id');
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