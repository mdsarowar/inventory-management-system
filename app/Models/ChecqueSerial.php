<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ChecqueSerial extends Model
{
    use HasFactory;
//    use Searchable;

    protected $fillable = [
        'checque_serial',
        'is_used',
        'status',
        'bank_checque_id',
    ];

    protected $searchableFields = ['*'];

    protected $table = 'checque_serials';

    protected  static $checque;

    public static function createOrUpdateUser ($request, $id = null)
    {
        if (isset($id))
        {
            self::$checque = ChecqueSerial::find($id);
        } else {
            self::$checque = new ChecqueSerial();
        }
        self::$checque->checque_serial                   = $request->checque_serial ?? '';
        self::$checque->is_used                          = $request->is_used ?? '';
        self::$checque->bank_checque_id                  = $request->bank_checque_id ?? '';
        self::$checque->status                           = $request->status ?? '';
        self::$checque->save();

        return self::$checque;
    }
    public function bankChecque()
    {
        return $this->belongsTo(BankChecque::class);
    }
}
