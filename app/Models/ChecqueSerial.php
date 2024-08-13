<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ChecqueSerial extends Model
{
    use HasFactory;
//    use Searchable;

    protected $fillable = ['checque_id', 'checque_serial', 'is_used', 'status'];

    protected $searchableFields = ['*'];

    protected $table = 'checque_serials';
    protected  static $checque_serial;

    public static function createOrUpdateUser ($request, $id = null)
    {
        if (isset($id))
        {
            self::$checque_serial = ChecqueSerial::find($id);
        } else {
            self::$checque_serial = new ChecqueSerial();
        }
        self::$checque_serial->checque_id                   = $request->checque_id ?? '';
        self::$checque_serial->checque_serial               = $request->checque_serial ?? '';
        self::$checque_serial->is_used                      = $request->is_used ?? '';
        self::$checque_serial->status                       = $request->status ?? '';
        self::$checque_serial->save();
        return self::$checque_serial;
    }
    public function checque()
    {
        return $this->belongsTo(Checque::class);
    }
}
