<?php

namespace App\Http\Controllers;

use App\Models\Category;
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
            'sum' => Transaction::all()->sum('amount'),
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
        $data = ['categories' => Category::all()];
        return view('form', $data);
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
            'date' => 'required',
            'category' => 'required'
        ]);
        if (!$validated) {
            return Redirect::route('home')->with('error', 'Transaction invalide');
        }
        $transaction = new Transaction;
        $transaction->name = $request->input('name');
        $transaction->amount = $request->input('amount');
        $transaction->date_transaction = $request->input('date');
        $transaction->category_id = $request->input('category');
        $transaction->save();
        return Redirect::route('home')->with('success', 'La transaction a été ajoutée');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $transaction = Transaction::find($id);
        if (!$transaction) {
            return redirect()->route('home')->with('error', 'Transaction non trouvée.');
        }
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
        $transaction = Transaction::find($id);

        if (!$transaction) {
            return redirect()->route('home')->with('error', 'Transaction non trouvée.');
        }

        return view('transactionEdit', [
            'transaction' => $transaction,
            'categories' => Category::all()
        ]);
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
        $request->validate([
            'name' => 'required|string',
            'amount' => 'required|numeric',
            'date' => 'required|date',
            'category' => 'required'
        ]);

        $transaction = Transaction::find($id);

        if (!$transaction) {
            return redirect()->route('home')->with('error', 'Transaction non trouvée.');
        }

        $transaction->name = $request->input('name');
        $transaction->amount = $request->input('amount');
        $transaction->date_transaction = $request->input('date');
        $transaction->category_id = $request->input('category');
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
