<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Realty extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'price', 'bedroom', 'bathroom', 'storey', 'garage'];

    public function getRealty()

    {
        $records = DB::table('realties')->select('id','name', 'price', 'bedroom', 'bathroom', 'storey', 'garage');
        return $records;
    }
}
