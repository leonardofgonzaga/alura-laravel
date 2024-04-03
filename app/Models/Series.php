<?php

namespace App\Models;

use App\Models\Season;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Series extends Model
{
    use HasFactory;

    // protected $table = 'seriados'; configurar nome da tabela
    // public $timestamps = false; não preecher timestamps automaticamente
    protected $fillable = ['name', 'cover'];
    // protected $primaryKey = 'id';
    // protected $with = ['seasons']; Buscar séries já com as temporadas passando o relacionamento
    protected $appends = ['links'];

    public function seasons()
    {
        // Criação de relacionamentos 1:n hasMany(classe, chaveEstrangeira)
        return $this->hasMany(Season::class, 'series_id');
    }

    public function episodes()
    {
        return $this->hasManyThrough(Episode::class, Season::class);
    }

    protected static function booted()
    {
        self::addGlobalScope('ordered', function (Builder $queryBuilder) {
            $queryBuilder->orderBy('name');
        });
    }

    public function links(): Attribute 
    {
        return new Attribute(
            get: fn() => [
                [
                    'rel' => 'self',
                    'url' => "/api/series/{$this->id}"
                ],
                [
                    'rel' => 'seasons',
                    'url' => "/api/series/{$this->id}/seasons"
                ],
                [
                    'rel' => 'self',
                    'url' => "/api/series/{$this->id}/episodes"
                ],
            ]
        );
    }
}
