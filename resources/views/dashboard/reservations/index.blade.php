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
                        <div class="card recent-sales overflow-auto">

                            <div class="card-body">
                                <div class="row">
                                    <h5 class="col-6 card-title">Reservations enregistrés</h5>
                                    @if(auth()->user()->role == "delegue")
                                    <span class="col-6 p-2" style="text-align:right;">
                                        <a href="{{ route('reservations.add') }}" class="btn btn-primary m-2">ajouter</a>
                                    </span>
                                    @endif
                                </div>

                                <table class="table table-borderless datatable">
                                    <thead>
                                    <tr>
                                        <th scope="col">Date</th>
                                        <th scope="col">Equipement</th>
                                        <th scope="col">Délégué</th>
                                        <th scope="col">Responsable</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Période</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Commentaire</th>
                                        @if(auth()->user()->id != "delegue")
                                        <th scope="col"></th>
                                        @endif
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($reservations as $reservation)
                                        <tr>
                                            <th scope="row">{{ $reservation->date }}</th>
                                            <td>{{ @$reservation->equipement->code }}</td>
                                            <td>{{ @$reservation->delegue->name }}</td>
                                            <td>{{ @$reservation->manager->name }}</td>
                                            <td>{{ @$reservation->date }}</td>
                                            <td>{{ $reservation->debut . "h - " . $reservation->fin . "h" }}</td>
                                            <td>
                                                @if($reservation->status=="terminé")
                                                    <span class="badge bg-success">Terminé</span>
                                                @elseif($reservation->status == "rejeté")
                                                    <span class="badge bg-danger">Rejeté</span>
                                                @elseif($reservation->status == "en_cours")
                                                    <span class="badge bg-warning">En utilisation</span>
                                                @else
                                                    <span class="badge bg-info">Attente de validation</span>
                                                @endif
                                            <td>{{ $reservation->commentaire }}</td>

                                            @if(auth()->user()->role != "delegue" && !in_array($reservation->status, ['rejected', 'accepted']))
                                            <td>
                                                <a href="{{ route('reservations.edit', ['id' => $reservation->id]) }}" class="btn btn-xs text-warning"><i class="bi bi-pencil"></i></a>
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
