@extends('layouts.app')

@section('content')

<div class="title-wrapper pt-30">
    <div class="row align-items-center">
        <div class="col-md-6">
            <div class="title">
                <h2>Liste des Chèques Bancaires</h2>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card-style settings-card-2 mb-30">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <table class="table">
                <thead>
                    <tr>
                    <th>Mode d'Encaissement</th>
                        <th>Types</th>
                        <th>Compte</th>
                       
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cheques as $cheque)
                        <tr>
                        <td>{{ $cheque->modeEncaissement->types ?? 'N/A' }}</td>
                            <td>{{ $cheque->types }}</td>
                            <td>{{ $cheque->compte }}</td>
                         
                            <td>
                                <a href="{{ route('cheque.edit', $cheque->id_cheque_banque) }}" class="btn btn-primary"><i class="lni lni-pencil"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
