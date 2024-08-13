<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BankTransactionDetails extends Model
{
    use HasFactory;
    // use Searchable;

    protected $fillable = [
        'transaction_id',
        'credit_id',
        'debit_id',
        'amount',
        'note',
        'cheque_id',
        'cheque_date',
        'reference',
        'user_id',
        'branch_id',
        'company_id'
    ];

    protected $searchableFields = ['*'];

    protected $table = 'bank_transaction_details';

    public function transaction()
    {
        return $this->belongsTo(BankTransaction::class);
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