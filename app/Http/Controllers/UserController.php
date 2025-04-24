<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;
use App\Models\User;
use App\Models\City;
use App\Models\Review;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Models\Permission;
use App\Helpers\BackHelper;
use App\Http\Requests\StoreUserRequest;
use App\Mail\UserCreated;

class UserController extends Controller
{

    public function __construct() {

        if (!auth()->user()->hasAnyRole(['super admin','manager','dev'])) {
            // Si l'utilisateur n'a pas le rôle requis, lancer une exception ou une erreur
            abort(401);
        }

        $this->var = 'valeur'; // Exemple de variable à initialiser

     }
        public function index(Request $request)
        {
            // Récupérer tous les rôles
            $roles = Role::all();
            if (auth()->user()->hasRole('manager')) {

                $auth_user = auth()->user();
                $auth_country_id = $auth_user->city->country->id ?? null;

                // Récupérer tous les utilisateurs ou filtrer par rôle et statut
                $users = User::when($request->role, function ($query) use ($request) {
                        return $query->whereHas('roles', function ($query) use ($request) {
                            $query->where('name', $request->role);
                        });
                    })
                    ->when($request->status !== null, function ($query) use ($request) {
                        return $query->where('status', $request->status); // 1 pour actif, 0 pour inactif
                    })
                    ->whereHas('city.country', function ($q) use ($auth_country_id) {
                        $q->where('id', $auth_country_id);
                    })
                    ->paginate(20);
            }else {
                $selectedCountry = session('selected_country', 'benin'); // Par défaut 'benin' si rien n'est sélectionné

                // Récupérer l'ID du pays basé sur le pays sélectionné
                $countryName = BackHelper::getCountryByName($selectedCountry);
                $countryid =$countryName->id;

                $users = User::when($request->role, function ($query) use ($request) {
                    return $query->whereHas('roles', function ($query) use ($request) {
                        $query->where('name', $request->role);
                    });
                })
                ->when($request->status !== null, function ($query) use ($request) {
                    return $query->where('status', $request->status); // 1 pour actif, 0 pour inactif
                })
                ->whereHas('city.country', function ($q) use ($countryid) {
                    $q->where('id', $countryid);
                })
                ->paginate(20);
            }

            return view('back.pages.users.index', compact('users', 'roles'));
        }

        public function filter(Request $request)
        {
            $request->validate([
                'role' => 'nullable|string',
                'status' => 'nullable|boolean',
            ]);

            // Commencez par la requête de base
            $query = User::query();


            if (auth()->user()->hasRole('manager')) {

                $auth_user = auth()->user();
                $auth_country_id = $auth_user->city->country->id ?? null;

                // Appliquez le filtre par rôle si un rôle est sélectionné
                if ($request->role) {
                    $query->whereHas('roles', function ($query) use ($request) {
                        $query->where('name', $request->role);
                    });
                }
                // dd($request->status);
                // Appliquez le filtre par statut si un statut est sélectionné
                if ($request->status != null) {
                    $query->where('status', $request->status);
                }

                $query->whereHas('city.country', function ($q) use ($auth_country_id) {
                    $q->where('id', $auth_country_id);
                });
            }else{

                $selectedCountry = session('selected_country', 'benin'); // Par défaut 'benin' si rien n'est sélectionné

                // Récupérer l'ID du pays basé sur le pays sélectionné
                $countryName = BackHelper::getCountryByName($selectedCountry);
                $countryid =$countryName->id;

                // Appliquez le filtre par rôle si un rôle est sélectionné
                if ($request->role) {
                    $query->whereHas('roles', function ($query) use ($request) {
                        $query->where('name', $request->role);
                    });
                }

                if ($request->status != null) {
                    $query->where('status', $request->status);
                }

                $query->whereHas('city.country', function ($q) use ($countryid) {
                    $q->where('id', $countryid);
                });

            }

                // Récupérer les utilisateurs avec les filtres appliqués
                $users = $query->get();

                // Vérifiez si des utilisateurs ont été trouvés
                if ($users->isEmpty()) {
                    return response()->json(['message' => 'Aucun utilisateur trouvé avec ces filtres.'], 404);
                }

            // Retourner la vue partielle avec les utilisateurs
            return response()->json([
                'html' => view('back.pages.users.table', compact('users'))->render(),
            ]);
        }

