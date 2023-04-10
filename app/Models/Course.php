<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Course extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    protected $scores = [
        'A' => 4,
        'A-' => 3.7,
        'B+' => 3.3,
        'B' => 3,
        'B-' => 2.7,
        'C+' => 2.3,
        'C' => 2,
        'D' => 1,
        'E' => 0,
    ];

    /**
     * The experts that belong to the Expert
     */
    public function experts(): BelongsToMany
    {
        return $this->belongsToMany(Expert::class);
    }

    /**
     * The users that belong to the Expert
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    public function inNumber(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->isPivotExist() ? $this->scores[$this->pivot->score] : '',
        );
    }

    protected function isPivotExist(): bool
    {
        return isset($this->pivot->score);
    }
}
