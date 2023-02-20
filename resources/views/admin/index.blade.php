@extends('layout.app')
@section('content')

<header>
    <div class="d-flex flex-column flex-md-row align-items-center pb-3 mb-4 border-bottom">
        <h1>Ajouter</h1>
      <nav class="d-inline-flex mt-2 mt-md-0 ms-md-auto">
        <a class="me-3 py-2 text-dark text-decoration-none" href="{{route('home')}}">Accueil</a>
        <a class="me-3 py-2 text-dark text-decoration-none" href="{{route('admin')}}">Ajouter</a>
      </nav>
    </div>
</header>
<main>
    <div class="container">
        <div class="row p-4" style="background-color: #E1E1E1; border-radius: 2rem;">
            <div class="col-md-3 p-2">
                <div class="row">
                    <div class="col-sm-6">
                        <h3>Candidat</h3>
                    </div>
                    <div class="col-sm-6"></div>
                </div>
                <div class="row col-11 mt-4">
                    <form action="{{route('candidat.store')}}" method="post">
                        @csrf
                        <select name="formation_id[]" class="form-control" multiple>
                            <option disabled>-----------Formation-----------</option>
                            @foreach ($formations as $f)
                                <option value="{{$f->id}}">{{$f->nom}}</option>
                            @endforeach
                        </select>
                        <input type="text" name="nom" placeholder="Nom" class="form-control mt-3" required>
                        <input type="text" name="prenom" placeholder="Prenom" class="form-control mt-3" required>
                        <input type="email" name="email" placeholder="Email" class="form-control mt-3" required>
                        <input type="number" name="age" placeholder="age" min="15" max="35" class="form-control mt-3" required>
                        <select name="niveauEtude" class="form-control mt-3"  required>
                            <option value="">---------Niveau d'etude---------</option>
                            <option value="Bac">Bac</option>
                            <option value="Bac + 2">Bac + 2</option>
                            <option value="Bac + 3">Bac + 3</option>
                            <option value="Bac + 5">Bac + 5</option>
                            <option value="Bac + 8">Bac + 8</option>
                        </select>
                        <select name="sexe" class="form-control mt-3"  required>
                            <option value="">---------------Sexe---------------</option>
                            <option value="Homme">Homme</option>
                            <option value="Femme">Femme</option>
                        </select>
                        <button type="submit" class="btn btn-success mt-3">Enregistrer</button>
                    </form>
                </div>
            </div>

            <div class="col-md-3">
                <div class="row">
                    <div class="col-sm-6">
                        <h3>Formation</h3>
                    </div>
                    <div class="col-sm-6"></div>
                </div>
                <div class="row col-11 mt-4">
                    <form action="{{route('formation.store')}}" method="post">
                        @csrf
                        <select name="referentiel_id[]" class="form-control" multiple required>
                            <option disabled>-----------Referentiel-----------</option>
                            @foreach ($ref as $ref)
                                <option value="{{$ref->id}}">{{$ref->libelle}}</option>
                            @endforeach
                        </select>
                        <input type="text" name="nom" placeholder="Nom" class="form-control mt-3" required>
                        <input type="number" name="duree" placeholder="Duree" class="form-control mt-3" required>
                        <label class="mt-3">Description</label><br> 
                        <textarea name="description" cols="30" rows="3" class="form-control" required></textarea>
                        <label class="mt-3 mb-1">isStarted</label><br>
                        Oui <input type="radio" name="isStarted" value="1" checked>
                        Non <input type="radio" name="isStarted" value="0">
                        <br>
                        <label class="mt-3">Date debut</label><br>
                        <input type="datetime-local" name="date_debut" class="form-control" required>
                        <button type="submit" class="btn btn-success mt-3">Enregistrer</button>
                    </form>
                </div>
            </div>
            
            <div class="col-md-3">
                <div class="row">
                    <div class="col-sm-6">
                        <h3>Referentiel</h3>
                    </div>
                    <div class="col-sm-6"></div>
                </div>
                <div class="row col-11 mt-4">
                    <form action="{{route('referentiel.store')}}" method="post">
                        @csrf
                        <select name="type_id" class="form-control"  required>
                            <option disabled selected>---------------Type---------------</option>
                            @foreach ($types as $type)
                                <option value="{{$type->id}}">{{$type->libelle}}</option>
                            @endforeach
                        </select>
                        <input type="text" name="libelle" placeholder="Libelle" class="form-control mt-3" required>
                        <input type="number" name="horaire" placeholder="Hoiraire" class="form-control mt-3" required>
                        <label class="mt-3 mb-1">Validated</label><br>
                        Oui <input type="radio" name="validated" value="1" checked>
                        Non <input type="radio" name="validated" value="0"><br>
                        <button type="submit" class="btn btn-success mt-3">Enregistrer</button>
                    </form>
                </div>
            </div>

            <div class="col-md-3">
                <div class="row">
                    <div class="col-sm-6">
                        <h3>Type</h3>
                    </div>
                    <div class="col-sm-6"></div>
                </div>
                <div class="row col-11 mt-4">
                    <form action="{{route('type.store')}}" method="post">
                    @csrf
                        <input type="text" name="libelle" placeholder="libelle" class="form-control" required>
                        <button type="submit" class="btn btn-success mt-4">Enregistrer</button>
                    </form>
                </div>
            </div>
        </div>

        
        <div class="d-flex flex-column flex-md-row align-items-center pb-3 mb-4 border-bottom mt-5 mb-5"></div>

        <div class="row">
            <h3>Types</h3>
            <div class="d-flex flex-column flex-md-row align-items-center pb-3 mb-4 border-bottom"></div>
            <div class="col-11">
                <table class="table table-striped">
                    <thead>
                        <th>#</th>
                        <th>Libelle</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        @if (count($types) > 0)
                        @php $i = 1; @endphp
                        @foreach ($types as $type)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$type->libelle}}</td>
                            <td>
                                <a href="{{route('type.delete', ['id'=>$type->id])}}" class="btn btn-sm btn-danger">Supprimer</a>
                            </td>
                        </tr>
                        @endforeach
                        @else
                            <td class="text-center" colspan="3"><big>Aucun type disponible !!</big></td>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>

        <div class="d-flex flex-column flex-md-row align-items-center pb-3 mb-4 border-bottom mt-5 mb-5"></div>

        <div class="row">
            <h3>Referentiels</h3>
            <div class="d-flex flex-column flex-md-row align-items-center pb-3 mb-4 border-bottom"></div>
            <div class="col-11">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Type</th>
                            <th>Libelle</th>
                            <th>Validé</th>
                            <th>Horaire</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($ref1) > 0)
                        @foreach ($ref1 as $r)
                        <tr>
                            <td>{{$r->id}}</td>
                            <td>{{$r->type->libelle}}</td>
                            <td>{{$r->libelle}}</td>
                            <td>
                                @if ($r -> validated == 1)
                                    Oui
                                    @else
                                    Non
                                @endif
                            </td>
                            <td>{{$r->horaire}}</td>
                            <td>
                                <a href="{{route('referentiel.edit', ['id'=>$r->id])}}" class="btn btn-sm btn-warning">Modifier</a>
                                <a href="{{route('referentiel.delete', ['id'=>$r->id])}}" class="btn btn-sm btn-danger">Supprimer</a>
                            </td>
                        </tr>
                        @endforeach
                        @else
                            <td class="text-center" colspan="6"><big>Aucun referentiel disponible !!</big></td>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>

        <div class="d-flex flex-column flex-md-row align-items-center pb-3 mb-4 border-bottom mt-5 mb-5"></div>

        <div class="row">
            <h3>Formations</h3>
            <div class="d-flex flex-column flex-md-row align-items-center pb-3 mb-4 border-bottom"></div>
            <div class="col-11">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nom</th>
                            <th>Duree</th>
                            <th>Description</th>
                            <th>isStarted</th>
                            <th>Date debut</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($formations1) > 0)
                        @foreach ($formations1 as $fr)
                        <tr>
                            <td>{{$fr->id}}</td>
                            <td>{{$fr->nom}}</td>
                            <td>{{$fr->duree}}</td>
                            <td>{{$fr->description}}</td>
                            <td>
                                @if ($fr->isStarted == 1)
                                    Oui
                                    @else
                                    Non
                                @endif
                            </td>
                            <td>{{$fr->date_debut}}</td>
                            <td>
                                <a href="{{route('formation.edit', ['id'=>$fr->id])}}" class="btn btn-sm btn-warning">Modifier</a>
                                <a href="{{route('formation.delete', ['id'=>$fr->id])}}" class="btn btn-sm btn-danger">Supprimer</a>
                            </td>
                        </tr>
                        @endforeach
                        @else
                            <td class="text-center" colspan="7"><big>Aucune formation disponible !!</big></td>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>

    </div>
  </main>

@endsection

  
