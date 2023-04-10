<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Expert extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    /**
     * The courses that belong to the Expert
     */
    public function courses(): BelongsToMany
    {
        return $this->belongsToMany(Course::class);
    }
}
