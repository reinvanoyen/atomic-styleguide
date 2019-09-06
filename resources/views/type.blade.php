@extends('styleguide::base')

@section('body')

    <div class="styleguide-list">
        <div class="styleguide-list__title">{{ $type['name'] }} ({{ count($components) }})</div>
        <div class="styleguide-list__content">
            @foreach($components as $component)
                @include('styleguide::component_include')
            @endforeach
        </div>
    </div>

@endsection