<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dossard extends Model
{
    use HasFactory;

    protected $fillable = [
        'epreuve_id',
        'background_image',
        'font_family',
        'font_size',
        'color',
        'position_x',
        'position_y',
        'with_name',
    ];

    // Relation : un dossard appartient à une épreuve
    public function epreuve()
    {
        return $this->belongsTo(Epreuve::class);
    }
}
