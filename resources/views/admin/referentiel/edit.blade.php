@extends('layout.app')
@section('content')

<header>
    <div class="d-flex flex-column flex-md-row align-items-center pb-3 mb-4 border-bottom">
        <h1>Modifier Referentiel</h1>
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
        <div class="col-md-3">
            <div class="row">
                <div class="col-sm-6"></div>
            </div>
            <div class="row col-11 mt-4">
                <form action="{{route('referentiel.update', ['id'=>$referentiel->id])}}" method="post">
                    @csrf
                    <select name="type_id" class="form-control">
                        @foreach ($types as $type)
                        <option value="{{$type->id}}" {{$referentiel->type_id == $type->id ? 'selected' : ''}}>
                            {{$type->libelle}}
                        </option>
                        @endforeach
                    </select>
                    <input type="text" name="libelle" value="{{$referentiel->libelle}}" class="form-control mt-3" required>
                    <input type="number" name="horaire" value="{{$referentiel->horaire}}" class="form-control mt-3" required>
                    <label class="mt-3 mb-1">Validated</label><br>
                    Oui <input type="radio" name="validated" value="1" {{$referentiel->validated ? 'checked' : ''}}>
                    Non <input type="radio" name="validated" value="0" {{$referentiel->validated ? '' : 'checked'}}><br>
                    <button type="submit" class="btn btn-success mt-3">Enregistrer</button>
                </form>
            </div>
        </div>
    </div>
  </main>
@endsection

  
