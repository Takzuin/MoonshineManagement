<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Employee extends Model
{
    use HasFactory;

    /**
     * Los atributos que son asignables en masa.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'department_id',
        'is_active',
    ];

    /**
     * Obtener el departamento al que pertenece el empleado.
     */
    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }
}