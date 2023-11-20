<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Episode extends Model
{
    use HasFactory;
    
    public $timestamps = false;
    protected $fillable = ['number'];
    protected $casts = ['watched' => 'boolean'];

    public function season()
    {
        // Criação de relacionamento
        return $this->belongsTo(Season::class);
    }

    // public function scopeWatched(Builder $query)
    // {
    //     $query->where('watched', true);
    // }
}
