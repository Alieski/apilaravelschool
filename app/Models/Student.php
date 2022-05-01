<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Klass;

class Student extends Model
{
    protected $fillable = ['name', 'email'];

    /**
     * Get the class that owns the student.
     */
    public function klass()
    {
        return $this->belongsTo(Klass::class,'class_id');
    }
}
