<div class="styleguide-component">
    <div class="styleguide-component__title">
        <a href="{{ route('styleguide.component', ['type' => $type['slug'], 'component' => $component['name']]) }}" title="{{ $component['name'] }}">
            {{ $component['name'] }}
        </a>
    </div>
    <div class="styleguide-modifier-list" style="grid-template-columns: repeat({{ $component['meta']['columns'] }}, 1fr);">
        @foreach($component['modifiers'] as $modifier)
            <div class="styleguide-modifier">
                <div class="styleguide-modifier__title">
                    {{ $modifier }}
                </div>
                <div class="styleguide-modifier__render">
                    @component('components/'.$type['directory'].'/'.$component['name'].'/'.$modifier))
                    @endcomponent
                </div>
            </div>
        @endforeach
    </div>
</div>