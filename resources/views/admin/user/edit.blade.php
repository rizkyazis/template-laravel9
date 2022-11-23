<x-app-admin-layout>
    <x-slot name="header">
        <h2 class=" pl-64 font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Update User') }}
        </h2>
    </x-slot>

    <div class="ml-64 py-12">
        <div class=" mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="overflow-x-auto relative">
                        <header>
                            <h2 class="text-lg font-medium text-gray-900">Manage User Information</h2>
                            <p class="mt-1 text-sm text-gray-600">Update user account's information.</p>
                        </header>
                        <form method="post" action="{{ route('admin.user.update', $user->id) }}" class="mt-6 space-y-6">
                            @csrf
                            @method('patch')
                            <div>
                                <x-input-label for="name" :value="__('Name')"/>
                                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                                              :value="old('name', $user->name)" required autofocus autocomplete="name"/>
                                <x-input-error class="mt-2" :messages="$errors->get('name')"/>
                            </div>

                            <div>
                                <x-input-label for="email" :value="__('Email')"/>
                                <x-text-input id="email" name="email" type="email" class="mt-1 block w-full"
                                              :value="old('email', $user->email)" required autocomplete="email"/>
                                <x-input-error class="mt-2" :messages="$errors->get('email')"/>
                            </div>

                            <div class="flex items-center gap-4">
                                <button type="submit"
                                        class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">
                                    Save
                                </button>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="ml-64">
        <div class=" mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="overflow-x-auto relative">
                        <header>
                            <h2 class="text-lg font-medium text-gray-900">Manage User Role</h2>
                            <p class="mt-1 text-sm text-gray-600">Update user role</p>
                        </header>
                        <button
                            class="mt-2 text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700"
                            type="button" data-modal-toggle="popup-modal">
                            Add Role
                        </button>
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 mt-6"
                               id="datatables-user">
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="py-3 px-6">
                                    Code
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Role
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Action
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($user->roles as $role)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <td class="py-4 px-6">
                                        {{$role->code}}
                                    </td>
                                    <td class="py-4 px-6">
                                        {{$role->role}}
                                    </td>
                                    <td class="py-4 px-6">
                                        <div class="flex">
                                            <form class="col"
                                                  action="{{route('admin.user.role.delete',[$user->id, $role->id]) }}"
                                                  method="post">
                                                @method('delete')
                                                @csrf
                                                <button type="submit">
                                                    <svg class="w-4 h-4 m-2" fill="none" stroke="currentColor"
                                                         viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                              stroke-width="2"
                                                              d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                    </svg>
                                                </button>
                                            </form>

                                        </div>
                                    </td>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Main modal -->
    <div id="popup-modal" aria-hidden="true" tabindex="-1"
         class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 md:inset-0 h-modal md:h-full">
        <div class="relative p-4 w-full max-w-md h-full md:h-auto">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <button type="button"
                        class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white"
                        data-modal-toggle="popup-modal">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                              d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                              clip-rule="evenodd"></path>
                    </svg>
                </button>
                <div class="p-6 text-center">
                    <form action="{{route('admin.user.role.add',$user->id)}}" method="post">
                        @csrf
                        <label for="roles" class="block mb-4 text-sm font-medium text-gray-900 dark:text-white">Select a
                            Role</label>
                        <select id="roles" name="idRole"
                                class="mb-4 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option selected disabled>Choose a Role</option>
                            @foreach($roles as $role)
                                <option value="{{$role->id}}">{{$role->code}} - {{$role->role}}</option>
                            @endforeach
                        </select>
                        <button data-modal-toggle="popup-modal" type="submit"
                                class="text-white bg-gray-800 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:bg-gray-300 dark:focus:bg-gray-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                            Save
                        </button>
                        <button data-modal-toggle="popup-modal" type="button"
                                class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                            Cancel
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-app-admin-layout>
