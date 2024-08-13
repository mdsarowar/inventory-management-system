<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Department extends Model
{
    use HasFactory;
//    use Searchable;

    protected $fillable = ['name', 'description','status'];

    protected $searchableFields = ['*'];

    protected  static $department;
    public static function createOrUpdateUser ($request, $id = null)
    {
        if (isset($id))
        {
            self::$department = Department::find($id);
        } else {
            self::$department = new Department();
        }
        self::$department->name                       = $request->name ?? '';
        self::$department->description                = $request->description ?? '';
        self::$department->status                     = $request->status ?? '';
        self::$department->save();
        return self::$department;
    }
    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
}
