@if (session('alerts'))
    @foreach (session('alerts') as $alert)
        <div class="alert alert-{{ $alert['type'] }} alert-dismissible fade show" role="alert">
            {{ $alert['message'] }}
            <button aria-label="Close" class="btn-close" data-bs-dismiss="alert" type="button"></button>
        </div>
    @endforeach
@endif
