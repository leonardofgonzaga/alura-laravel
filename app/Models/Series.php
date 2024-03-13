<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Series extends Model
{
    use HasFactory;

    // protected $table = 'seriados'; configurar nome da tabela
    // public $timestamps = false; não preecher timestamps automaticamente
    protected $fillable = ['name', 'cover'];
    // protected $primaryKey = 'id';
    // protected $with = ['seasons']; Buscar séries já com as temporadas passando o relacionamento

    public function seasons()
    {
        // Criação de relacionamentos 1:n hasMany(classe, chaveEstrangeira)
        return $this->hasMany(Season::class, 'series_id');
    }

    protected static function booted()
    {
        self::addGlobalScope('ordered', function (Builder $queryBuilder) {
            $queryBuilder->orderBy('name');
        });
    }
}
