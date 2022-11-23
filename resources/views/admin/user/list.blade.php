<x-app-admin-layout>
    <x-slot name="header">
        <h2 class=" pl-64 font-semibold text-xl text-gray-800 leading-tight">
            {{ __('List User') }}
        </h2>
    </x-slot>
    <div class="ml-64 py-12">
        <div class=" mx-auto sm:px-6 lg:px-8">
            <form class="grid grid-cols-12 gap-2" method="get" action="{{route('admin.user.list')}}">
                <input type="text" id="search"
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 mb-2 col-span-2"
                       placeholder="Name" name="search">
                <button type="submit" class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">Search</button>
            </form>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <div class="overflow-x-auto relative">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400" id="datatables-user">
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="py-3 px-6">
                                    Name
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Email
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Roles
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Action
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <td class="py-4 px-6">
                                        {{$user->name}}
                                    </td>
                                    <td class="py-4 px-6">
                                        {{$user->email}}
                                    </td>
                                    <td class="py-4 px-6">
                                        @foreach($user->roles as $role)
                                            @if($loop->index == (count($user->roles) - 1))
                                                {{$role->role}}
                                            @else
                                                {{$role->role}},
                                            @endif

                                        @endforeach
                                    </td>
                                    <td class="py-4 px-6">
                                        <div class="flex">
                                            <a href="{{route('admin.user.update.page', $user->id)}}">
                                                <svg class="w-4 h-4 m-2" fill="none" stroke="currentColor"
                                                     viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          stroke-width="2"
                                                          d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                                                </svg>
                                            </a>
                                            <form class="col"
                                                  action="{{route('admin.user.delete',$user->id) }}"
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
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="mt-2">
                            {{ $users->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-admin-layout>
