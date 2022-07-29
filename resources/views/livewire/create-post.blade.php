<div>
    <x-jet-button class="bg-indigo-700 hover:bg-indigo-800" wire:click="$set('open', true)">
        New post
    </x-jet-button>

    <x-jet-dialog-modal wire:model="open">

        <x-slot name="title">
            Create new post
        </x-slot>

        <x-slot name="content">
            <div class="mb-3">
                <x-jet-label value="Post title" class="mb-1" />
                <x-jet-input wire:model.defer="title" type="text" class="w-full" />
                <x-jet-input-error class="text-xs py-1" for="title" />
            </div>

            <div class="mb-3">
                <x-jet-label value="Post content" class="mb-1" />
                <textarea wire:model.defer="content" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm w-full" rows="6"></textarea>
                <x-jet-input-error class="text-xs py-1" for="content" />
            </div>

            <div>
                <x-jet-label value="Image" class="mb-1" />
                <x-jet-input id="{{ $identifier }}" type="file" wire:model="image" class="text-sm" accept="image/*" />
                <x-jet-input-error class="text-xs py-1" for="image" />
            </div>

            <div wire:loading wire:target="image" class="mt-2 bg-blue-100 border border-blue-400 text-blue-700 px-2 py-1 rounded relative text-sm" role="alert">
                <strong class="font-bold">Uploading image.</strong>
                <span class="block sm:inline">Wait a few seconds while the image is processed...</span>
            </div>

            @if ($image)
                <div class="my-5 w-40">
                    <img src="{{ $image->temporaryUrl() }}" alt="Image preview">
                </div>
            @endif

        </x-slot>

        <x-slot name="footer">
            <div class="flex gap-3">
                <x-jet-danger-button wire:click="$set('open', false)">
                    Cancel
                </x-jet-danger-button>

                <x-jet-button class="bg-indigo-700 hover:bg-indigo-800" wire:click="save" wire:loading.attr="disabled" wire:target="save, image" >
                    Create post
                </x-jet-button>
            </div>
        </x-slot>

    </x-jet-dialog-modal>

</div>
