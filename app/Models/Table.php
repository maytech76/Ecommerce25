<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'capacity',
        'description',
        'status'
    ];

    protected $attributes = [
        'status' => 'disponible', // Valor por defecto
    ];

    // Scope para mesas activas
    public function scopeActive($query)
    {
        return $query->where('status', '!=', 'inactiva');
    }

    // Scope para mesas disponibles
    public function scopeAvailable($query)
    {
        return $query->where('status', 'disponible');
    }

    // Verificar si la mesa está disponible
    public function isAvailable()
    {
        return $this->status === 'disponible';
    }

    // Verificar si la mesa está activa
    public function isActive()
    {
        return $this->status !== 'inactiva';
    }
}