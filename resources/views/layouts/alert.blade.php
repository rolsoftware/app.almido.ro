@if (\Session::has('alert'))
    @php
        $alert = Session::get('alert');
    @endphp
    <div class="alert {!! $alert['type'] !!} alert-dismissible fade show" role="alert">
        @switch($alert['type'])
            @case("alert-success")
                <i class="mdi mdi-check-all me-2"></i>
                @break
            @case("alert-info")
                <i class="mdi mdi-alert-circle-outline me-2"></i>
                @break
            @case("alert-warning")
                <i class="mdi mdi-alert-outline me-2"></i>
                @break
            @case("alert-danger")
                <i class="mdi mdi-block-helper me-2"></i>
                @break                
        @endswitch
       
        {!! $alert['message'] !!}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<script>
    setTimeout(function () {
        $('.alert').alert('close');
    }, 5000);
</script>