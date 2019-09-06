@extends('styleguide::base')

@section('body')

    <div class="styleguide-type-list">

        @foreach($types as $type)
            <div class="styleguide-type">
                <div class="styleguide-type__title">
                    <a href="{{ route('styleguide.type', ['type' => $type['slug'],]) }}" title="{{ $type['name'] }}">
                        {{ $type['name'] }} ({{  count($type['components']) }})
                    </a>
                </div>
                <div class="styleguide-type__content">
                    <ul>
                        @foreach($type['components'] as $component)
                            <li>
                                <a href="{{ route('styleguide.component', ['type' => $type['slug'], 'component' => $component['name']]) }}" title="{{ $component['name'] }}">
                                    {{ $component['name'] }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endforeach

    </div>

@endsection