<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Serie extends Model
{
    use HasFactory;

    // protected $table = 'seriados'; configurar nome da tabela
    // public $timestamps = false; não preecher timestamps automaticamente
    protected $fillable = ['nome'];

    public function seasons()
    {
        // Criação de relacionamentos 1:n
        return $this->hasMany(Season::class);
    }
}
