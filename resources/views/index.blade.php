@extends('styleguide::base')

@section('body')

    <div class="asg-component-list">
        @foreach($types as $type)
            <div class="asg-component-list__col">
                <div class="asg-component-list__header">
                    <a class="asg-title asg-title--large" href="{{ route('styleguide.type', ['type' => $type['slug'],]) }}" title="{{ $type['name'] }}">
                        {{ $type['name'] }} ({{  count($type['components']) }})
                    </a>
                </div>
                <div class="asg-component-list__content">
                    <ul class="asg-component-list__list">
                        @foreach($type['components'] as $component)
                            <li class="asg-component-list__item">
                                <a class="asg-tag" href="{{ route('styleguide.component', ['type' => $type['slug'], 'component' => $component['name']]) }}" title="{{ $component['name'] }}">
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
