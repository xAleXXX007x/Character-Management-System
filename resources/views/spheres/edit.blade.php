<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('spheres.edit') }}
    </h2>
  </x-slot>

  <x-container class="max-w-3xl mx-auto">
    <form class="space-y-8" method="POST" action="{{ route('characters.spheres.update', ['character' => $character, 'sphere' => $sphere]) }}">
      @csrf
      @method('PATCH')

      <x-form.card>
        <x-form.input name="name" required maxlength="256" :value="old('name', $sphere->name)" />
        <x-form.input name="description" maxlength="1024" :value="old('description', $sphere->description)" />
        
        <x-button>
          {{ __('ui.submit') }}
        </x-button>
      </x-form.card>
    </form>
  </x-container>
</x-app-layout>