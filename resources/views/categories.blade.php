@extends ('page')
@section ('title', 'Catégories - Mes Comptes')
@section ('content')

<?php
$icons = [
    "currency-dollar",
    "arrow-down-left",
    "arrow-up-right",
    "credit-card",
    "arrow-left-right",
    "clock-history",
    "money-bill-wave",
    "percent",
    "exclamation-circle",
    "credit-card",
    "money-bill-alt",
    "check",
    "money-bill-alt",
    "arrow-right",
    "arrow-down",
    "arrow-up",
    "times-circle",
    "credit-card-alt",
    "credit-card",
    "credit-card-alt",
    "check",
    "arrow-right",
    "arrow-left",
    "cog",
    "lock",
    "question-circle",
  ];
?>

<div class="container">
    <section class="card mb-4 rounded-3 shadow-sm">
        <div class="card-header py-3">
            <h1 class="my-0 fw-normal fs-4">Catégories</h1>
        </div>
    
        @foreach ($categories as $category)
        <div class="card-body">
            <ul class="list-group list-group-flush">
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        <i class="bi bi-{{ $category->icon_class }} fs-3"></i>
                        {{ $category->categorie_name}}
                        <span class=" badge bg-secondary">{{ $category->transactions->count() }} opérations</span>
                    </div>
                    <div>
                        <a href="#" class="btn btn-outline-primary btn-sm rounded-circle">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <a href="#" class="btn btn-outline-danger btn-sm rounded-circle">
                            <i class="bi bi-trash"></i>
                        </a>
                    </div>
                </li>
            </ul>
        </div>
        @endforeach
    </section>
    <section class="card mb-4 rounded-3 shadow-sm">
        <div class="card-header py-3">
            <h2 class="my-0 fw-normal fs-4">Ajouter une catégorie</h2>
        </div>
        <div class="card-body">
            <form class="row align-items-end" method="post" action="{{@route('addCategories')}}"> 
                @csrf
                <div class="col col-md-5">
                    <label for="name" class="form-label">Nom *</label>
                    <input type="text" class="form-control" name="name" id="name" required>
                </div>
                <div class="col-md-5">
                    <label for="icon" class="form-label">Classe icone bootstrap *</label>
                    <select name="icon" id="icon">
                        <option value="">Sélectionnez une icone</option>
                            @foreach ($icons as $index => $icon)
                        <option value=" {{ $icon }} ">bi-{{ $icon }}</option>
                            @endforeach
                    </select>
                </div>
                <div class="col col-md-2 text-center text-md-end mt-3 mt-md-0">
                    <button type="submit" class="btn btn-secondary">Ajouter</button>
                </div>
            </form>
        </div>
    </section>
</div>
@endsection