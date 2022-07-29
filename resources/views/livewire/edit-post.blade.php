<div>
    <div class="flex">
        <a class="px-2 rounded cursor-pointer hover:text-indigo-600" wire:click="$set('open', true)">
            <i class="fa-solid fa-pen-to-square"></i>
        </a>

        <a class="px-2 rounded cursor-pointer hover:text-red-600">
            <i class="fa-solid fa-trash-can"></i>
        </a>
    </div>


    <x-jet-dialog-modal wire:model="open">

        <x-slot name="title" class="text-center">
            Edit post
        </x-slot>

        <x-slot name="content">
            <div class="mb-3">
                <x-jet-label value="Post title" class="mb-1" />
                <x-jet-input wire:model="title" type="text" class="w-full" />
                <x-jet-input-error class="text-xs py-1" for="title" />
            </div>

            <div class="mb-3">
                <x-jet-label value="Post content" class="mb-1" />
                <textarea wire:model="content" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm w-full" rows="6"></textarea>
                <x-jet-input-error class="text-xs py-1" for="content" />
            </div>

            {{-- IMAGENES --}}
            <div class="my-5 w-40">
                <x-jet-label value="Current image" class="mb-1" />
                <img src="{{ asset('storage/posts/'.$image) }}" class="rounded-lg" alt="Current image">
            </div>

            <x-jet-input id="{{ $identifier }}" type="file" wire:model="newImage" class="text-sm" accept="image/*" />
            <x-jet-input-error class="text-xs py-1" for="newImage" />

            @if ($newImage)
                <div class="my-5 w-40">
                    <x-jet-label value="New image" class="mb-1" />
                    <img src="{{ $newImage->temporaryUrl() }}" class="rounded-lg" alt="New image">
                </div>
            @endif

        </x-slot>

        <x-slot name="footer">
            <div class="flex gap-3">
                <x-jet-danger-button wire:click="$set('open', false)">
                    Cancel
                </x-jet-danger-button>

                <x-jet-button class="bg-indigo-700 hover:bg-indigo-800" wire:click="save" wire:loading.attr="disabled" wire:target="save" >
                    Save changes
                </x-jet-button>
            </div>
        </x-slot>

    </x-jet-dialog-modal>

    @push('js')
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        {{-- <script>
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                )
                }
            })
        </script> --}}
    @endpush

</div>
