<x-character.tides>
    @foreach($character->tides as $tide)
        <x-slot :name="'level_' . $tide->tide->value">
            @can('update-charsheet-gm', $character)
                <div class="bg-{{ $tide->tide->color() }}-300 rounded-full items-center p-1">
                    <input class="px-1 text-center rounded-full"
                           name="tides[{{ $tide->id }}][level]"
                           type="number"
                           min="0"
                           max="100"
                           value="{{ old("tides.{$tide->id}.level", $tide->level) }}"
                           required
                    />
                </div>
            @else
                {{ $tide->level }}
            @endcan
        </x-slot>

        <x-slot :name="'content_' . $tide->tide->value">
            <div class="text-lg">
                {{ __('tides.path') }}:
            </div>
            <div class="p-1">
                <input class="w-full"
                       name="tides[{{ $tide->id }}][path]"
                       type="text"
                       placeholder="{{ __('tides.placeholder.' . $tide->tide->value) }}"
                       value="{{ old("tides.{$tide->id}.path", $tide->path) }}"
                />
            </div>
            <input type="hidden" name="tides[{{ $tide->id }}][tide]" value="{{ $tide->tide->value }}"/>
        </x-slot>
    @endforeach
</x-character.tides>
<x-form.error name="tides"/>
<x-form.error name="tides.*.path"/>
<x-form.error name="tides.*.level"/>
<x-form.error name="tides.*.tide"/>