<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Système de Note en Ligne</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome pour les icônes -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            padding-top: 20px;
        }
        .header {
            background-color: #ffffff;
            color: black;
            padding: 20px 0;
            margin-bottom: 30px;
            border-radius: 5px;
        }
        .candidate-card {
            transition: transform 0.3s;
            margin-bottom: 20px;
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .candidate-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0,0,0,0.15);
        }
        .candidate-img {
            height: 200px;
            object-fit: cover;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }
        .category-badge {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 0.8rem;
        }
        .btn-note {
            background-color: #28a745;
            color: white;
            font-weight: bold;
        }
        .btn-note:hover {
            background-color: #218838;
        }
        .note-count {
            font-size: 1.2rem;
            font-weight: bold;
            color: #343a40;
        }
    </style>
    <link href=" {{ asset('assets/plugins/select2/select2.min.css') }} " rel="stylesheet" type="text/css" />
</head>
<body>
    <div class="container">
        <div class="header text-center">
            <div class="row">
                <div class="col-md-4">
                    <img src="photo/ua.png" height="60">
                </div>
                 <div class="col-md-4">
                    <img src="photo/oidp.png" height="60">
                </div>
                 <div class="col-md-4">
                    <img src="photo/uc.png" height="60">
                </div>
            </div>
            <h1><i class="fas fa-note-yea me-2"></i>Plateforme de Note PELL</h1>
            <p class="lead">Notez pour votre candidat préféré</p>
        </div>
            <div class="row">
                <!-- Filtres -->
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
                @if ($errors->has('error'))
                    <div class="alert alert-danger">
                        {!!  $errors->first('error') !!}
                    </div>
                @endif
            </div>
            <div class="row">
                <div class="col-md-12">
                     <div class="card">
                        <div class="card-body">


                            <form method="POST" action="{{ route('candidatByCategorie') }}">
                                <div class="mb-3">
                                    @csrf
                                    <select class="form-select select2" id="categoryFilter" name="categorie_id">
                                        <option value="all">Toutes les catégories</option>
                                        @foreach($categories as $key => $categorie)
                                            <option value="{{ $categorie->id }}" {{ $categorie_id==$categorie->id ? 'selected' : '' }} >{{ $categorie->nom }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary w-100">Appliquer</button>

                            </form>
                        </div>
                     </div>
                </div>
            </div>
            <div class="row">

            <div class="col-md-3 mb-4">
                 <!-- Compteur de notes -->
                <div class="card mt-4">
                    <div class="card-body text-center">
                        <h5><i class="fas fa-chart-bar me-2"></i>Statistiques</h5>
                        <p class="note-count">Total notes:
                            @php
                                $total = 0;
                                 foreach ( $candidats as $candidat )
                                 {
                                    $total += $candidat->notes;

                                 }
                                 echo $total;
                            @endphp
                        </p>
                        <p>Temps restant: 2j 5h 30m</p>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><i class="fas fa-filter me-2"></i>Filtres</h5>

                        <form method="POST" action="{{ route('candidatByCategorie') }}">
                            <div class="mb-3">
                                <label for="categoryFilter" class="form-label">Catégorie</label>
                                @csrf
                                <select class="form-select select2" id="categoryFilter" name="categorie_id">
                                    <option value="all">Toutes les catégories</option>
                                    @foreach($categories as $key => $categorie)
                                        <option value="{{ $categorie->id }}"><p>{{ $categorie->nom }}</p></option>
                                    @endforeach
                                </select>
                            </div>
                             <button type="submit" class="btn btn-primary w-100">Appliquer</button>

                        </form>

                        <div class="mb-3">
                            <label for="searchFilter" class="form-label">Recherche</label>
                            <input type="text" class="form-control" id="searchFilter" placeholder="Nom du candidat...">
                        </div>
                       {{--  <ul>
                             @foreach($categories as $key => $categorie)
                                <li style="font-size: 13px;">{{ $categorie->nom }}</li>
                            @endforeach
                        </ul> --}}

                    </div>
                </div>


            </div>

            <!-- Liste des candidats -->

            <div class="col-md-9">
                <div class="row" id="candidatesList">
                    @foreach ( $candidats as $candidat )
                         <!-- Candidat 1 -->
                    <div class="col-lg-4 col-md-6">
                        <div class="card candidate-card">
                            <div class="card-header">

                            </div>
                            <img src="{{ asset('photo/'.$candidat->image) }}" class="card-img-top candidate-img" alt="Candidat 1">
                            <div class="card-body">
                                <h5 class="card-title">{{ $candidat->nom }}</h5>
                                 <p class="card-text " style="font-size: 10px;">{{ $candidat->categorie->nom }}</p>

                                <p class="card-text">{{ $candidat->description }}.</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="text-muted">Notes: {{ $candidat->notes }}</span>
                                    <form action="{{ route('store.note') }}" method="POST">
                                        @csrf
                                        <input value="{{ $candidat->id }}" name="candidat_id" type="hidden">
                                        <input value="{{ $candidat->categorie->id }}" name="categorie_id" type="hidden">
                                        <button class="btn btn-note">Noter <i class="fas fa-check ms-1"></i></button>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach



                </div>

                <!-- Pagination -->
                {{-- <nav aria-label="Page navigation" class="mt-4">
                    <ul class="pagination justify-content-center">
                        <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Précédent</a>
                        </li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#">Suivant</a>
                        </li>
                    </ul>
                </nav> --}}
            </div>
        </div>
    </div>
        @if($showSocialPopup ?? false)
        <!-- Modal forcé -->
        <div class="modal fade" id="socialPopup" tabindex="-1" aria-hidden="true"
            data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content text-center p-3">
            <div class="modal-header">
                <h5 class="modal-title">🙏 Merci de votre visite</h5>
            </div>
            <div class="modal-body">
                <p>Veuillez aimer au moins une de nos pages avant de continuer :</p>
                <div class="d-flex justify-content-center gap-3">
                <a href="https://www.facebook.com/ecopop.enda" target="_blank" class="btn btn-primary social-btn">Facebook</a>
                <a href="https://www.instagram.com/enda.ecopop/" target="_blank" class="btn btn-danger social-btn">Instagram</a>
                <a href="https://x.com/endaECOPOP" target="_blank" class="btn btn-dark social-btn">Twitter</a>
                </div>
                <small class="text-muted d-block mt-3">Cliquez sur au moins un bouton pour débloquer le site.</small>
            </div>
            <div class="modal-footer">
                <button id="btn-continue" type="button" class="btn btn-success" disabled>Continuer</button>
            </div>
            </div>
        </div>
        </div>
        @endif


    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-3 mt-5">
        <div class="container">
            <p class="mb-0">© 2023 Système de Note en Ligne. Tous droits réservés (OIDP AFRIQUE).</p>

        </div>
    </footer>

    <!-- Bootstrap JS et dépendances -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script src="{{ asset('assets/js/jquery.min.js') }} "></script>
    <script src=" {{ asset('assets/plugins/select2/select2.min.js') }} " type="text/javascript"></script>
    <script src=" {{ asset('assets/pages/form-advanced.js') }} " type="text/javascript"></script>
    <script>
        // Script simple pour le filtrage (à adapter selon les besoins)
        document.getElementById('categoryFilter').addEventListener('change', function() {
            const category = this.value;
            const cards = document.querySelectorAll('.candidate-card');

            cards.forEach(card => {
                const cardCategory = card.querySelector('.category-badge').textContent.toLowerCase();
                if (category === 'all' || cardCategory.includes(category.toLowerCase())) {
                    card.parentElement.style.display = 'block';
                } else {
                    card.parentElement.style.display = 'none';
                }
            });
        });

        // Script pour la recherche (basique)
        document.getElementById('searchFilter').addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            const cards = document.querySelectorAll('.candidate-card');

            cards.forEach(card => {
                const name = card.querySelector('.card-title').textContent.toLowerCase();
                const description = card.querySelector('.card-text').textContent.toLowerCase();

                if (name.includes(searchTerm) || description.includes(searchTerm)) {
                    card.parentElement.style.display = 'block';
                } else {
                    card.parentElement.style.display = 'none';
                }
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function() {
    @if($showSocialPopup ?? false)
        let popup = new bootstrap.Modal(document.getElementById('socialPopup'));
        popup.show();

        let continueBtn = document.getElementById("btn-continue");
        let clicked = false;

        document.querySelectorAll(".social-btn").forEach(btn => {
            btn.addEventListener("click", function() {
                if (!clicked) {
                    clicked = true;
                    continueBtn.disabled = false; // bouton activé
                }
            });
        });

        continueBtn.addEventListener("click", function() {
            if (clicked) {
                // Enregistre que l’utilisateur a déjà passé le popup
                fetch("{{ route('social.popup.seen') }}", {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify({})
                });
                popup.hide();
            }
        });
    @endif
});
</script>

</body>
</html>
