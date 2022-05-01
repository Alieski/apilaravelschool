<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Klass;

class Conference extends Model
{
    protected $fillable = ['subject', 'description'];

    /**
     * The Classes that belong to the Conferences.
     */
    public function klasses()
    {
        return $this->belongsToMany(Klass::class,'klasses_conferences', 'klass_id','conference_id');
    }

    /**
     * The Plans that belong to the Conferences.
     */
    public function plans()
    {
        return $this->belongsToMany(Plans::class,'plans_conferences', 'plan_id','conference_id');
    }
}
