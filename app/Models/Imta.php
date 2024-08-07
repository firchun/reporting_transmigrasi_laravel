<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Imta extends Model
{
    use HasFactory;
    protected $table = 'imta';
    protected $guarded = [];
    public function tenaga_asing(): BelongsTo
    {
        return $this->belongsTo(TenagaAsing::class, 'id_tenaga_asing');
    }
}
