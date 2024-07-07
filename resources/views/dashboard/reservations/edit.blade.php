@extends("layouts.dashoard")

@section("content")
    <div class="pagetitle">
        <h1>Reservations</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active">Reservations</li>
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
                                <h5 class="card-title">Modifier la réservation {{ $reservation->equipement->code }}</h5>

                                <!-- Floating Labels Form -->
                                <form class="row g-3" method="POST" action="{{route('reservations.update', ['id' => $reservation->id])}}">
                                    @csrf
                                    <input type="hidden" required value="{{ $reservation->id }}" name="id">

                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <select disabled name="equipement" id="floatingEquipement" class="form-control @error('equipement') is-invalid @enderror" required>
                                                <option value="">Choissisez un équipement</option>
                                                @foreach($equipements as $equipement)
                                                    <option value="{{ $equipement->id }}" @selected($equipement->id==$reservation->equipement_id)>{{ $equipement->name }}</option>
                                                @endforeach
                                            </select>
                                            <label for="floatingEquipement">Choisissez l'équipement à réserver <sup class="text-danger">*</sup></label>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="text" disabled value="{{ $reservation->delegue->name }}" class="form-control">
                                            <label for="floatingName">Nom du délégué</label>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-floating">
                                            <input disabled type="date" min="07" max="18" name="date" value="{{ old('date') }}" class="form-control @error('date') is-invalid @enderror" id="floatingName" required>
                                            <label for="floatingName">Date de la reservation</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input disabled type="number" min="07" max="18" name="heure_debut" value="{{ $reservation->debut }}" class="form-control @error('heure_debut') is-invalid @enderror" id="floatingName" required>
                                            <label for="floatingName">Heure début reservation</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input disabled type="number" min="09" max="20" name="heure_fin" value="{{ $reservation->fin }}" class="form-control @error('heure_fin') is-invalid @enderror" id="floatingName" required>
                                            <label for="floatingName">Heure de retour du matériel</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-floating">
                                            <textarea disabled class="form-control @error('commentaire') is-invalid @enderror" name="commentaire" placeholder="" id="floatingTextarea" style="height: 100px;" required>{{ $reservation->commentaire }}</textarea>
                                            <label for="floatingTextarea">Raison de la réservation</label>
                                        </div>
                                    </div>

                                    <hr>

                                    <div class="col-md-12">
                                        <div class="form-floating">
                                            <select name="status" id="floatingStatus" class="form-control @error('status') is-invalid @enderror" required>
                                                <option value="">Validez/Rejetez la réservation</option>
                                                @if($reservation->status == "pending")
                                                <option value="accepted">Validé</option>
                                                <option value="rejected">Rejeté</option>
                                                @endif
                                                <option value="ended">Débuter l'utilisation</option>
                                            </select>
                                            <label for="floatingStatus">Choisissez une action <sup class="text-danger">*</sup></label>
                                        </div>
                                    </div>

                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                                        <button type="reset" class="btn btn-secondary">Annuler</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div><!-- End Recent Sales -->
                </div>
            </div><!-- End Left side columns -->

        </div>
    </section>
@endsection
