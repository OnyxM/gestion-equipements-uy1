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
                        <div class="card recent-sales overflow-auto">

                            <div class="card-body">
                                <div class="row">
                                    <h5 class="col-6 card-title">Equipements enregistrés</h5>
                                    <span class="col-6 p-1" style="text-align:right;">
                                        <a href="{{ route('equipements.add') }}" class="btn btn-primary">ajouter</a>
                                    </span>
                                </div>

                                <table class="table table-borderless datatable">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">name</th>
                                        <th scope="col">description</th>
                                        <th scope="col">Added By</th>
                                        <th scope="col">Status</th>
                                        <th scope="col"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($equipements as $equipement)
                                        <tr>
                                            <th scope="row">#{{ $equipement->code }}</th>
                                            <td>{{ $equipement->name }}</td>
                                            <td>{{ $equipement->description }}</td>
                                            <td>{{ $equipement->created_by }}</td>
                                            <td>
                                                @if($equipement->status == 'free') <span class="badge bg-success">Free</span>
                                                @else <span class="badge bg-warning">In use</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('equipements.edit', ['id' => $equipement->id]) }}" class="btn btn-xs text-warning"><i class="bi bi-pencil"></i></a>
                                                <a href="{{ route('equipements.delete', ['id' => $equipement->id]) }}" class="btn btn-xs text-danger"><i class="bi bi-trash"></i></a>
                                            </td>
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
