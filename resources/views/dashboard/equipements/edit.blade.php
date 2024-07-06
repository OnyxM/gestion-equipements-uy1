@extends("layouts.dashoard")

@section("content")
    <div class="pagetitle">
        <h1>Equipements</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active">Equipements</li>
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
                                <h5 class="card-title">Modifier l'équipement {{ $equipement->code }}</h5>

                                <!-- Floating Labels Form -->
                                <form class="row g-3" method="POST" action="{{route('equipements.update', ['id' => $equipement->id])}}">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $equipement->id }}">

                                    <div class="col-md-3">
                                        <div class="form-floating">
                                            <input type="text" name="code" value="{{ old('code') ?? $equipement->code }}" class="form-control @error('code') is-invalid @enderror" id="floatingName" placeholder="Video Projecteur HP Noir">
                                            <label for="floatingName">Code equipement</label>
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="form-floating">
                                            <input type="text" name="name" value="{{old('name') ?? $equipement->name }}" class="form-control @error('name') is-invalid @enderror" id="floatingName" placeholder="Video Projecteur HP Noir" required>
                                            <label for="floatingName">Nom equipement <sup class="text-danger">*</sup></label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-floating">
                                            <textarea class="form-control" name="description" placeholder="Address" id="floatingTextarea" style="height: 100px;">{{ old('description') ?? $equipement->description }}</textarea>
                                            <label for="floatingTextarea">Description</label>
                                        </div>
                                    </div>

                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                                        <button type="reset" class="btn btn-secondary">Annuler</button>
                                    </div>
                                </form><!-- End floating Labels Form -->

                            </div>
                        </div>
                    </div><!-- End Recent Sales -->
                </div>
            </div><!-- End Left side columns -->

        </div>
    </section>
@endsection
