@if (session('success'))
    <div class="alert alert-success" role="alert">
        {{ session('success') }}
    </div>
@endif

<div class="row p-4">
    <div class="col">
        <div class="card mb-5 mt-3">
            <div class="card-header bg-warning">
                Total input user today
            </div>
            <div class="card-body">
                <h5 class="card-title fs-3">{{ $data['totalInputUserToday'] }}</h5>
                <p class="card-text">Total input <svg class="mb-1" xmlns="http://www.w3.org/2000/svg" width="16"
                        height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                        <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3Zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                    </svg> today</p>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card mb-5 mt-3">
            <div class="card-header bg-info">
                Total input user
            </div>
            <div class="card-body">
                <h5 class="card-title fs-3">{{ $data['totalInputUser'] }}</h5>
                <p class="card-text">Total input <svg class="mb-1" xmlns="http://www.w3.org/2000/svg" width="16"
                        height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                        <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3Zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                    </svg></p>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card mb-5 mt-3">
            <div class="card-header bg-success text-light">
                Input follow up today
            </div>
            <div class="card-body">
                <h5 class="card-title fs-3">{{ $data['totalFollowUpToday'] }}</h5>
                <p class="card-text">Total follow up <svg class="mb-1" xmlns="http://www.w3.org/2000/svg"
                        width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                        <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3Zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                    </svg> today</p>
            </div>
        </div>
    </div>
</div>

<div class="row justify-content-center mt-5">
    <div class="col-5">
        <div class="card mb-3" style="max-width: 540px;">
            <div class="row g-0">
                <div class="col-md-4">
                    <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.webp"
                        class="img-fluid rounded-start" alt="...">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title">{{ auth()->user()->username }}</h5>
                        <p class="card-text">{{ auth()->user()->role->name }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
