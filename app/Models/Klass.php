<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Student;
use App\Models\Conference;

class Klass extends Model
{
    protected $fillable = ['name'];

    /**
     * Get the students of the Class
     */
    public function students()
    {
        return $this->hasMany(Student::class,'class_id');
    }

    /**
     * The Conferences that belong to the Klass.
     */
    public function conferences()
    {
        return $this->belongsToMany(Conference::class,'klasses_conferences','conference_id','klass_id');
    }
}
