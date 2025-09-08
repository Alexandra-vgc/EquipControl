<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pdf extends Model
{
    use HasFactory;

    protected $table = 'pdfs'; // tu tabla existente
    protected $fillable = ['nombre', 'archivo']; // campos que vas a llenar
}
