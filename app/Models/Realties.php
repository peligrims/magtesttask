<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Realties extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'price', 'bedroom', 'bathroom','storey','garage'];
}
