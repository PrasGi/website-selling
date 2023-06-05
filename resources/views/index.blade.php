@extends('partials.index')

@section('content')
    <div class="h4 pb-2 mb-4 mt-5 text-dark border-bottom border-dark">
        Dashboard
    </div>
    @if (auth()->user()->role_id == 1)
        @include('partials.dashboard.admin')
    @else
        @include('partials.dashboard.sales')
    @endif
@endsection
