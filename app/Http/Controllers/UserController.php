<?php

namespace App\Http\Controllers;
use App\Models\Citizen;
use App\Models\User;
use Illuminate\Support\Str;
use App\Helpers\ImageHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;

use App\Http\Requests\ProfilePictureStoreRequest;
;

class UserController extends Controller
{
    //

    public function index(Request $request)
    {


        $users = User::orderBy('created_at', 'desc')->get();
        return view('back.pages.users.index', compact('users'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)

    {
        $roles = Role::orderBy('name', 'asc')->get();
        $citizen=Citizen::where('npi',$request->npi)->first();
        if (auth()->user()->hasAnyRole(['manager', 'maire'])) {
            return view('back.pages.users.create', compact('roles','citizen'));
        } else {
            abort(404);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserStoreRequest $request)
     {
        // Generate random password for user
        // Create user
        // dd($request);
        $citizen=Citizen::where('npi',$request->npi)->first();
        if ($citizen->user) {
            // Retournez une erreur ou un message indiquant que le NPI est déjà associé à un compte utilisateur
            $message = "Le NPI fourni est déjà associé à un compte utilisateur.";
            return redirect()->back()->withErrors(['npi' => $message])->withInput();
        }
        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'citizen_id'=>$citizen->id,
        ]);
            // Assign role for user
        $user->assignRole($request->role);
        $message = "Vous venez d'ajouter avec succès l'utilisateur  !";

        return redirect()->route('users.index')->with(['success' => $message]);

    }
    public function edit($email)
    {
        $user = User::where('email', $email)->firstOrFail();
        $roles = Role::orderBy('name', 'asc')->get();
        return view('back.pages.users.edit', compact('roles', 'user'));
    }

    public function update(UserUpdateRequest $request, $email)
    {
        $citizen=Citizen::where('npi',$request->npi)->first();
        $user = User::where('email', $email)->firstOrFail();
        $user->update([
            'email' => $request->email,
        ]);

        $user->syncRoles([$request->role]);
        $message = "Vous venez de modifier avec succès l'utilisateur   !";
        return redirect()->route('users.index')->with(['success' => $message]);
    }

    public function show($email)
    {
        // Logic to show a specific user
    }


    public function destroy($email)
    {
     $user = User::where('email', $email)->first();
     if($user){
         $user->update(['status'=>false]);
         $user->delete();
      }
        $message = "Vous venez de supprimer  l'utilisateur $user->username !";
        return redirect()->route('users.index')->with(['warning' => $message]);
    }
    public function search(Request $request)
    {


    // Recherche en utilisant les relations avec 'citizen' et 'roles'
    $query = $request->get('query');

    $users = User::whereHas('citizen', function($q) use ($query) {
                    $q->where('npi', 'LIKE', "%{$query}%");
                })
                ->orWhere('email', 'LIKE', "%{$query}%")
                ->with(['citizen', 'roles'])
                ->withTrashed()
                ->get();

    return response()->json($users);

    }

}

