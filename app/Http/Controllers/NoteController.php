<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Repositories\NoteRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{
    protected $noteRepository;
    protected $candidatRepository;
    public function __construct(NoteRepository $noteRepository)
    {
        $this->middleware('auth');
        $this->noteRepository = $noteRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notes = $this->noteRepository->getWithRelations();
        //dd($notes);
        return view('note.index',compact('notes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('note.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
        'note' => 'required',
        'candidat_id' => 'required',
        ], );

        $user = Auth::user();

        $request['user_id'] = $user->id;

        $verifNote = $this->noteRepository->verifNote($request['candidat_id'],$request['user_id']);
        if($verifNote){
            //return redirect()->back()->with("error", "Vous avez déjà noté ce candidat");
            $this->noteRepository->updateNote($request['candidat_id'],$request['user_id'],$request['note']);
             return redirect()->back()->with("success","Succès");
        }

        $note = $this->noteRepository->store($request->all());
       // dd($note->id);
        return redirect()->back()->with("success","Succès");

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $note = $this->noteRepository->getById($id);
        return view('note.show',compact('note'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $note = $this->noteRepository->getById($id);
        return view('note.edit',compact('note'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $this->noteRepository->update($id, $request->all());
        return redirect('note');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->noteRepository->destroy($id);
        return redirect('note');
    }
}
