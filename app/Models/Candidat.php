<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidat extends Model
{
    use HasFactory;
      protected $fillable = [
         'nom',  'categorie_id'
    ];
      public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }
     public function notes()
    {
        return $this->hasMany(Note::class);
    }

    /* public function getTotolAttribute()
    {
        $total = 0;
        $total += $this->votes;
        return $total;
    }*/

  /*  public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }*/
}
