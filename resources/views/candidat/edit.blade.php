{{-- \resources\views\permissions\create.blade.php --}}
@extends('welcome')

@section('title', '| Modifier Département')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="btn-group float-right">
                        <ol class="breadcrumb hide-phone p-0 m-0">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">ACCUEIL</a></li>
                        <li class="breadcrumb-item active">Modifier un categorie</li>


                        </ol>
                    </div>
                     Gestion Vote PELL

                </div>
            </div>
            <div class="clearfix"></div>
        </div>

        <form method="POST" action="{{ route('candidat.update', $candidat->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
             <div class="card ">
                        <div class="card-header text-center">FORMULAIRE DE MODIFICATION D'UN CANDIDAT</div>
                            <div class="card-body">
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    @if ($message = Session::get('success'))
                                        <div class="alert alert-success">
                                            <p>{{ $message }}</p>
                                        </div>
                                    @endif
                                @endif
                                <div class="row">

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Nom </label>
                                            <input type="text" name="nom"  value="{{ $candidat->nom }}" class="form-control"required>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <label>Categorie</label>
                                        <select class="form-control" name="categorie_id" required="">
                                            <option value="">Selectionner</option>
                                            @foreach ($categories as $categorie )
                                                <option value="{{ $categorie->id }}" {{$candidat->categorie_id==$categorie->id ? "selected" : '' }} >{{  $categorie->nom }}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>

                                <br>
                                <div class="row float-right ">

                                    <button type="submit" class="btn btn-primary btn btn-lg "> MODIFIER</button>
                                </div>


                            </div>
                        </div>
        </form>


@endsection