        public function create()
        {
            $roles = Role::whereNotIn('name', ['developer', 'driver', 'passenger'])->get();

            if (auth()->user()->hasRole('manager')) {

                $auth_user = auth()->user();
                $auth_country_id = $auth_user->city->country->id ?? null;

                $cities = City::where('country_id',$auth_country_id)->get();
            }else {
                $selectedCountry = session('selected_country', 'benin'); // Par défaut 'benin' si rien n'est sélectionné

                // Récupérer l'ID du pays basé sur le pays sélectionné
                $countryName = BackHelper::getCountryByName($selectedCountry);
                $countryid =$countryName->id;
                $cities = City::where('country_id',$countryid)->get();

            }
            return view('back.pages.users.create', compact('roles', 'cities'));
        }

        public function store(StoreUserRequest $request)
        {
            $password = Str::random(10);

            $user = User::create([
                'firstname' => $request->firstname,
                'lastname'  => $request->lastname,
                'email'     => $request->email.'@wononvi.com',
                'phone'     => $request->phone,
                'gender'    => $request->gender,
                'city_id'    => $request->city,
                'npi'       => $request->npi,
                'is_verified' => true,
                'email_verified_at' => now(),
                'password'  => Hash::make($password),
            ]);

            $roleName = Role::where('name', $request->role)->first()->role;

            Profile::create([
                'avatar' => BackHelper::getEnvFolder() . 'storage/back/assets/images/users/person.png',
                'bio' => 'Travaille à Wononvi en tant que ' . $roleName,
                'address' => $user->city->name,
                'user_id' => $user->id,
            ]);

            // $user->roles()->attach($request->role);
            $user->assignRole($request->role);

            Mail::to($user->email)->send(new UserCreated($user, $password));

            // Rediriger avec un message de succès
            return redirect()->route('users.index')->with('success', 'Utilisateur créé avec succès. Un email lui a été envoyé.');
        }

        public function show(User $user)
        {
            $receivedReviewsCount = Review::whereHas('booking.ride', function ($query) use ($user) {
                $query->where('driver_id', $user->id); // Avis reçus en tant que conducteur
            })->orWhereHas('booking', function ($subQuery) use ($user) {
                $subQuery->where('passenger_id', $user->id); // Avis reçus en tant que passager
            })->count();

            $averageRating = $user->averageRatingOutOfFive();

            // Si aucun avis n'a été donné
            if (is_null($averageRating)) {
                $averageRating = 0;
            }

            return view('back.pages.users.show', [
                'receivedReviewsCount' => $receivedReviewsCount,
                'averageRating' => $averageRating,
                'totalTrips' => $user->totalTrips(),
                'totalRideRequests' => $user->totalRideRequests(),
                'user' => $user,
            ]);
        }


