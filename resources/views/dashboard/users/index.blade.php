@extends("layouts.dashoard")

@section("content")
    <div class="pagetitle">
        <h1>Utilisateurs</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active">Utilisateurs</li>
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
                                    <h5 class="col-6 card-title">Utilisateurs enregistrés</h5>
                                    <span class="col-6 p-1" style="text-align:right;">
                                        <a href="{{ route('users.add') }}" class="btn btn-primary">ajouter</a>
                                    </span>
                                </div>

                                <table class="table table-borderless datatable">
                                    <thead>
                                    <tr>
                                        <th scope="col">name</th>
                                        <th scope="col">email</th>
                                        <th scope="col">Role</th>
                                        <th scope="col"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($users as $user)
                                        <tr>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->role }}</td>
                                            <td>
{{--                                                <a href="{{ route('users.edit', ['id' => $user->id]) }}" class="btn btn-xs text-warning"><i class="bi bi-pencil"></i></a>--}}
                                                @if($user->id != auth()->user()->id)
                                                <a href="{{ route('users.delete', ['id' => $user->id]) }}" class="btn btn-xs text-danger"><i class="bi bi-trash"></i></a>
                                                @endif
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
