<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Designation extends Model
{
    use HasFactory;
//    use Searchable;

    protected $fillable = ['name', 'description','status'];

    protected $searchableFields = ['*'];
    protected  static $designation;
    public static function createOrUpdateUser ($request, $id = null)
    {
        if (isset($id))
        {
            self::$designation = Designation::find($id);
        } else {
            self::$designation = new Designation();
        }
        self::$designation->name                       = $request->name ?? '';
        self::$designation->description                = $request->description ?? '';
        self::$designation->status                     = $request->status ?? '';
        self::$designation->save();
        return self::$designation;
    }

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
}
