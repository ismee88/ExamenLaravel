<?php

namespace App\Http\Controllers;

use App\Models\Candidat;
use App\Models\Formation;
use App\Models\Referentiel;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CandidatController extends Controller
{
    public function index(){
        $types = Type::all();
        $ref = Referentiel::all();
        $ref1 = Referentiel::all();
        $formations = Formation::all();
        $formations1 = Formation::all();
        return view('admin.index',compact('types', 'ref', 'ref1', 'formations', 'formations1'));
    }

    public function home(){
        $candidats = Candidat::all();

        //nombre de candidat par formation
        $formations = Formation::withCount('candidats')->get();

        //nombre de formation par referentiel
        $referentiels = Referentiel::withCount('formations')->get();

        //repartion sexe
        $stats = Candidat::countBySexe();


        /****************************************Fomation par type******************************************************/
        
        $results = DB::select('SELECT t.libelle AS type, COUNT(DISTINCT f.id) AS nb_formations
                       FROM types t
                       JOIN referentiels r ON r.type_id = t.id
                       JOIN formation_referentiel fr ON fr.referentiel_id = r.id
                       JOIN formations f ON f.id = fr.formation_id
                       GROUP BY t.libelle');

                
        
        /***************************************Graphe age*******************************************************************/
        $candt = Candidat::all();
        // Initialiser les variables qui contiendront les données pour le graphe
        $tranches_age = ['15-24', '25-29', '30-34', '35-39'];
        $nb_candidats = [0, 0, 0, 0, 0];

        // Parcourir les candidats pour déterminer leur tranche d'âge
        foreach ($candt as $candt) {
            $age = $candt->age;
            if ($age >= 15 && $age <= 24) {
                $nb_candidats[0]++;
            } elseif ($age >= 25 && $age <= 29) {
                $nb_candidats[1]++;
            } elseif ($age >= 30 && $age <= 34) {
                $nb_candidats[2]++;
            } elseif ($age >= 35 && $age <= 39) {
                $nb_candidats[3]++;
            } 
        }

        /********************************************************graphe formation*************************************************************/
        $formationsEnCours = Formation::where('isStarted', '1')->count();
        $formationsEnAttente = Formation::where('isStarted', '0')->count();


        //return vue
        return view('home.index', ['candidats'=>$candidats, 'referentiels'=>$referentiels,'formations'=>$formations, 
        'stats'=>$stats, 'tranches_age'=>$tranches_age, 'nb_candidats'=>$nb_candidats, 'formationsEnCours'=>$formationsEnCours, 
        'formationsEnAttente'=>$formationsEnAttente, 'results'=>$results]);
    }


    /********************************************************Type***********************************************************************/
    //Ajouter type
    public function typeStore(Request $request){
        $input = $request->all();
        Type::create($input);
        return redirect('admin');
    }

    //Supprimer type
    public function deleteType($id){
        $type = Type::FindOrFail($id);
        $type -> delete();
        return redirect('admin');
    }


    /******************************************************Referentiel******************************************************************************/
    //Ajouter referentiel
    public function referentielStore(Request $request){
        $type = Type::findOrFail($request->type_id);
      
        $ref = new Referentiel();

        $ref->libelle = $request->libelle;
        $ref->validated = $request->validated;
        $ref->horaire = $request->horaire;

        $type->referentiels()->save($ref);

        return redirect('admin')->with('message', 'Referentiel ajouter');
    }

    //Modifier referentiel
    public function editReferentiel($id){
        $referentiel = Referentiel::FindOrFail($id);
        $types = Type::all();
        return view('admin.referentiel.edit', ['referentiel'=>$referentiel, 'types'=>$types]);
    }

    //MAJ referentiel
    public function referentielUpdate(Request $request, $ref_id){
        $type = Type::find($request->type_id);
        $type->referentiels()->where('id', $ref_id)->update([
           'libelle' => $request->libelle,
           'validated' => $request->validated,
           'horaire' => $request->horaire,
        ]);
     
        return redirect('admin');
       }

    //Supprimer referentiel
    public function deleteReferentiel($id){
        $ref = Referentiel::FindOrFail($id);
        $ref -> delete();
        return redirect('admin');
    }

    /****************************************************************Formation**************************************************************************/
    //Ajouter formation
    public function formmationStore(Request $request){
        $formation = Formation::create($request->all());
        $formation->referentiels()->attach($request->input('referentiel_id'));
        return redirect('admin');
    }

    //Modifier formation
    public function editFormation($id){
        $formation = Formation::findOrFail($id);
        //dd($formation);
        $ref = Referentiel::all();
        return view('admin.formation.edit', ['formation'=>$formation, 'ref'=>$ref]);
    }

    //MAJ formation
    public function formationUpdate(Request $request, $id){
        $formation = Formation::findOrFail($id);
        //dd($request);
        $formation->nom = $request->input('nom');
        $formation->duree = $request->input('duree');
        $formation->description = $request->input('description');
        $formation->isStarted = $request->input('isStarted');
        $formation->date_debut = $request->input('date_debut');
        $formation->referentiels()->sync($request->input('referentiel_id'));
        $formation->save();
        return redirect('admin');
    }

    //Supprimer formation
    public function deleteFormation($id){
        $formation = Formation::FindOrFail($id);
        $formation -> delete();
        return redirect('admin');
    }


    /****************************************************************Candidat*******************************************************************************/
    //Ajouter candidat
    public function candidatStore(Request $request){
        $candidat = Candidat::create($request->all());
        $candidat->formations()->attach($request->input('formation_id'));
        return redirect('admin')->with('message', 'Candidat ajouter');
    }

    //Detail candidat
    public function detailCandidat($id){
        $candidat = Candidat::findOrFail($id);
        $formations = $candidat->formations;
        return view('home.detail', ['candidat'=>$candidat, 'formations'=>$formations]);
    }

    //Modifier candidat
    public function editCandidat($id){
        $candidat = Candidat::findOrFail($id);
        //dd($formation);
        $formations = Formation::all();
        return view('home.candidat.edit', ['candidat'=>$candidat, 'formations'=>$formations]);
    }

    //MAJ candidat
    public function candidatUpdate(Request $request, $id){
        $candidat = Candidat::findOrFail($id);
        $candidat->nom = $request->input('nom');
        $candidat->prenom = $request->input('prenom');
        $candidat->email = $request->input('email');
        $candidat->age = $request->input('age');
        $candidat->niveauEtude = $request->input('niveauEtude');
        $candidat->sexe = $request->input('sexe');
        $candidat->formations()->sync($request->input('formation_id'));
        $candidat->save();
        return redirect('home');
    }

    //Supprimer formation
    public function deleteCandidat($id){
        $candidat = Candidat::FindOrFail($id);
        $candidat -> delete();
        return redirect('home');
    }
}
