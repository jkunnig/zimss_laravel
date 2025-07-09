<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Person extends Model
{
    public $incrementing = false; // important: we're not using auto-increment
    protected $keyType = 'string'; // the 'id' is a string (varchar)
    protected $table = 'persons'; // ← this fixes the table name issue

    protected $fillable = [
        'id',
        'first_name',
        'middle_name',
        'last_name',
        'suffix',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id = self::generateCustomId();
        });
    }

    protected static function generateCustomId(): string
    {
        // Get the latest ID and increment
        $latest = DB::table('persons')->orderBy('id', 'desc')->first();

        if ($latest) {
            $next = (int)$latest->id + 1;
        } else {
            $next = 10000; // starting ID
        }

        return str_pad($next, 5, '0', STR_PAD_LEFT);
    }
}
