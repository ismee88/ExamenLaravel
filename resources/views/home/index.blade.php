@extends('layout.app')
@section('content')

<header>
    <div class="d-flex flex-column flex-md-row align-items-center pb-3 mb-4 border-bottom">
        <h1>Dashboard</h1>
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
    <div class="container">
        <div class="row">
            <div class="row">
                <div class="col-6">
                    <h3>Candidats</h3>
                </div>
                <div class="col offset-4">
                    <a href="{{route('admin')}}" class="btn btn-primary">Ajouter candidat</a>
                </div>
            </div>
            <div class="d-flex flex-column flex-md-row align-items-center pb-3 mb-4 border-bottom"></div>
            <div class="col">
                <table class="table table-striped">
                    <thead>
                        <th>#</th>
                        <th>Nom</th>
                        <th>Prenom</th>
                        <th>Email</th>
                        <th>Age</th>
                        <th>Niveau d'etude</th>
                        <th>Sexe</th>
                        <th>Action</th>
                    </thead>
                    
                    <tbody>
                        @php $i = 1; @endphp
                        @if(count($candidats) > 0)
                        @foreach ($candidats as $candidat)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$candidat->nom}}</td>
                            <td>{{$candidat->prenom}}</td>
                            <td>{{$candidat->email}}</td>
                            <td>{{$candidat->age}}</td>
                            <td>{{$candidat->niveauEtude}}</td>
                            <td>{{$candidat->sexe}}</td>
                            <td>
                                <a href="{{route('candidat.detail', ['id'=>$candidat->id])}}" class="btn btn-sm btn-secondary">Detail</a>
                                <a href="{{route('candidat.edit', ['id'=>$candidat->id])}}" class="btn btn-sm btn-warning">Modifier</a>
                                <a href="{{route('candidat.delete', ['id'=>$candidat->id])}}" class="btn btn-sm btn-danger">Supprimer</a>
                            </td>
                        </tr>
                        @endforeach
                        @else
                            <td colspan="8" class="text-center"><big>Pas de candidat disponible pour le moment !!</big></td>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row mt-5">
            <h3>Répartition des candidats par sexe</h3>
            <div class="d-flex flex-column flex-md-row align-items-center pb-3 mb-4 border-bottom"></div>
            @if(count($stats) > 0)
            @foreach($stats as $stat)
                <div class="col">
                   <big>{{ $stat['sexe'] }} : {{ $stat['count'] }}</big>
                </div>
            @endforeach
            @else
                <p class="text-center"><big>Auncune repartition disponible !!</big></p>
            @endif
        </div>

        <div class="row mt-5">
            <h3>Nombre de candidats par formation</h3>
            <div class="d-flex flex-column flex-md-row align-items-center pb-3 mb-4 border-bottom"></div>
            <div class="col">
                <table class="table table-striped">
                    <thead>
                        <th>Formations</th>
                        <th>Candidats</th>
                    </thead>
                    <tbody>
                        @if(count($formations) > 0)
                        @foreach ($formations as $formation)
                        <tr>
                            <td>{{ $formation->nom }}</td>
                            <td>{{ $formation->candidats_count }}</td>
                        </tr>
                        @endforeach
                        @else
                            <td colspan="2" class="text-center"><big>Aucune formation disponible !!</big></td>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row mt-5">
            <h3>Nombre de formations par referentiel</h3>
            <div class="d-flex flex-column flex-md-row align-items-center pb-3 mb-4 border-bottom"></div>
            <div class="col">
                <table class="table table-striped">
                    <thead>
                        <th>Referentiels</th>
                        <th>Formations</th>
                    </thead>
                    <tbody>
                        @if(count($referentiels) > 0)
                        @foreach ($referentiels as $referentiel)
                            <tr>
                                <td>{{ $referentiel->libelle }}</td>
                                <td>{{ $referentiel->formations_count }}</td>
                            </tr>
                        @endforeach
                        @else
                            <td class="text-center" colspan="2"><big>Aucun referenciel disponible !!</big></td>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row mt-5">
            <h3>Répartition des formations par type</h3>
            <div class="d-flex flex-column flex-md-row align-items-center pb-3 mb-4 border-bottom"></div>
            <div class="col">
                <div class="row">
                    @if(count($results) > 0)
                    @foreach($results as $result)
                        <div class="col-6">
                            <div><big>{{ $result->type }} : {{ $result->nb_formations }} formations</big></div>
                        </div>
                    @endforeach
                    @else
                        <p class="text-center"><big>Auncune repartition disponible !!</big></p>
                    @endif
                </div>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-6">
                <h3>Graphe representant les tranches d'age</h3>
                <div class="d-flex flex-column flex-md-row align-items-center pb-3 mb-4 border-bottom"></div>
                <div class="col">
                    <canvas id="ageGraph"></canvas>
                </div>
            </div>
            <div class="col-6">
                <h3 class="offset-3">Statistique des formations</h3>
                <div class="d-flex flex-column flex-md-row align-items-center pb-3 mb-4 border-bottom"></div>
                <div class="offset-3" style="width:10cm; height:20cm;">
                    <div class="col">
                        <canvas id="formation-chart"></canvas>
                    </div>
                </div>
            </div>
        </div>


        </div>
    </div>
  </main>


<script src="{{asset('js/chart.js')}}"></script>
<!-- Script pour initialiser le graphe -->
<script>
    var tranches_age = <?php echo json_encode($tranches_age); ?>;
    var nb_candidats = <?php echo json_encode($nb_candidats); ?>;

    // Créer un nouveau graphe
    var ctx = document.getElementById('ageGraph').getContext('2d');
    var ageGraph = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: tranches_age,
            datasets: [{
                label: 'Nombre de candidats',
                data: nb_candidats,
                backgroundColor: '#2196F3'
            }]
        },
        options: {
            legend: {
                display: false
            },
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });


    var ctx = document.getElementById('formation-chart').getContext('2d');
    var formationChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ['Formations en attente', 'Formations en cours'],
            datasets: [{
                label: 'Nombre de formations',
                data: [{{$formationsEnAttente}}, {{$formationsEnCours}}],
                backgroundColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            legend: {
            display: true,
            
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
        }
    });


</script>

@endsection

  
