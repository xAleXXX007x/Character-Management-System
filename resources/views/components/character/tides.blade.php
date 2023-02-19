<div class="space-y-2">
    @foreach (App\Enums\Tide::cases() as $tide)
        <div class="bg-{{ $tide->color() }}-200 rounded-xl py-1 px-2">
            <div class="text-xl font-bold gap-4 flex justify-between items-center ">
                <div class="bg-{{ $tide->color() }}-300 rounded-full px-2">
                    {{ $tide->localized() }}
                </div>

                <div class="w-8 h-8 inline-flex text-center items-center justify-center bg-{{ $tide->color() }}-300 p-1 rounded-xl">
                    {{ ${'level_' . $tide->value} ?? '' }}
                </div>
            </div>

            <div class="p-2">
                {{ ${'content_' . $tide->value} ?? '' }}
            </div>
        </div>
    @endforeach

    {{ $slot }}
</div>