<div class="asg-component">
    <div class="asg-component__title">
        <a class="asg-title" href="{{ route('styleguide.component', ['type' => $type['slug'], 'component' => $component['name']]) }}" title="{{ $component['name'] }}">
            {{ $component['name'] }}
        </a>
    </div>
    @if($component['meta']['description'])
        <div class="asg-component__description">
            <div class="asg-text">
                {{ $component['meta']['description'] }}
            </div>
        </div>
    @endif
    <div class="asg-component__content">
        <div class="asg-modifier-list asg-modifier-list--{{ $component['meta']['mode'] }}" style="grid-template-columns: repeat({{ $component['meta']['columns'] }}, 1fr);">
            @foreach($component['modifiers'] as $modifier)
                <div class="asg-modifier">
                    <div class="asg-modifier__title">
                        <div class="asg-title asg-title--small">
                            {{ $modifier  }}
                        </div>
                    </div>
                    <div class="asg-modifier__render" style="{{ $component['meta']['style'][$modifier] ?? '' }}">
                        @component('components/'.$type['directory'].'/'.$component['name'].'/'.$modifier))
                        @endcomponent
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
