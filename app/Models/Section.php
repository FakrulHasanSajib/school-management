<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;
use App\Models\AssignSubject;
use App\Models\Subject;


class Section extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function schoolClass()
    {
        return $this->belongsTo(SchoolClass::class);
    }
}
