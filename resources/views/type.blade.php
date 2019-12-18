@extends('styleguide::base')

@section('header')
    @parent
    <a href="{{ route('styleguide.type', ['type' => $type['slug'],]) }}" class="breadcrumbs__item">
        {{ $type['name'] }}
    </a>
@endsection

@section('body')

    <div class="asg-type-list">
        <div class="asg-type-list__content">
            @foreach($components as $component)
                <div class="asg-type-list__item">
                    @include('styleguide::component_include')
                </div>
            @endforeach
        </div>
    </div>

@endsection
