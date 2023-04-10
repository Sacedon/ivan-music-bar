<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Band extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function scopeSearch($query, $terms){
        collect(explode(" " , $terms))->filter()->each(function($term) use($query){
            $term = '%'. $term . '%';

            $query->where('bandName', 'like', $term)
                ->orWhere('rate', 'like', $term)
                ->orWhere('genre', 'like', $term)
                ->orWhere('location', 'like', $term);
        });
    }


}
