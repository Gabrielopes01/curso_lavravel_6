<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [   //Valores que podem ser inseridos no BD
        'name', 
        'price', 
        'description', 
        'image'
    ];

    public function search($filter = null)  //Filtro
    {
        $results = $this->where(function($query) use($filter) {
            if($filter) {
                $query->where('name', 'LIKE', "%{$filter}%");
            }
        })->paginate();
        //->toSql //Retorna o comando rodado npo SQL

        return $results;
    }
}
