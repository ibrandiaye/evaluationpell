@extends('welcome')

@section("css")
<style>
     .card-container {
            margin: 20px auto;

            transition: all 0.3s ease;
        }

        .expandable-card {
            cursor: pointer;
            transition: all 0.3s ease;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        .expandable-card.expanded {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            width: 100%;
            height: 100%;
            z-index: 1050;
            margin: 0;
            border-radius: 0;
            overflow-y: auto;
        }

        .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0,0,0,0.5);
            z-index: 1040;
        }

        .expanded .card-body {
            padding: 2rem;
        }

        .close-btn {
            position: absolute;
            top: 15px;
            right: 15px;
            z-index: 1060;
            display: none;
        }

        .expanded .close-btn {
            display: block;
        }
</style>
@endsection
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="btn-group float-right">
                    <ol class="breadcrumb hide-phone p-0 m-0">
                        <li class="breadcrumb-item"><a href="#">Zoter</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
                <h4 class="page-title">Dashboard</h4>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
    @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
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
    @foreach ($categories as $categorie )

        <div class="col-12">
        <div class="card ">
            <div class="card-header text-center">
                <h6>{{ $categorie->nom }} </h6>

            </div>
                <div class="card-body">

                    <table  class="table table-bordered table-responsive-md table-striped text-center">
                        <thead>
                            <tr>

                                <th>NOM </th>


                                <th>Note /  Grade / Nota</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($categorie->candidats as $candidat)
                            <tr>

                                <td>{{ $candidat->nom}}</td>
                                <td>

                                  @if (auth()->user()->role=="admin")

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
                                    @elseif(auth()->user()->role=="evaluateur")
                                        <!-- Modal -->

                                        @if ($candidat->note)
                                            {{ $candidat->note }} / 10
                                            <button  data-toggle='modal' data-target='#exampleModalform3{{ $candidat->id }}' role='button' class='btn btn-warning' title='Note /  Grade / Nota'><i class='fas fa-edit'></i></button>
                                            <div class="modal fade" id="exampleModalform3{{$candidat->id}}" tabindex="-1" role="dialog">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">{{ $candidat->nom}}</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="{{ route('note.store') }}" method="POST">
                                                        @csrf
                                                    <div class="modal-body">

                                                        <input type="hidden" name="candidat_id" value="{{$candidat->id}}">


                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group no-margin">
                                                                    <label for="field-7" class="control-label">Note /  Grade / Nota</label>
                                                                    <select class="form-control" name="note" required="">
                                                                    <option value="" >Veuillez sélectionner une note / Please select a grade / Por favor, selecione uma nota</option>
                                                                    <option value="1" {{ $candidat->note==1 ? 'selected' : '' }}>1</option>
                                                                    <option value="2" {{ $candidat->note==2 ? 'selected' : '' }}>2</option>
                                                                    <option value="3" {{ $candidat->note==3 ? 'selected' : '' }}>3</option>
                                                                    <option value="4" {{ $candidat->note==4 ? 'selected' : '' }}>4</option>
                                                                    <option value="5" {{ $candidat->note==5 ? 'selected' : '' }}>5</option>
                                                                    <option value="6" {{ $candidat->note==6 ? 'selected' : '' }}>6</option>
                                                                    <option value="7" {{ $candidat->note==7 ? 'selected' : '' }}>7</option>
                                                                    <option value="8" {{ $candidat->note==8 ? 'selected' : '' }}>8</option>
                                                                    <option value="9" {{ $candidat->note==9 ? 'selected' : '' }}>9</option>
                                                                    <option value="10" {{ $candidat->note==10 ? 'selected' : '' }}>10</option>
                                                                </select>
                                                                </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer / Cancel / fechar</button>
                                                        <button type="submint" class="btn btn-primary">ENREGISTRER / SUBMIT / REGISTRAR</button>
                                                    </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        @else
                                        <button  data-toggle='modal' data-target='#exampleModalform3{{ $candidat->id }}' role='button' class='btn btn-warning' title='Note /  Grade / Nota'><i class='fas fa-edit'></i></button>
                                            <div class="modal fade" id="exampleModalform3{{$candidat->id}}" tabindex="-1" role="dialog">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">{{ $candidat->nom}}</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="{{ route('note.store') }}" method="POST">
                                                        @csrf
                                                    <div class="modal-body">

                                                        <input type="hidden" name="candidat_id" value="{{$candidat->id}}">


                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group no-margin">
                                                                    <label for="field-7" class="control-label">Note /  Grade / Nota</label>
                                                                    <select class="form-control" name="note" required="">
                                                                    <option value="" >Veuillez sélectionner une note / Please select a grade / Por favor, selecione uma nota</option>
                                                                    <option value="1" >1</option>
                                                                    <option value="2" >2</option>
                                                                    <option value="3" >3</option>
                                                                    <option value="4" >4</option>
                                                                    <option value="5" >5</option>
                                                                    <option value="6" >6</option>
                                                                    <option value="7" >7</option>
                                                                    <option value="8" >8</option>
                                                                    <option value="9" >9</option>
                                                                    <option value="10" >10</option>
                                                                </select>
                                                                </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer / Cancel / fechar</button>
                                                        <button type="submint" class="btn btn-primary">ENREGISTRER / SUBMIT / REGISTRAR</button>
                                                    </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        @endif

                                    @endif


                                </td>

                            </tr>
                            @endforeach

                        </tbody>
                    </table>

                </div>
        </div>
    </div>

    @endforeach



@endsection

@section("script")

@endsection
