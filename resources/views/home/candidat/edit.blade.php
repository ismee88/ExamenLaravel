@extends('layout.app')
@section('content')

<header>
    <div class="d-flex flex-column flex-md-row align-items-center pb-3 mb-4 border-bottom">
        <h1>Modifier Formation</h1>
        @if (session('message'))
            <div class="alert alert-success mt-3">{{session('message')}}</div>
        @endif

      <nav class="d-inline-flex mt-2 mt-md-0 ms-md-auto">
        <a class="me-3 py-2 text-dark text-decoration-none" href="{{route('home')}}">Accueil</a>
        <a class="me-3 py-2 text-dark text-decoration-none" href="{{route('admin')}}">Ajouter</a>
      </nav>
    </div>
</header>
<main>
    <div class="container p-5" style="background-color: #E1E1E1; border-radius: 2rem;">
        <div class="col-6">
            <div class="row col-11 mt-4">
                <div class="row col-11 mt-4">
                    <form action="{{route('candidat.update',['id'=>$candidat->id])}}" method="post">
                        @csrf
                        @method('PUT')
                        <select name="formation_id[]" class="form-control" multiple required>
                            <option disabled>-----------Formation-----------</option>
                            @foreach ($formations as $f)
                                <option value="{{$f->id}}">{{$f->nom}}</option>
                            @endforeach
                        </select>
                        <input type="text" name="nom" value="{{$candidat->nom}}" class="form-control mt-3" required>
                        <input type="text" name="prenom" value="{{$candidat->prenom}}" class="form-control mt-3" required>
                        <input type="email" name="email" value="{{$candidat->email}}" class="form-control mt-3" required>
                        <input type="number" name="age" value="{{$candidat->age}}" min="15" max="35" class="form-control mt-3" required>
                        <select name="niveauEtude" class="form-control mt-3">
                            <option value="">---------Niveau d'etude---------</option>
                            <option value="Bac"  {{$candidat->niveauEtude == 'Bac' ? 'selected' : ''}}>Bac</option>
                            <option value="Bac + 2" {{$candidat->niveauEtude == 'Bac + 2' ? 'selected' : ''}}>Bac + 2</option>
                            <option value="Bac + 3" {{$candidat->niveauEtude == 'Bac + 3' ? 'selected' : ''}}>Bac + 3</option>
                            <option value="Bac + 5" {{$candidat->niveauEtude == 'Bac + 5' ? 'selected' : ''}}>Bac + 5</option>
                            <option value="Bac + 8" {{$candidat->niveauEtude == 'Bac + 8' ? 'selected' : ''}}>Bac + 8</option>
                        </select>
                        <select name="sexe" class="form-control mt-3">
                            <option value="">---------------Sexe---------------</option>
                            <option value="Homme" {{$candidat->sexe == 'Homme' ? 'selected' : ''}}>Homme</option>
                            <option value="Femme" {{$candidat->sexe == 'Femme' ? 'selected' : ''}}>Femme</option>
                        </select>
                        <button type="submit" class="btn btn-success mt-3">Enregistrer</button>
                    </form>
                </div>        
            </div>
        </div>
    </div>
  </main>
@endsection

  
