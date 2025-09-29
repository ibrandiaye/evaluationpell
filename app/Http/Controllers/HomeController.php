<?php

namespace App\Http\Controllers;

use App\Repositories\CandidatRepository;
use App\Repositories\CategorieRepository;
use App\Repositories\NoteRepository;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

     protected $candidatRepository;
     protected $categorieRepository;
     protected $noteRepository;
    public function __construct(CandidatRepository $candidatRepository,CategorieRepository $categorieRepository,
                                NoteRepository $noteRepository)
    {
        $this->middleware('auth');
        $this->candidatRepository = $candidatRepository;
        $this->categorieRepository = $categorieRepository;
        $this->noteRepository  = $noteRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = auth()->user();

        $notes = $this->noteRepository->getByCorrecteur($user->id);

        $categories = $this->categorieRepository->getAll();

        foreach ($categories as $key => $categorie) {
           foreach ($categorie->candidats as $candidat) {
                foreach ($notes as $note) {
                    if($note->candidat_id == $candidat->id)
                    {
                        $candidat->note = $note->note;
                       // dd($candidat );
                    }
                }
           }
        }


        return view('home',compact('categories'));
    }
    public function allCandidat()
    {
        $candidats = $this->candidatRepository->getAll();
        //dd($candidats);
        $categories = $this->categorieRepository->getAll();
        $categorie_id = null;
        return view('note', compact("candidats","categories","categorie_id"));
    }

    public function noter(Request $request)
    {
        $note = $this->noteRepository->verifNote($request->candidat_id,$request->categorie_id,$request->ip());

        if(!empty($note))
        {
            return redirect()->back()->withErrors(["error"=>"Vous avez déjà note pour cette categorie"]);

        }
        else
        {

            $request->merge(["ip_adresse"=>$request->ip()]);
            $this->noteRepository->store($request->all());
            $candidat = $this->candidatRepository->getById($request->candidat_id);
            $candidat->notes += 1;
            $this->candidatRepository->updateNote($request->candidat_id,$candidat->notes);
            return redirect()->back()->with([ "success"=>"Note note est enregistrée avec succès"]);

        }

    }

     public function candidatByCategorie(Request $request)
    {
        $categorie_id = $request->categorie_id;
        if($request->categorie_id!="all")
        {
            $candidats = $this->candidatRepository->getByCategorie($request->categorie_id);
        }
        else{
            $candidats = $this->candidatRepository->getAll();
        }

        $categories = $this->categorieRepository->getAll();
        return view('note', compact("candidats","categories","categorie_id"));
    }

    public function rtsByCategorie(Request $request)
    {
        $nbCandidat = $this->candidatRepository->nbCandidat();
        $nbCategorie = $this->categorieRepository->nbCategorie();
        $nbNotes = $this->noteRepository->nbNote();
        $categories = $this->categorieRepository->allCategories();
        $rts = $this->noteRepository->rtsCandidatByCategorie($request->categorie);
        //dd($rts);
         $categorie = null;
        foreach ($categories as $key => $value) {
            if($value->id == $request->categorie )
            {
                 $categorie = $value->nom;
            }
        }
        return view('home',compact('nbCandidat','nbCategorie','nbNotes','categories','rts','categorie'));
    }
}
