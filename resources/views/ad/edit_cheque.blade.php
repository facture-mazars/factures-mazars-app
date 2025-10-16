@extends('layouts.app')

@section('content')

<div class="title-wrapper pt-30">
    <div class="row align-items-center">
        <div class="col-md-6">
            <div class="title">
                <h2>Modifier Chèque Banque</h2>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card-style settings-card-2 mb-30">
            @if ($errors->any())
                <div>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Formulaire de modification Chèque Banque -->
            <form action="{{ route('cheque.update', $cheque->id_cheque_banque) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-xxl-4">
                        <div class="input-style-1">
                            <label for="types_cheque">Types :</label>
                            <input type="text" id="types_cheque" name="types" value="{{ old('types', $cheque->types) }}" required>
                        </div>
                    </div>

                    @if($cheque->id_mode_encaissement != 1)
                    <div class="col-xxl-4">
                        <div class="input-style-1">
                            <label for="compte">Compte :</label>
                            <input type="text" id="compte" name="compte" value="{{ old('compte', $cheque->compte) }}" required>
                        </div>
                    </div>

                    @endif
                    <div class="col-xxl-4">
                        <div class="select-style-1">
                            <label for="id_mode_encaissement">Mode d'Encaissement :</label>
                            <div class="select-position">
                            <select id="id_mode_encaissement" name="id_mode_encaissement">

                                <option value="">Sélectionner un mode d'encaissement</option>
                                @foreach($modeEncaissements as $mode)
                                    <option value="{{ $mode->id_mode_encaissement }}" {{ old('id_mode_encaissement', $cheque->id_mode_encaissement) == $mode->id_mode_encaissement ? 'selected' : '' }}>
                                        {{ $mode->types }}
                                    </option>
                                @endforeach
                            </select>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="main-btn">Modifier Chèque</button>
                <a href="{{ route('cheque.index') }}" class="main-btn secondary-btn btn-hover">Retour à la liste</a>
            </form>
        </div>
    </div>
</div>

@endsection
