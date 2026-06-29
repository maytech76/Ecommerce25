<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'name',
        'max_age',
        'min_age',
        'gender_restriction',
        'status'
    ];

    protected $casts = [
        'status' => 'boolean',
        'min_age' => 'integer',
        'max_age' => 'integer'
    ];

    // Relación con Evento
    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    // Accessor para el status
    public function getStatusLabelAttribute()
    {
        return $this->status == 1 ? 'Activa' : 'Inactiva';
    }

    public function getStatusBadgeClassAttribute()
    {
        return $this->status == 1 ? 'bg-success' : 'bg-danger';
    }

    // Accessor para el género (ya viene en MAYÚSCULAS de la BD)
    public function getGenderLabelAttribute()
    {
        return $this->gender_restriction ?? 'N/A';
    }

    // Scope para activas
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    // Scope para inactivas
    public function scopeInactive($query)
    {
        return $query->where('status', 0);
    }
}