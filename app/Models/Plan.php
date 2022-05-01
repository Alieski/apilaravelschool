<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $fillable = ['name'];

    /**
     * The Conferences that belong to the Plan.
     */
    public function conferences()
    {
        return $this->belongsToMany(Conference::class,'plans_conferences','conference_id','plan_id');
    }
}
