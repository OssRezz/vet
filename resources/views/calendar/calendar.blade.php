@extends('layouts.layout')
@section('title', 'Appointments')
@section('content')
    <div class="container">
        <div class="row my-4">
            <div class="col">
                <div class="card mb-3 shadow-sm">
                    <div class="card-header"><i class="fas fa-calendar text-primary"></i> <b>Appointments calendar</b>
                    </div>
                    <div class="card-body">
                        <div id='calendar'></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        var data = <?php echo $jsonEventos; ?>;
    </script>
    <script src="{{ asset('js/calendar.js') }}"></script>
@endsection
