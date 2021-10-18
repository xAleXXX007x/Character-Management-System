<x-app-layout>
  <x-slot name="header">
    <div class="flex justify-between items-center text-gray-600">
      <div class="flex-grow-0">
        <h2 class="font-semibold leading-tight text-gray-800 text-3xl">
          {{ $user->name }}
        </h2>
        <div class="font-thin text-base mt-2">
          {{-- Discord: <span class="select-all">{{ $user->discord_tag }}</span> --}}
        </div>
      </div>
      <div class="flex flex-wrap flex-shrink-0">
        <x-user.actions :user="$user"/>
      </div>
    </div>
  </x-slot>

  <x-character.list :characters="$user->characters"/>
</x-app-layout>