        public function edit(User $user)
        {
            //
            if (auth()->user()->hasRole('manager')) {

                $auth_user = auth()->user();
                $auth_country_id = $auth_user->city->country->id ?? null;

                $cities = City::where('country_id',$auth_country_id)->get();
            }else {
                $selectedCountry = session('selected_country', 'benin'); // Par défaut 'benin' si rien n'est sélectionné

                // Récupérer l'ID du pays basé sur le pays sélectionné
                $countryName = BackHelper::getCountryByName($selectedCountry);
                $countryid =$countryName->id;
                $cities = City::where('country_id',$countryid)->get();

            }
            return view('back.pages.users.edit', compact('cities'));
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
        public function destroy(User $user)
        {
            // Vérifier s'il a créé des trajets en tant que conducteur
            $hasCreatedRides = $user->rides()->exists();

            // Vérifier s'il a réservé des trajets (en tant que passager)
            $hasBookings = $user->bookings()->exists();

            // Vérifier s'il a des demandes de trajets (RideRequest ou RideMatch)
            $hasRideRequests = $user->ride_requests()->exists();
            $hasRideMatches = $user->ride_matches()->exists();

            // Si l'utilisateur n'a ni créé, ni réservé de trajets, ni fait de demandes
            if (!$hasCreatedRides && !$hasBookings && !$hasRideRequests && !$hasRideMatches) {
                // Supprimer l'utilisateur
                $user->delete();

                // Message de succès
                return redirect()->route('users.index')->with('success', 'L\'utilisateur a été supprimé avec succès.');
            } else {
                // Message d'erreur si l'utilisateur a des trajets ou réservations
                return redirect()->route('users.index')->with('danger', 'Impossible de supprimer l\'utilisateur car il a des trajets et/ou réservations associés.');
            }
        }


        public function updateStatus(User $user)
        {

            // Changer le statut de l'utilisateur
            $user->status = !$user->status;
            $user->save();

            // Redirection avec un message de succès
            return back()->with('success', 'Le statut de l\'utilisateur a été mis à jour.');
        }

        public function updateIsCertified(User $user)
        {
            if (!$user->is_certified) {
                // Changer le statut de l'utilisateur
                $user->is_certified = !$user->is_certified;
                $user->save();

                // Redirection avec un message de succès
                return back()->with('success', 'L\'utilisateur a été certifié avec succès.');
            }
            else
            {
                return back()->with('warning', 'L\'utilisateur a été déjà certifié donc ne peut  pas être dé-certifié à nouveau.');
            }

        }


        public function checkUsername(Request $request)
        {
            $username = $request->query('username');
            $isUnique = !User::where('username', $username)->exists();

            return response()->json(['isUnique' => $isUnique]);

    }

    public function Indexrole(){

        $roles = Role::whereNotIn('role', ['conducteur', 'passager','Développeur'])->get();  // Exclure 'conducteur' et 'passager'

        // Récupérer les utilisateurs qui ont l'un des rôles dans la variable $roles
        $users = User::whereHas('roles', function($query) use ($roles) {
            $query->whereIn('role_id', $roles->pluck('id'));
        })->paginate(10);

        return view('back.pages.users.role', compact('users', 'roles'));
    }

    public function assignRole(Request $request, User $user)
    {
        // Validation du rôle choisi
        $request->validate([
            'role_id' => 'required|exists:roles,id',
        ]);

        // Ajout du rôle à l'utilisateur
        $role = Role::find($request->role_id);
        $user->roles()->syncWithoutDetaching([$role->id]);

        return redirect()->back()->with('success', 'Rôle assigné avec succès.');
    }

        public function doc(){

            if (auth()->user()->hasAnyRole(['super admin', 'dev'])) {
                // Récupérer le pays sélectionné depuis la session
                $selectedCountry = session('selected_country', 'benin'); // Par défaut 'benin'
                $country = BackHelper::getCountryByName($selectedCountry);
                $countryId = $country->id ?? null;
            $users = User::whereHas('roles', function($query) {
                $query->whereIn('name', ['driver','passenger']);
            })->when($countryId, function ($query) use ($countryId) {
                $query->whereHas('city.country', function ($subQuery) use ($countryId) {
                    $subQuery->where('id', $countryId);
                });
            })
            ->paginate(10);

            }else{

                $auth_user = auth()->user();
                $auth_country_id = $auth_user->city->country->id ?? null;

                $users = User::whereHas('roles', function($query) {
                    $query->whereIn('name', ['driver','passenger']);
                })->when($auth_country_id, function ($query) use ($auth_country_id) {
                    $query->whereHas('city.country', function ($subQuery) use ($auth_country_id) {
                        $subQuery->where('id', $auth_country_id);
                    });
                })
                ->paginate(10);

            }

        return view('back.pages.documents.index',compact('users'));

        }

        public function Showdoc(User $user){

            return view('back.pages.documents.show', compact('user'));

        }
}
