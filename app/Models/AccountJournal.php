<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AccountJournal extends Model
{
    use HasFactory;

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

    protected $table = 'account_journals';

    protected $casts = [
        'date' => 'date'
    ];

    protected static $journal;

    public static function createOrUpdateJournal ($request, $id = null)
    {
        if (isset($id))
        {
            self::$journal = AccountJournal::find($id);
        } else {
            self::$journal = new AccountJournal();
        }
        self::$journal->inv_number                 = $request->inv_number ?? null;
        self::$journal->amount                     = $request->amount ?? '';
        self::$journal->note                       = $request->note ?? '';
        self::$journal->date                       = $request->date ?? null;
        self::$journal->user_id                    = $request->user_id ?? null;
        self::$journal->branch_id                  = $request->branch_id ?? null;
        self::$journal->company_id                 = $request->company_id ?? null;
        self::$journal->save();
        return self::$journal;
    }

    public function details()
    {
        return $this->hasMany(AccountJournalDetails::class, 'journal_id');
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