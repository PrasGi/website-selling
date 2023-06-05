@extends('partials.index')
@section('script-head')
    <style>
        .right-bar {
            position: fixed;
            top: 120px;
            right: 0;
            bottom: 0;
            width: 25%;
            /* Sesuaikan dengan lebar yang diinginkan */
            /* Tambahkan properti lain sesuai kebutuhan Anda */
        }

        .header {
            /* position: fixed;
                        z-index: 10;
                        background-color: white;
                        display: block;
                        width: 100%;
                        padding-top: 50px; */
        }

        .content {
            /* margin-top: 120px; */
        }

        .color-save-button {
            background-color: #FF630B;
        }
    </style>
@endsection


@section('content')
    <div class="h4 pb-2 mb-4 mt-5 text-dark border-bottom border-dark">
        <a class="btn btn-light mb-2" href="{{ route('followupIndexSales') }}">
            <svg class="mb-1" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                class="bi bi-arrow-left" viewBox="0 0 16 16">
                <path fill-rule="evenodd"
                    d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z" />
            </svg></a>
        Follow up detail
    </div>

    <div class="row justify-content-start">
        <div class="col-7 me-4 ms-5 content">
            <div class="row">
                @foreach ($history as $value)
                    <div class="card mb-5 mt-3">
                        <div
                            class="card-header color-save-button d-flex justify-content-between align-items-center fs-5 text-light">
                            Follow up {{ $loop->iteration }}
                            @if (auth()->user()->role_id == 1)
                                <form id="deleteForm{{ $value->id }}"
                                    action="{{ route('deleteHistoryFollowUp', $value->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn color-save-button text-light" data-bs-toggle="modal"
                                        data-bs-target="#deleteModal{{ $value->id }}">
                                        <svg class="mb-1" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                                        </svg>
                                    </button>
                                </form>
                            @endif
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Detail follow up</h5>
                            <p class="card-text">{{ $value->detail }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        {{-- right bar --}}
        <div class="col-4 p-2 right-bar me-5">
            <!-- Konten right bar -->
            <div class="p-2 color-save-button rounded-3">
                @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
                <form action="{{ route('saveFollowup', $followup->id) }}" method="post">
                    @csrf
                    <div class="mb-3">
                        @error('name')
                            <div class="alert alert-danger" role="alert">
                                {{ $message }}
                            </div>
                        @enderror
                        <label for="exampleInputEmail1" class="form-label text-light">Name</label>
                        <input type="text" name="name" class="form-control" id="exampleInputEmail1"
                            aria-describedby="emailHelp" required value="{{ $followup->name }}">
                    </div>
                    <div class="mb-3">
                        @error('address')
                            <div class="alert alert-danger" role="alert">
                                {{ $message }}
                            </div>
                        @enderror
                        <label for="exampleInputEmail1" class="form-label text-light">Address</label>
                        <input type="text" name="address" class="form-control" id="exampleInputEmail1"
                            aria-describedby="emailHelp" required value="{{ $followup->address }}">
                    </div>
                    <div class="mb-3">
                        @error('phone_number')
                            <div class="alert alert-danger" role="alert">
                                {{ $message }}
                            </div>
                        @enderror
                        <label for="exampleInputEmail1" class="form-label text-light">Phone Number</label>
                        <input type="text" name="phone_number" class="form-control" id="exampleInputEmail1"
                            aria-describedby="emailHelp" required @if (auth()->user()->role_id == 1) readonly @endif
                            value="{{ $followup->phone_number }}">
                    </div>
                    <div class="text-end">
                        <a href="https://wa.me/62{{ $followup->phone_number }}" class="btn btn-success">
                            <svg class="mb-1" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                fill="currentColor" class="bi bi-whatsapp" viewBox="0 0 16 16">
                                <path
                                    d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z" />
                            </svg>
                            Whatsapp
                        </a>
                        <button type="submit" class="btn bg-primary text-light">Save</button>
                    </div>
                </form>
            </div>
        </div>
        {{-- <div class="col-4 p-2 right-bar">
            <form action="{{ route('saveFollowup', $followup->id) }}" method="post">
                @csrf
                <div class="mb-3">
                    @error('name')
                        <div class="alert alert-danger" role="alert">
                            {{ $message }}
                        </div>
                    @enderror
                    <label for="exampleInputEmail1" class="form-label">Name</label>
                    <input type="text" name="name" class="form-control" id="exampleInputEmail1"
                        aria-describedby="emailHelp" required value="{{ $followup->name }}">
                </div>
                <div class="mb-3">
                    @error('address')
                        <div class="alert alert-danger" role="alert">
                            {{ $message }}
                        </div>
                    @enderror
                    <label for="exampleInputEmail1" class="form-label">Address</label>
                    <input type="text" name="address" class="form-control" id="exampleInputEmail1"
                        aria-describedby="emailHelp" required value="{{ $followup->address }}">
                </div>
                <div class="mb-3">
                    @error('phone_number')
                        <div class="alert alert-danger" role="alert">
                            {{ $message }}
                        </div>
                    @enderror
                    <label for="exampleInputEmail1" class="form-label">Phone Number</label>
                    <input type="text" name="phone_number" class="form-control" id="exampleInputEmail1"
                        aria-describedby="emailHelp" required value="{{ $followup->phone_number }}">
                </div>
                @if (auth()->user()->role_id != 1)
                    <button type="submit" class="btn btn-primary">Save</button>
                @endif
                <a href="https://wa.me/62{{ $followup->phone_number }}" class="btn btn-success">Chat</a>
            </form>
        </div> --}}
    </div>

    <!-- Delete Confirmation Modal -->
    @foreach ($history as $value)
        <div class="modal fade" id="deleteModal{{ $value->id }}" data-bs-backdrop="static" data-bs-keyboard="false"
            tabindex="-1" aria-labelledby="deleteModalLabel{{ $value->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel{{ $value->id }}">Confirmation</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Do you sure want to delete this admin?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-danger"
                            onclick="deleteHistory({{ $value->id }})">Delete</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    {{-- end Confirmation Modal --}}
@endsection

@section('script-body')
    <script>
        function deleteHistory(id) {
            document.getElementById('deleteForm' + id).submit();
        }
    </script>
@endsection
