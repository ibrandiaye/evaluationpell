<?php
namespace App\Repositories;

use App\Models\Note;
use Illuminate\Support\Facades\DB;

class NoteRepository extends RessourceRepository{

    public function __construct(Note $note)
    {
        $this->model = $note;
    }

    public function verifNote($candidat_id,$user_id)
    {
        return DB::table("notes")

        ->where("candidat_id",$candidat_id)
        ->where("user_id",$user_id)
        ->first();

    }
    public function updateNote($candidat_id,$user_id,$note)
    {
        return DB::table("notes")

        ->where("candidat_id",$candidat_id)
        ->where("user_id",$user_id)
        ->update(["note" => $note]);


    }

    public function getByCorrecteur($user_id)
    {
        return DB::table("notes")

        ->where("user_id",$user_id)
        ->get();

    }
    public function nbNote()
    {
        return DB::table("notes")->count();
    }
    public function getWithRelations()
    {
        return DB::table("notes")
        ->join("candidats","notes.candidat_id","=","candidats.id")
        ->join("categories","candidats.categorie_id","=","categories.id")
         ->join("users","candidats.user_id","=","users.id")
        ->select("notes.*","categories.nom as categorie","candidats.nom as candidat","users.name")

        ->get();

    }
    public function getWithRelationsByCandidat($candidat)
    {
        return DB::table("notes")
        ->join("candidats","notes.candidat_id","=","candidats.id")
        ->join("categories","candidats.categorie_id","=","categories.id")
        ->select("notes.*","candidats.image","categories.nom as categorie")
        ->where("notes.candidat_id",$candidat)
        ->get();

    }
    public function getWithRelationsByCategorie($categorie)
    {
        return DB::table("notes")
        ->join("candidats","notes.candidat_id","=","candidats.id")
        ->join("categories","candidats.categorie_id","=","categories.id")
        ->select("notes.*","candidats.image","categories.nom as categorie")
        ->where("candidats.categorie_id",$categorie)
        ->get();

    }
    public function rtsCandidatByCategorie($categorie)
    {
        return DB::table("notes")
        ->join("candidats","notes.candidat_id","=","candidats.id")
        ->select("candidats.nom","candidats.image",DB::raw('count(notes.id) as notes'))
        ->where("candidats.categorie_id",$categorie)
        ->groupBy("candidats.nom","candidats.image")
        ->get();

    }

}
