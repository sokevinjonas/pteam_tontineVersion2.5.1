<?php

namespace App\Http\Controllers;

use Throwable;
use App\Models\User;
use App\Models\Tontine;
use Illuminate\Http\Request;
use App\Models\Participation;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\TontineRequest;
use App\Http\Requests\User\StoreUserRequest;

class TontineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tontines = Tontine::where('user_id', Auth::user()->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('tontine.tontine', compact('tontines'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tontine.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'number_of_members' => 'required|integer',
                'name' => 'required|string',
                'profit' => 'required|string',
                'amount' => 'required|integer',
                'amount_payer' => 'required|integer',
                'delay' => 'required|string',
                'periode' => 'required|string',
                'date_debut' => 'required|date',
                'date_fin' => 'required|date',
                'description' => 'nullable|string'
            ]);
            $tontine = new Tontine();
            $tontine->number_of_members = $validatedData['number_of_members'];
            $tontine->user_id = auth()->user()->id;
            $tontine->status = 'inactif';
            $tontine->name = $validatedData['name'];
            $tontine->profit = $validatedData['profit'];
            $tontine->amount = $validatedData['amount'];
            $tontine->amount_payer = $validatedData['amount_payer'];
            $tontine->delay = $validatedData['delay'];
            $tontine->periode = $validatedData['periode'];
            $tontine->date_debut = $validatedData['date_debut'];
            $tontine->date_fin = $validatedData['date_fin'];
            $tontine->description = $validatedData['description'];
            $tontine->save();
            // dd($tontine);
            sweetalert()->addSuccess('La tontine a été crée avec success !!');
            return redirect()->back();
            // return response()->json(['message' => 'Enregistrement créé avec succès'], 200);

        } catch (\Exception $e) {
            dd($e);
            // return response()->json(['error' => 'Erreur de validation des données'], 422);

        }
        // $data = $request->validated();


        // $data['user_id'] = 
        // $data['status'] = 'inactif';


        // Tontine::create($data);

        // sweetalert()->addSuccess('Une tontine a été créée !');

        // return redirect()->route('tontine.index');

    }


    public function start(Tontine $tontine)
    {

        if ($tontine->isStart()) {

            sweetalert()->addError('La tontine à déja debuté !!');
        } else {
            $tontine->update([
                'status' => 'actif',
                'started_at' => now()
            ]);

            sweetalert()->addSuccess('La tontine débute maintenant !!');
        }

        return back();
    }

    public function addParticipant(StoreUserRequest $request, Tontine $tontine)
    {
        $data = $request->validated();
        $nbBras = $data['nombre_bras'];


        /*
         *   Si le nombre de bras n'est pas envoyé ou a une valeur égale à zero (0)
         */
        if ($nbBras == null or $nbBras == 0) {
            $errorMessage = 'Le nombre de bras doit être comprit entre 1 et ' . $tontine->number_of_members;

            sweetalert()->addError($errorMessage);

            return redirect()->back();
        }


        /*
         * Si avec l'ajout de ce participant le nombre participant est dépasser
         */
        if ($tontine->hasFull($nbBras)) {
            sweetalert()->addError('Le participant occupe trop de place');
            return redirect()->back();
        }

        // Récupère les données de l'utilisateur connecté
        $userAuth = auth()->user();

        // Si des images sont envoyer
        if (
            array_key_exists('identity_document_front', $data)
            and
            array_key_exists('identity_document_back', $data)
        ) {

            $identity_document_front = $data['identity_document_front'];
            $identity_document_back = $data['identity_document_back'];

            $participant = User::create(array_merge($data, [
                'role' => 'participant',
                'identity_document_front' => ' ',
                'identity_document_back' => ' ',
                'user_id' => $userAuth->id
            ]));


            // Si les images envoyé non pas de problème
            if (
                $identity_document_front != null && !$identity_document_front->getError()
                and
                $identity_document_back != null && !$identity_document_back->getError()
            ) {
                $identity_document_front_path = $identity_document_front->store($participant->id, 'public');
                $identity_document_back_path = $identity_document_back->store($participant->id, 'public');

                $participant->update([
                    'identity_document_front' => $identity_document_front_path,
                    'identity_document_back' => $identity_document_back_path,
                ]);

                sweetalert()->addSuccess('Nouveau participant créé !');
            } else {
                // message d'erreur
                sweetalert()->addError('Images non conforme');
            }
        } else {

            $participant = User::create(array_merge($data, [
                'role' => 'participant',
                'user_id' => $userAuth->id
            ]));

            sweetalert()->addSuccess('Nouveau participant créé !');
        }


        $tontine->participation()->create([
            'user_id' => $participant->id,
            'tontine_id' => $tontine->id,
            'nombre_bras' => $data['nombre_bras'],
            'rank' => $tontine->participationRank()
        ]);

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Tontine $tontine)
    {

        // Récupère les prises suivantes de la tontine
        $prises = $tontine->PrisesSuivantes();
        $participation = Participation::orderBy('rank', 'asc')->where('tontine_id', $tontine->id)
            ->get();
        // dd($prises);
        // Retourne la vue avec la tontine et les prises suivantes
        return view('tontine.detail', compact('participation', 'tontine', 'prises'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tontine $tontine)
    {
        return view('');
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tontine $tontine)
    {
        $tontine->update($request->all());

        return to_route('');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tontine $tontine)
    {
        $tontine->delete();

        return to_route('tontine.index');
    }

    public function rechercheParticipant(Request $request)
    {
        // Vérifiez si l'utilisateur actuel a le rôle "participant"
        if (auth()->user()->role !== 'organizer') {
            return response()->json(['resultats' => []]);
        } else {
            $term = $request->input('term'); // Récupérez le terme de recherche

            // Séparez le terme de recherche en last_name et first_name
            $termParts = explode(' ', $term);
            $last_name = $termParts[0];
            $first_name = count($termParts) > 1 ? $termParts[1] : '';

            // Requête pour récupérer les utilisateurs avec le rôle "participant" et qui correspondent aux critères de recherche
            $resultats = User::where('role', '=', 'participant')
                ->where(function ($query) use ($last_name, $first_name) {
                    $query->where('last_name', 'LIKE', "%{$last_name}%")
                        ->where('first_name', 'LIKE', "%{$first_name}%");
                })

                ->orWhere('phone_number', 'LIKE', "%{$term}%")
                ->get();

            // Retournez les résultats en format JSON
            return response()->json(['resultats' => $resultats]);
        }
    }


    public function ajaxnewParticipant(Request $request)
    {
        $userId = $request->input('user_id');
        $tontineId = $request->input('tontine_id');
        $tontine = Tontine::find($tontineId);
        // Assurez-vous que $tontineId contient une valeur valide
        if ($tontineId) {
            // Exemple de validation côté serveur (dans votre contrôleur)
            if (!Participation::where('user_id', $userId)->where('tontine_id', $tontineId)->exists()) {
                // Créez la nouvelle participation uniquement si elle n'existe pas déjà
                Participation::create([
                    'user_id' => $userId,
                    'tontine_id' => $tontineId,
                    'nombre_bras' => 1,
                    'rank' => $tontine->participationRank() // Assurez-vous d'avoir l'objet $tontine disponible ici
                    // Autres champs
                ]);

                // Message flash pour indiquer que la participation a été ajoutée avec succès
                sweetalert()->addSuccess('Nouveau participant créé !');

                // return response()->json(['msg' => true, 'message' => 'Participation ajoutée avec succès']);
            } else {
                // Message flash si la participation existe déjà
                sweetalert()->addWarning('Cet participant existe déjà.');
                // return response()->json(['msg' => false, 'message' => 'Cet participant existe déjà.']);
            }
        } else {
            // Si $tontineId est vide, il y a un problème avec la récupération de l'ID de la tontine
            // return response()->json(['msg' => false, 'message' => 'ID de la tontine invalide.']);
            sweetalert()->addWarning('Une erreur est survenu lors de l\enregistrement');

        }
    }

}