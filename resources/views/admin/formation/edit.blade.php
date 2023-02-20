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
                    <form action="{{route('formation.update', ['id'=>$formation->id])}}" method="post">
                        @csrf
                        @method('PUT')
                        <select name="referentiel_id[]" class="form-control" multiple required>
                            <option disabled>-----------Referentiel-----------</option>
                            @foreach ($ref as $ref)
                                <option value="{{$ref->id}}">{{$ref->libelle}}</option>
                            @endforeach
                        </select>
                        <input type="text" name="nom" value="{{$formation->nom}}" class="form-control mt-3" required>
                        <input type="number" name="duree" value="{{$formation->duree}}" class="form-control mt-3" required>
                        <label class="mt-3">Description</label><br> 
                        <textarea name="description" cols="30" rows="3" class="form-control" required>{{$formation->description}}</textarea>
                        <label class="mt-3 mb-1">isStarted</label><br>
                        Oui <input type="radio" name="isStarted" value="1" {{$formation->isStarted ? 'checked' : ''}}>
                        Non <input type="radio" name="isStarted" value="0" {{$formation->isStarted ? '' : 'checked'}}>
                        <br>
                        <label class="mt-3">Date debut</label><br>
                        <input type="datetime-local" name="date_debut" value="{{$formation->date_debut}}" class="form-control" required>
                        <button type="submit" class="btn btn-success mt-3">Enregistrer</button>
                    </form>
                </div>        
            </div>
        </div>
    </div>
  </main>
@endsection

  
