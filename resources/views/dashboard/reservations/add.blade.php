@extends("layouts.dashoard")

@section("content")
    <div class="pagetitle">
        <h1>Réservations</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active">Réservations</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">

            <!-- Left side columns -->
            <div class="col-lg-12">
                <div class="row">
                    <!-- Recent Sales -->
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Enregistrer une nouvelle reservation</h5>

                                <!-- Floating Labels Form -->
                                <form class="row g-3" method="POST" action="{{route('reservations.store')}}">
                                    @csrf

                                    <div class="col-md-12">
                                        <div class="form-floating">
                                            <select name="equipement" id="floatingEquipement" class="form-control @error('equipement') is-invalid @enderror" required>
                                                <option value="">Choissisez un équipement</option>
                                                @foreach($equipements as $equipement)
                                                    <option value="{{ $equipement->id }}">{{ $equipement->name }}</option>
                                                @endforeach
                                            </select>
                                            <label for="floatingEquipement">Choisissez l'équipement à réserver <sup class="text-danger">*</sup></label>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-floating">
                                            <input type="date" min="07" max="18" name="date" value="{{ old('date') }}" class="form-control @error('date') is-invalid @enderror" id="floatingName" required>
                                            <label for="floatingName">Date de la reservation</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="number" min="07" max="18" name="heure_debut" value="{{ old('heure_debut') }}" class="form-control @error('heure_debut') is-invalid @enderror" id="floatingName" required>
                                            <label for="floatingName">Heure début reservation</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="number" min="09" max="20" name="heure_fin" value="{{ old('heure_fin') }}" class="form-control @error('heure_fin') is-invalid @enderror" id="floatingName" required>
                                            <label for="floatingName">Heure de retour du matériel</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-floating">
                                            <textarea class="form-control @error('commentaire') is-invalid @enderror" name="commentaire" placeholder="" id="floatingTextarea" style="height: 100px;" required>{{ old('commentaire') }}</textarea>
                                            <label for="floatingTextarea">Raison de la réservation</label>
                                        </div>
                                    </div>

                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                                        <button type="reset" class="btn btn-secondary">Annuler</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection
