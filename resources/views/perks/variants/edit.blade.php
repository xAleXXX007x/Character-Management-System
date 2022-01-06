<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('perks.variants.edit') }}
    </h2>
  </x-slot>

  <x-container class="max-w-3xl mx-auto">
    <form class="space-y-8" method="POST" action="{{ route('perks.variants.update', ['perk' => $perk, 'variant' => $variant]) }}">
      @csrf
      @method('PATCH')

      <x-form.card>
        <x-form.textarea name="description" maxlength="1024" required onfocus="preview(this)" placeholder="{{ __('perks.placeholder.description') }}" wrap="on">
          {{ old('description', $variant->description) }}
        </x-form.textarea>

        <x-button>
          {{ __('ui.submit') }}
        </x-button>
      </x-form.card>
    </form>
    <script>
      var previewText = @json(__('label.preview'))
    </script>
  </x-container>
</x-app-layout>