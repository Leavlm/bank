<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
         // Obtenez le mois en cours au format numérique (1 pour janvier, 2 pour février, etc.).
         $currentMonth = Carbon::now()->format('m');

         // Filtrez les transactions en fonction du mois en cours.
         $transactionByMonth = Transaction::whereMonth('date_transaction', $currentMonth)->orderBy('date_transaction', 'desc')->get();
        $data = [
            'title' => 'Liste des transactions',
            'transactions' => $transactionByMonth,
            'sum' => Transaction::all()->sum('amount')
        ];
        return view('bank', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */  
    public function create()
    {

        return view('form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:50',
            'amount' => 'required',
            'date' => 'required'
        ]);
        $transaction = new Transaction;
        $transaction->name = $request->input('name');
        $transaction->amount = $request->input('amount');
        $transaction->date_transaction = $request->input('date');
        $transaction->save();
        return Redirect::route('home');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Récupérer la transaction à partir de l'ID donné
    $transaction = Transaction::find($id);

    if (!$transaction) {
        // Gérer le cas où la transaction n'a pas été trouvée
        return redirect()->route('home')->with('error', 'Transaction non trouvée.');
    }

    // Afficher la vue avec les détails de la transaction
    return view('transaction.show', ['transaction' => $transaction]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         // Valider les entrées du formulaire
    $request->validate([
        'name' => 'required|string',
        'amount' => 'required|numeric',
        'date' => 'required|date',
    ]);

    // Récupérer la transaction à partir de l'ID donné
    $transaction = Transaction::find($id);

    if (!$transaction) {
        // Gérer le cas où la transaction n'a pas été trouvée
        return redirect()->route('home')->with('error', 'Transaction non trouvée.');
    }

    // Mettre à jour les propriétés de la transaction avec les nouvelles valeurs
    $transaction->name = $request->input('name');
    $transaction->amount = $request->input('amount');
    $transaction->date_transaction = $request->input('date');
    $transaction->save();

    return redirect()->route('home')->with('success', 'Transaction modifiée avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $transaction = Transaction::find($id);
        if ($transaction) {
            $transaction->delete();
            return redirect()->route('home')->with('success', 'Transaction supprimée avec succès.');
        } else {
            return redirect()->route('home')->with('error', 'La transaction n\'existe pas ou a déjà été supprimée.');
        }
    }
}