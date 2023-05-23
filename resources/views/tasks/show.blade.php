@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Detajet e Detyrës') }}</div>

                    <div class="card-body">
                        <p><strong>{{ __('Titulli:') }}</strong> {{ $task->title }}</p>
                        <p><strong>{{ __('Përshkrimi:') }}</strong> {{ $task->description }}</p>
                        <p><strong>{{ __('Data e Skadencës:') }}</strong> {{ $task->due_date }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
