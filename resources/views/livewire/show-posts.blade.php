<div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- COMPONENTE TABLE --}}
        <x-table>

            {{-- BARRA SUPERIOR --}}
            <div class="px-6 py-4 flex gap-2 items-center">
                <div class="flex items-center">
                    <span class="text-gray-500">Show</span>
                    <select wire:model="count" class="mx-2 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                    <span class="text-gray-500">results</span>
                </div>
                {{-- <input type="text" wire:model="search" placeholder="Filter your search here..."> --}}
                <x-jet-input wire:model="search" type="text" placeholder="Filter your search here..." class="flex-1 py-1" />
                {{-- @livewire('create-post') --}}
                <livewire:create-post />
            </div>

            {{-- TABLE --}}
            @if ($posts->count())
                <table class="min-w-full divide-y divide-gray-200">

                    {{-- THEAD --}}
                    <thead class="bg-gray-50">
                        <tr>
                            <th wire:click="order('id')"
                                class="px-6 py-3 bg-gray-200 text-left text-sm font-bold text-gray-500 uppercase tracking-wider cursor-pointer">
                                ID
                            </th>
                            <th wire:click="order('title')"
                                class="px-6 py-3 bg-gray-200 text-left text-sm font-bold text-gray-500 uppercase tracking-wider cursor-pointer">
                                Title
                            </th>
                            <th wire:click="order('content')"
                                class="px-6 py-3 bg-gray-200 text-left text-sm font-bold text-gray-500 uppercase tracking-wider cursor-pointer">
                                Content
                            </th>
                            <th
                                class="px-6 py-3 bg-gray-200 text-left text-sm font-bold text-gray-500 uppercase tracking-wider">
                                Action
                            </th>
                        </tr>
                    </thead>

                    {{-- TBODY --}}
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($posts as $post)
                            <tr>
                                <td class="px-6 py-3">
                                    <div class="text-sm text-gray-900">
                                        {{ $post->id }}
                                    </div>
                                </td>
                                <td class="px-6 py-3">
                                    <div class="text-sm text-gray-900">
                                        {{ $post->title }}
                                    </div>
                                </td>
                                <td class="px-6 py-3">
                                    <div class="text-sm text-gray-900">
                                        {{ $post->content }}
                                    </div>
                                </td>
                                <td class="px-6 py-3">
                                    @livewire('edit-post', ['post' => $post], key($post->id))
                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>
            @else
                <div class="px-6 py-4">
                    <p class="text-center text-gray-600">There are no matches. Try again with other terms!</p>
                </div>
            @endif

            @if ($posts->hasPages())
                <div class="px-6 py-4">
                    {{ $posts->links() }}
                </div>
            @endif

        </x-table>

    </div>
</div>
