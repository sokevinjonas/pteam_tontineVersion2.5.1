<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Tontine;
use Illuminate\Http\Request;
use App\Models\Participation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\User\StoreUserRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userAuth = auth()->user();

        if ($userAuth->role == 'organizer') {

            $users = User::where('user_id', $userAuth->id)
                ->orderBy('created_at', 'desc')
                ->get();
            return view('user.index', compact('users'));
        } else {
            // Affiche des organisateurs ou des administrateurs
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $data = $request->validated();

        $userAuth = auth()->user();

        if ($userAuth->role == 'organizer') {
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

                User::create(array_merge($data, [
                    'role' => 'participant',
                    'user_id' => $userAuth->id,
                ]));

                sweetalert()->addSuccess('Nouveau participant créé !');
            }


            return redirect()->back();
        } else {
            // creation des organisateurs et des administrateurs
        }
    }
    
    public function update_password(Request $request)
    {
        try {
            $request->validate([
                'old_password' => 'required',
                'new_password' => 'required|string|min:6|confirmed',
                'new_password_confirmation' => 'required|string|min:6',
            ]);
        
            $user = Auth::user();
        
            if (Hash::check($request->old_password, $user->password)) {
                if ($request->new_password === $request->new_password_confirmation) {
                    $user->password = Hash::make($request->new_password);
                    // dd($user);
                    $user->save();
                    return redirect()->back()->with('success', 'Mot de passe mis à jour avec succès.');
                } else {
                    echo"La confirmation du nouveau mot de passe ne correspond pas.";
                    // return redirect()->back()->withErrors(['new_password_confirmation' => 'La confirmation du nouveau mot de passe ne correspond pas.'])->withInput();
                }
            } else {
                    echo"Ancien mot de passe incorrect.";
                // return redirect()->back()->withErrors(['old_password' => 'Ancien mot de passe incorrect.'])->withInput();
            }
        } catch (\Exception $e) {
            dd($e);
        }

    }
    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {

    }





    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    // public function destroy(User $user)
    // {
    //     $user->delete();

    //     sweetalert()->addSuccess('Participant supprimée !');

    //     return back();
    // }
}