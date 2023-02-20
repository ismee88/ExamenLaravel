@extends('layout.app')
@section('content')

<header>
    <div class="d-flex flex-column flex-md-row align-items-center pb-3 mb-4 border-bottom">
        <h1>{{$candidat->prenom}} {{$candidat->nom}}</h1>
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
    <div class="container" style="background-color: #E1E1E1; border-radius: 2rem;">
        <div class="row">
            <div class="col-6 mt-1">
                <p><h5>Nom : {{$candidat->nom}}</h5></p>
                <p><h5>Prenom : {{$candidat->prenom}}</h5></p>
                <p><h5>Email : {{$candidat->email}}</h5></p>
                <p><h5>Age : {{$candidat->age}} ans</h5></p>
                <p><h5>Niveau d'etude : {{$candidat->niveauEtude}}</h5></p>
                <p><h5>Sexe : {{$candidat->sexe}}</h5></p>
                <p><h5>Formation : </h5></p>
                <ul>
                    @foreach ($formations as $formation)
                        <li><big>{{$formation->nom}}</big></li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
  </main>
@endsection

  
