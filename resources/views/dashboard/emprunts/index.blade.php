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
                        <div class="card recent-sales overflow-auto">

                            <div class="card-body">
                                <div class="row">
                                    <h5 class="col-6 card-title">Emprunts enregistrés</h5>
                                    <span class="col-6 p-1" style="text-align:right;">
                                        <a href="{{ route('emprunts.add') }}" class="btn btn-primary">ajouter</a>
                                    </span>
                                </div>

                                <table class="table table-borderless datatable">
                                    <thead>
                                    <tr>
                                        <th scope="col">Date</th>
                                        <th scope="col">Equipement</th>
                                        <th scope="col">Délégué</th>
                                        <th scope="col">Responsable</th>
                                        <th scope="col">Période</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Commentaire</th>
                                        @if(auth()->user()->id != "delegue")
                                        <th scope="col"></th>
                                        @endif
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($emprunts as $emprunt)
                                        <tr>
                                            <th scope="row">{{ $emprunt->date }}</th>
                                            <td>{{ $emprunt->equipement->code }}</td>
                                            <td>{{ $emprunt->delegue->name }}</td>
                                            <td>{{ @$emprunt->manager->name }}</td>
                                            <td>{{ $emprunt->heure_debut . "h - " . $emprunt->heure_fin . "h" }}</td>
                                            <td>
                                                @if($emprunt->status=="terminé")
                                                    <span class="badge bg-success">Terminé</span>
                                                @elseif($emprunt->status == "rejeté")
                                                    <span class="badge bg-danger">Rejeté</span>
                                                @elseif($emprunt->status == "en_cours")
                                                    <span class="badge bg-warning">En utilisation</span>
                                                @else
                                                    <span class="badge bg-info">Attente de validation</span>
                                                @endif
                                            <td>{{ $emprunt->commentaire }}</td>

                                            @if(auth()->user()->id != "delegue" && !in_array($emprunt->status, ['terminé', 'rejeté']))
                                            <td>
                                                <a href="{{ route('emprunts.edit', ['id' => $emprunt->id]) }}" class="btn btn-xs text-warning"><i class="bi bi-pencil"></i></a>
                                            </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>

                            </div>

                        </div>
                    </div><!-- End Recent Sales -->
                </div>
            </div><!-- End Left side columns -->

        </div>
    </section>
@endsection
