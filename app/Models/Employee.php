<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
    'first_name',
    'middle_name',
    'last_name',
    'name_extension',
    // any other columns you allow from the form
];


    public function person()
    {
        return $this->belongsTo(Person::class);
    }
}
