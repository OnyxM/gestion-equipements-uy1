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
                                <h5 class="card-title">Enregistrer un nouvel utilisateur</h5>

                                <!-- Floating Labels Form -->
                                <form class="row g-3" method="POST" action="{{route('users.store')}}">
                                    @csrf

                                    <div class="col-md-3">
                                        <div class="form-floating">
                                            <select name="role" id="foatingRole" class="form-control" aria-label="Role" required>
                                                <option value="">Choissisez un role</option>
                                                <option value="manager">Manager</option>
                                                <option value="delegue">Délégué</option>
                                            </select>
                                            <label for="foatingRole">Role</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="text" name="name" value="{{old('name')}}" class="form-control @error('name') is-invalid @enderror" id="floatingName" placeholder="Johnson Otwel" required>
                                            <label for="floatingName">Name <sup class="text-danger">*</sup></label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="text" name="email" value="{{old('email')}}" class="form-control @error('email') is-invalid @enderror" id="floatingName" placeholder="email@domain.com" required>
                                            <label for="floatingName">Email <sup class="text-danger">*</sup></label>
                                            <div class="text-danger h6">Vous devrez communiquer cette information au nouvel utilisateur</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="text" name="password" value="{{old('password')}}" class="form-control @error('password') is-invalid @enderror" id="floatingName" placeholder="email@domain.com" required>
                                            <label for="floatingName">Mot de passe <sup class="text-danger">*</sup></label>
                                            <div class="text-danger h6">Vous devrez communiquer cette information au nouvel utilisateur</div>
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
