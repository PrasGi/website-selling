@extends('partials.index')

@section('content')
    <div class="h4 pb-2 mb-4 mt-5 text-dark border-bottom border-dark">
        <a class="btn btn-light mb-2" href="{{ route('salesIndexAdmin') }}">
            <svg class="mb-1" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                class="bi bi-arrow-left" viewBox="0 0 16 16">
                <path fill-rule="evenodd"
                    d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z" />
            </svg></a>
        Sales detail
    </div>

    @if (session('success'))
        <div class="alert alert-success m-2" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <button type="button" class="btn btn-warning ms-5" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
        <svg class="mb-1" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
            class="bi bi-eye" viewBox="0 0 16 16">
            <path
                d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
            <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
        </svg> view
    </button>

    <a href="{{ route('export', $user->id) }}" class="btn btn-dark">
        download csv
        <svg class="mb-1 ms-2" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
            class="bi bi-download" viewBox="0 0 16 16">
            <path
                d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z" />
            <path
                d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z" />
        </svg>
    </a>

    <div class="row justify-content-center">
        <div class="col-7 p-2">
            {{-- data --}}
            <div class="mt-3">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">id</th>
                            <th scope="col">Username</th>
                            <th scope="col">Address</th>
                            <th scope="col">Phone Number</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dataFollowup as $value)
                            <tr>
                                <th scope="row">{{ $value->id }}</th>
                                <td>{{ $value->name }}</td>
                                <td>{{ $value->address }}</td>
                                <td>{{ $value->phone_number }}</td>
                                <td>
                                    <form action="{{ route('detailFollowup', $value->id) }}" method="get">
                                        @csrf
                                        <button class="btn btn-warning ms-2" type="submit"><svg class="mb-1"
                                                xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                                <path
                                                    d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                                                <path
                                                    d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                                            </svg>
                                            View
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{-- end data --}}
        </div>
        {{-- right bar --}}
        <div class="col-4">
            <div class="row">
                <div class="card mb-5 mt-3">
                    <div class="card-header bg-warning ">
                        Total input user today
                    </div>
                    <div class="card-body">
                        <h5 class="card-title fs-3">{{ $data['totalInputUserToday'] }}</h5>
                        <p class="card-text">Total input user today</p>
                    </div>
                </div>
                <div class="card mb-5 mt-3">
                    <div class="card-header bg-info">
                        Total input user
                    </div>
                    <div class="card-body">
                        <h5 class="card-title fs-3">{{ $data['totalInputUser'] }}</h5>
                        <p class="card-text">Total input user</p>
                    </div>
                </div>
                <div class="card mb-5 mt-3">
                    <div class="card-header bg-success text-light">
                        Input follow up today
                    </div>
                    <div class="card-body">
                        <h5 class="card-title fs-3">{{ $data['totalFollowUpToday'] }}</h5>
                        <p class="card-text">Total follow up times today</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- modal me --}}
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit me</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('updateSales', $user->id) }}" method="post">
                        @csrf
                        <div class="mb-3">
                            @error('username')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                            <label for="exampleInputEmail1" class="form-label">Username</label>
                            <input type="text" name="username" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" required value="{{ $user->username }}">
                        </div>
                        <div class="mb-3">
                            @error('email')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                            <label for="exampleInputEmail1" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" required value="{{ $user->email }}">
                        </div>
                        <div class="mb-3">
                            @error('phone_number')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                            <label for="exampleInputEmail1" class="form-label">Phone Number</label>
                            <input type="text" name="phone_number" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" required value="{{ $user->phone_number }}">
                        </div>
                        <div class="mb-3">
                            @error('address')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                            <label for="exampleInputEmail1" class="form-label">Address</label>
                            <input type="text" name="address" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" required value="{{ $user->address }}">
                        </div>
                        <div class="mb-3">
                            @error('full_name')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                            <label for="exampleInputEmail1" class="form-label">Fullname</label>
                            <input type="text" name="full_name" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" required value="{{ $user->full_name }}">
                        </div>
                        <div class="mb-3">
                            @error('password')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                            <label for="exampleInputPassword1" class="form-label">New password</label>
                            <input type="password" name="password" class="form-control" id="exampleInputPassword1">
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- end Modal Me --}}
@endsection
