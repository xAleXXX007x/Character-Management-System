<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Edit User') }}
    </h2>
  </x-slot>
  
  <x-container class="max-w-6xl space-y-8">
    <div class="bg-white rounded-xl max-w-3xl mx-auto shadow-lg place-self-start p-6">
      <form method="POST" action="{{ route('users.update', $user) }}">
        @csrf
        @method('PATCH')

        <x-form.input name="name" required :value="old('name', $user->name)"/>

        @can('manage', $user)
          <div class="flex justify-items-between space-x-8">
            <div>
              <h1 class="font-bold text-2xl mb-1">Roles</h1>
              <div class="space-y-2">
                @foreach ($roles as $role)
                  <div class="flex items-center">
                    <input
                      type="checkbox"
                      name="roles[{{ $role->name }}]"
                      onchange="updateRole({{ $role->id }}, this.checked)"
                      {{ $user->hasRole($role->name) ? 'checked' : '' }}/>
                    <div class="ml-2">
                      {{ $role->name }}
                    </div>
                  </div>
                @endforeach
              </div>
            </div>
            <div class="w-full">
              <h1 class="font-bold text-2xl mb-1">Permissions</h1>
              <div class="grid grid-cols-3 gap-2">
                @foreach ($permissions as $permission)
                  <div class="inline-flex space-x-2">
                    <div>
                      <input class="disabled:opacity-50 disabled:text-gray-100"
                      type="checkbox"
                      name="permissions[{{ $permission->name }}]"
                      {{ $user->hasDirectPermission($permission->name) ? 'checked' : '' }}/>
                    </div>
                    <div class="inline-block">
                      {{ $permission->name }}
                    </div>
                  </div>
                @endforeach
              </div>
            </div>
          </div>

          <script>
            var roles = @json($roles);
            var permissions = @json($permissions->pluck('name'));
            var userRoles = @json($user->roles->pluck('id'));
            var userPermissions = @json($user->permissions->pluck('name'));
          </script>
          <script src="{{ asset('js/user.js') }}"></script>
        @endcan

        <x-button>
          Submit
        </x-button>
      </form>
    </div>
  </x-container>
</x-app-layout>