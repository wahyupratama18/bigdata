<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Collection;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The courses that belong to the User
     */
    public function courses(): BelongsToMany
    {
        return $this->belongsToMany(Course::class)->withPivot('score');
    }

    public function syncCourses(Collection $courses, array $scores): self
    {
        $this->courses()
        ->sync(
            $courses->mapWithKeys(fn ($course, int $key) => [$course => ['score' => $scores[$key]]])
            ->toArray()
        );

        return $this;
    }

    public function userExpertise(bool $kbk = true): Collection
    {
        $this->relationLoaded('courses.experts') || $this->load('courses.experts');

        $courses = $this->courses->map(
            fn (Course $course) => $course->experts->pluck('name')
            ->map(fn (string $expert) => [
                'name' => $course->name,
                'score' => $course->inNumber,
                'expert' => $expert,
            ])
        )->flatten(1)
        ->groupBy('expert')
        ->map(function (Collection $expert) {
            return $expert->average('score');
        });

        if ($kbk) {
            $courses->put('kbk', $courses->search($courses->max()));
        }

        return $courses;
    }
}
