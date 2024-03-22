<?php

namespace App\Models;

use App\Models\Season;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
