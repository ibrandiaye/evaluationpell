<?php
namespace App\Repositories;

use App\Models\Candidat;
use Illuminate\Support\Facades\DB;

class CandidatRepository extends RessourceRepository{

    public function __construct(Candidat $candidat)
    {
        $this->model = $candidat;
    }

    public function updateVote($candidat,$vote)
    {
        return DB::table("candidats")->where("id",$candidat)->update(["votes"=>$vote]);
    }
    public function getByCategorie($categorie)
    {
        return Candidat::with("categorie")
        ->where("categorie_id",$categorie)
        ->get();
    }
    public function nbCandidat()
    {
        return DB::table("candidats")->count();
    }


}
