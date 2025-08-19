<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class SchoolClass extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function sections()
    {
        return $this->hasMany(Section::class);
    }

    public function assignSubjects()
    {
        return $this->hasMany(AssignSubject::class);
    }
}
