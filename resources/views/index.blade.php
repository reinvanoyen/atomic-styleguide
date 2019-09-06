@extends('styleguide::base')

@section('body')

    <div class="asg-component-list">
        @foreach($types as $type)
            <div class="asg-component-list__item">
                <div class="asg-component-list__header">
                    <a class="asg-title" href="{{ route('styleguide.type', ['type' => $type['slug'],]) }}" title="{{ $type['name'] }}">
                        {{ $type['name'] }} ({{  count($type['components']) }})
                    </a>
                </div>
                <div class="asg-component-list__content">
                    <ul>
                        @foreach($type['components'] as $component)
                            <li>
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