<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Manufacture extends Model
{
    use HasFactory;
//    use Searchable;

    protected $fillable = [
        'name',
        'bname',
        'address',
        'cperson',
        'cmobile',
        'email',
        'web',
        'rank',
        'mainproduct',
        'description',
        'status',
    ];

    protected $searchableFields = ['*'];


    protected static $manufacture;

    public static function createOrUpdateManufacture ($request, $id = null)
    {
        if (isset($id))
        {
            self::$manufacture = Manufacture::find($id);
        } else {
            self::$manufacture = new Manufacture();
        }
        self::$manufacture->name                        = $request->name ?? '';
        self::$manufacture->bname                       = $request->bname ?? '';
        self::$manufacture->address                     = $request->address ?? '';
        self::$manufacture->cperson                     = $request->cperson ?? '';
        self::$manufacture->cmobile                     = $request->cmobile ?? '';
        self::$manufacture->email                       = $request->email ?? '';
        self::$manufacture->web                         = $request->web ?? '';
        self::$manufacture->rank                        = $request->rank ?? '';
        self::$manufacture->mainproduct                 = $request->mainproduct ?? '';
        self::$manufacture->description                 = $request->description ?? '';
        self::$manufacture->status                      = $request->status ?? '';
        self::$manufacture->save();
        return self::$manufacture;
    }
    public function product()
    {
        return $this->hasOne(Product::class);
    }
}
