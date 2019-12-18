@extends('styleguide::base')

@section('header')
    @parent
    <a href="{{ route('styleguide.type', ['type' => $type['slug'],]) }}" class="breadcrumbs__item">
        {{ $type['name'] }}
    </a>
    <a href="{{ route('styleguide.component', ['type' => $type['slug'], 'component' => $component['name'],]) }}" class="breadcrumbs__item">
        {{ $component['name'] }}
    </a>
@endsection

@section('body')
    @include('styleguide::component_include')
@endsection
