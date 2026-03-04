<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Course extends Model
{
    protected $fillable = [
        'course_code',
        'course_name',
        'description',
        'units',
        'schedule',
        'instructor',
        'capacity',
        'students_count',
        'semester',
        'academic_year',
        'room',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'units'          => 'integer',
            'capacity'       => 'integer',
            'students_count' => 'integer',
            'is_active'      => 'boolean',
        ];
    }

    // ─── Relationships ───────────────────────────

    /**
     * Many-to-Many: Course <-> Student
     */
    public function students(): BelongsToMany
    {
        return $this->belongsToMany(Student::class, 'course_student')
                    ->withPivot('grade', 'attendance_percentage', 'status', 'enrolled_at', 'remarks')
                    ->withTimestamps();
    }

    public function enrolledStudents(): BelongsToMany
    {
        return $this->students()->wherePivot('status', 'enrolled');
    }

    // ─── Business Logic ─────────────────────────

    /**
     * CAPACITY CONTROL: Is this course full?
     */
    public function isFull(): bool
    {
        return $this->students_count >= $this->capacity;
    }

    public function getAvailableSlotsAttribute(): int
    {
        return max(0, $this->capacity - $this->students_count);
    }

    public function getCapacityPercentageAttribute(): float
    {
        if ($this->capacity === 0) return 100;
        return round(($this->students_count / $this->capacity) * 100, 1);
    }
}