@extends('welcome')
@section('title', '| candidat')


@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="btn-group float-right">

                                <ol class="breadcrumb hide-phone p-0 m-0">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}" >ACCUEIL</a></li>
                                <li class="breadcrumb-item active ">LISTE DES CANDIDATS</li>

                                </ol>
                            </div>
                              Gestion Vote PELL

                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    @if ($message = Session::get('error'))
        <div class="alert alert-danger">
            <p>{{ $message }}</p>
        </div>
    @endif


    @if ($errors->has('licence'))
        <div class="alert alert-danger">
            {!!  $errors->first('licence') !!} . <a href="{{route('indexCandidat')}}"><u>Merci de renouveler votre licence pour pouvoir continuer</u></a>
        </div>
    @endif

<div class="col-12">
    <div class="card ">
        <div class="card-header">
            LISTE DES CANDIDATS
            <div class="float-right">
                <a href="{{ route('candidat.create') }}" class="btn btn-primary">Ajouter un candidat</a>
            </div>
        </div>
            <div class="card-body">

                <table id="datatable-buttons" class="table table-bordered table-responsive-md table-striped text-center">
                    <thead>
                        <tr>
                            <th>#</th>
                             <th>Categorie</th>
                            <th>NOM </th>



                            <th>Note</th>

                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($candidats as $candidat)
                        <tr>
                            <td>{{ $candidat->id }}</td>
                             <td>{{ $candidat->categorie->nom}}</td>
                            <td>{{ $candidat->nom}}</td>
                            <td>
                                 @foreach ($candidat->notes as $note )
                                    {{ $note->user->name }} : {{ $note->note }}/10<br>
                                @endforeach
                            </td>



                            <td>

                                <a href="{{ route('candidat.edit', $candidat->id) }}" role="button" class="btn btn-warning"><i class="fas fa-edit"></i></a>
                                <form method="POST"
                                    action="{{ route('candidat.destroy', $candidat->id) }}"
                                    style="display:inline;"
                                    onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet enregistrement ?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger">
                                        <i class="far fa-trash-alt"></i>
                                    </button>
                                </form>


                            </td>

                        </tr>
                        @endforeach

                    </tbody>
                </table>

            </div>
    </div>
</div>

@endsection
