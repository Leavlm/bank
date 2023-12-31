@extends ('page')
@section('title', 'Opérations de Juillet 2023 - Mes Comptes')
@section ('content')
    
    
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif

    <div class="container">
        <section class="card mb-4 rounded-3 shadow-sm">
            <div class="card-header py-3">
                <h2 class="my-0 fw-normal fs-4">Solde aujourd'hui</h2>
            </div>
            <div class="card-body">
                <p class="card-title pricing-card-title text-center fs-1"> {{ $sum }} </p>
            </div>
        </section>

        <section class="card mb-4 rounded-3 shadow-sm">
            <div class="card-header py-3">
                <h1 class="my-0 fw-normal fs-4">Opérations de Juillet 2023</h1>
            </div>
            <div class="card-body">
                <table class="table table-striped table-hover align-middle">
                    <thead>
                        <tr>
                            <th scope="col" colspan="2">Opération</th>
                            <th scope="col" class="text-end">Montant</th>
                            <th scope="col" class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <h2>{{ $title }}</h2>
                    <tbody>
                        @foreach ($transactions as $transaction)

                        <tr>
                            <td width="50" class="ps-3">
                            <i class="bi bi-{{ $transaction->category->icon_class }} fs-3"></i>
                            </td>
                            <td>
                                <time datetime="2023-07-10" class="d-block fst-italic fw-light">{{ $transaction->date_transaction }}</time>
                                {{ $transaction->name }}
                            </td>
                            <td class="text-end">
                                <span class="rounded-pill text-nowrap {{ $transaction->amount > 0 ? 'bg-success-subtle' : 'bg-warning-subtle' }} px-2">
                                    {{ str_replace(".", ",", $transaction->amount) }}
                                </span>
                            </td>
                            <td class="text-end text-nowrap">
                                <a href="{{ route('transaction.edit', $transaction->id) }}" class="btn btn-outline-primary btn-sm rounded-circle">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <a href=" {{ route('transaction.destroy', $transaction->id) }} " class="btn btn-outline-danger btn-sm rounded-circle">
                                    <i class="bi bi-trash"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                <nav class="text-center">
                    <ul class="pagination d-flex justify-content-center m-2">
                        <li class="page-item disabled">
                            <span class="page-link">
                                <i class="bi bi-arrow-left"></i>
                            </span>
                        </li>
                        <li class="page-item active" aria-current="page">
                            <span class="page-link">Juillet 2023</span>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="index.html">Juin 2023</a>
                        </li>
                        <li class="page-item">
                            <span class="page-link">...</span>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="index.html">
                                <i class="bi bi-arrow-right"></i>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </section>
    </div>

    <div class="position-fixed bottom-0 end-0 m-3">
        <a href=" {{ @route('form') }} " class="btn btn-primary btn-lg rounded-circle">
            <i class="bi bi-plus fs-1"></i>
        </a>
    </div>
@endsection