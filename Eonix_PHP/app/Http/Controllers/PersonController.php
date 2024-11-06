<?php

namespace App\Http\Controllers;

use App\Models\Person;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PersonController extends Controller
{
    // Récupère toutes les personnes, une seule personne si un ID est fourni et permet de filtrer selon un terme de recherche
    public function getAll(Request $request)
    {
        $id = $request->query('id');
        $search = $request->query('search');

        if ($id) {
            // Recherche la personne par ID si le paramètre est fourni
            $person = Person::find($id, ['id', 'firstname', 'lastname']);
            if (!$person) {
                return response()->json(['message' => 'Person not found'], 404);
            }
            return response()->json($person);
        }

        // Si un terme de recherche est fourni, applique un filtre
        if ($search) {
            $search = strtolower($search);
            $people = Person::whereRaw('LOWER(firstname) LIKE ?', ["%{$search}%"])
                ->orWhereRaw('LOWER(lastname) LIKE ?', ["%{$search}%"])
                ->get(['id', 'firstname', 'lastname']);
            
            return response()->json($people);
        }

        // Sinon, renvoie toutes les personnes
        $people = Person::all(['id', 'firstname', 'lastname']);
        return response()->json($people);
    }

    public function create(Request $request)
    {
        try {
            // Utiliser Validator pour valider les données
            $validator = Validator::make($request->all(), [
                'firstname' => 'required|string|max:255',
                'lastname' => 'required|string|max:255',
            ]);
    
            // Vérifier si la validation a échoué
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }
    
            // Créer la personne si la validation passe
            $person = Person::create([
                'firstname' => $request->input('firstname'),
                'lastname' => $request->input('lastname'),
            ]);
    
            // Retourner la personne créée avec un statut 201
            return response()->json($person, 201);
    
        } catch (\Exception $e) {
            // Gestion de toute autre exception
            return response()->json(['message' => 'An error occurred during creation', 'error' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request)
    {
        $id = $request->query('id'); // Récupère l'ID depuis les paramètres de la requête

        //Vérification que l'ID n'est pas vide
        if (!$id) {
            return response()->json(['message' => 'ID not provided'], 400);
        }
    
        // Trouve la personne par ID
        $person = Person::find($id);
        if (!$person) {
            return response()->json(['message' => 'Person not found'], 404);
        }
    
        // Valide les données entrantes
        try {
            $this->validate($request, [
                'firstname' => 'required|string|max:255',
                'lastname' => 'required|string|max:255',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }
    
        // Met à jour les informations de la personne
        $person->firstname = $request->input('firstname');
        $person->lastname = $request->input('lastname');
        $person->save();
    
        return response()->json($person, 200); // Retourne la personne mise à jour
    }
    

    public function delete(Request $request)
    {
        $id = $request->query('id'); // Récupère l'ID depuis les paramètres de la requête
    
        //Vérification que l'ID n'est pas vide
        if (!$id) {
            return response()->json(['message' => 'ID not provided'], 400);
        }

        // Trouve la personne par ID
        $person = Person::find($id);
        if (!$person) {
            return response()->json(['message' => 'Person not found'], 404);
        }
    
        // Supprime la personne
        $person->delete();
    
        return response()->json(['message' => 'Person deleted successfully'], 200);
    }
    
}
