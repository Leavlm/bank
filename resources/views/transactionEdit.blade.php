@extends ('page')
@section('title', 'Modifier une opération - Mes Comptes')
@section('content')

    <div class="container">
        <section class="card mb-4 rounded-3 shadow-sm">
            <div class="card-header py-3">
                <h1 class="my-0 fw-normal fs-4">Modifier une opération</h1>
            </div>
            <div class="card-body">
                <form action=" {{ route('transaction.update', $transaction->id) }} " method="POST" >
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Nom de l'opération *</label>
                        <input type="text" class="form-control" name="name" id="name" value="{{ $transaction->name }}" 
                            placeholder="Facture d'électricité" required>
                    </div>
                    <div class="mb-3">
                        <label for="date" class="form-label">Date *</label>
                        <input type="date" class="form-control" name="date" id="date" value="{{ $transaction->date_transaction }}"  required>
                    </div>
                    <div class="mb-3">
                        <label for="amount" class="form-label">Montant *</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="amount" id="amount" value="{{ $transaction->amount }}"  required>
                            <span class="input-group-text">€</span>
                        </div>
                    </div>


                    <div class="text-center">
                        <button type="submit" class="btn btn-primary btn-lg">Ajouter</button>
                    </div>
                </form>
            </div>
        </section>
    </div>

   
@endsection