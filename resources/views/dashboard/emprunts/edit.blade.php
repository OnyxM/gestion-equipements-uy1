@extends("layouts.dashoard")

@section("content")
    <div class="pagetitle">
        <h1>Emprunts</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active">Emprunts</li>
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
                                <h5 class="card-title">Modifier sur l'équipement {{ $emprunt->equipement->code }}</h5>

                                <!-- Floating Labels Form -->
                                <form class="row g-3" method="POST" action="{{route('emprunts.update', ['id' => $emprunt->id])}}">
                                    @csrf
                                    <input type="hidden" name="emprunt" value="{{ $emprunt->id }}" required>

                                    <div class="col-md-12">
                                        <div class="form-floating">
                                            <select name="status" id="floatingStatus" class="form-control @error('status') is-invalid @enderror" required>
                                                <option value="">Validez/Rejetez l'emprunt</option>
                                                @if($emprunt->status == "attente_de_validation")
                                                <option value="en_cours">Validé</option>
                                                <option value="rejeté">Rejeté</option>
                                                @endif
                                                <option value="terminé">Utilisation terminée</option>
                                            </select>
                                            <label for="floatingStatus">Choisissez une action <sup class="text-danger">*</sup></label>
                                        </div>
                                    </div>

                                    <hr>

                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <select name="equipement" id="floatingEquipement" class="form-control @error('equipement') is-invalid @enderror">
                                                <option value="">Choissisez un équipement</option>
                                                @foreach($equipements as $equipement)
                                                    <option value="{{ $equipement->id }}" @selected($equipement->id == $emprunt->equipement_id)>{{ $equipement->name }}</option>
                                                @endforeach
                                            </select>
                                            <label for="floatingEquipement">Choisissez l'équipement à emprunter <sup class="text-danger">*</sup></label>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="text" disabled value="{{ $emprunt->delegue->name }}" class="form-control">
                                            <label for="floatingName">Nom du délégué</label>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="number" min="07" max="{{ date('H', time()) }}" name="heure_debut" value="{{ old('heure_debut') ?? $emprunt->heure_debut }}" class="form-control @error('heure_debut') is-invalid @enderror" id="floatingName" placeholder="Video Projecteur HP Noir">
                                            <label for="floatingName">Heure début emprunt</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="number" disabled name="heure_fin" value="{{ date('H', time()) }}" class="form-control" id="floatingName" placeholder="Video Projecteur HP Noir">
                                            <label for="floatingName">Heure de retour du matériel</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-floating">
                                            <textarea class="form-control" name="description" placeholder="" id="floatingTextarea" style="height: 100px;">{{ old('description') ?? $emprunt->description }}</textarea>
                                            <label for="floatingTextarea">Raison de l'emprunt</label>
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
