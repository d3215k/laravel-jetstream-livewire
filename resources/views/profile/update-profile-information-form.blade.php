<x-form-section submit="updateProfileInformation">
    <x-slot name="title">
        {{ __('Profile Information') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Update your account\'s profile information and email address.') }}
    </x-slot>

    <x-slot name="form">
        <!-- Profile Photo -->
        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
            <div x-data="{photoName: null, photoPreview: null}" class="col-span-6 sm:col-span-4">
                <!-- Profile Photo File Input -->
                <input type="file" class="hidden"
                            wire:model="photo"
                            x-ref="photo"
                            x-on:change="
                                    photoName = $refs.photo.files[0].name;
                                    const reader = new FileReader();
                                    reader.onload = (e) => {
                                        photoPreview = e.target.result;
                                    };
                                    reader.readAsDataURL($refs.photo.files[0]);
                            " />

                <x-label for="photo" value="{{ __('Photo') }}" />

                <!-- Current Profile Photo -->
                <div class="mt-2" x-show="! photoPreview">
                    <img src="{{ $this->user->profile_photo_url }}" alt="{{ $this->user->name }}" class="rounded-full h-20 w-20 object-cover">
                </div>

                <!-- New Profile Photo Preview -->
                <div class="mt-2" x-show="photoPreview" style="display: none;">
                    <span class="block rounded-full w-20 h-20 bg-cover bg-no-repeat bg-center"
                          x-bind:style="'background-image: url(\'' + photoPreview + '\');'">
                    </span>
                </div>

                <x-secondary-button class="mt-2 mr-2" type="button" x-on:click.prevent="$refs.photo.click()">
                    {{ __('Select A New Photo') }}
                </x-secondary-button>

                @if ($this->user->profile_photo_path)
                    <x-secondary-button type="button" class="mt-2" wire:click="deleteProfilePhoto">
                        {{ __('Remove Photo') }}
                    </x-secondary-button>
                @endif

                <x-input-error for="photo" class="mt-2" />
            </div>
        @endif

        <div class="col-span-6 sm:col-span-4">
            <div class="space-y-6 ">
                {{-- <fieldset>
                    <legend class="sr-only">Hobbies</legend>
                    <div class="text-sm font-semibold text-gray-700" aria-hidden="true">Hobbies</div>
                    <div class="mt-4 space-y-4">
                    <div class="flex items-start">
                        <div class="flex h-5 items-center">
                            <input id="sport" name="sport" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                        </div>
                        <div class="ml-3 text-sm">
                        <label for="sport" class="font-medium text-gray-700">Sport</label>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <div class="flex h-5 items-center">
                            <input id="reading" name="reading" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                        </div>
                        <div class="ml-3 text-sm">
                        <label for="reading" class="font-medium text-gray-700">Reading</label>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <div class="flex h-5 items-center">
                            <input id="music" name="music" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                        </div>
                        <div class="ml-3 text-sm">
                        <label for="music" class="font-medium text-gray-700">Music</label>
                        </div>
                    </div>
                    </div>
                </fieldset> --}}
                <fieldset>
                    <legend class="contents text-sm font-semibold text-gray-700">Gender</legend>
                    <div class="mt-4 gap-6 flex items-center ">
                        <div class="flex items-center">
                            <input wire:model.defer="state.gender" value="male" id="male" name="push-notifications" type="radio" class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-500">
                            <label for="male" class="ml-3 block text-sm font-medium text-gray-700">Male</label>
                        </div>
                        <div class="flex items-center">
                            <input wire:model.defer="state.gender" value="female" id="female" name="push-notifications" type="radio" class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-500">
                            <label for="female" class="ml-3 block text-sm font-medium text-gray-700">Female</label>
                        </div>
                    </div>
                </fieldset>
            </div>

        </div>

        <!-- Name -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="name" value="{{ __('Name') }}" />
            <x-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="state.name" autocomplete="name" />
            <x-input-error for="name" class="mt-2" />
        </div>

        <!-- Email -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="email" value="{{ __('Email') }}" />
            <x-input id="email" type="email" class="mt-1 block w-full" wire:model.defer="state.email" autocomplete="username" />
            <x-input-error for="email" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <label for="city" class="block text-sm font-medium text-gray-700">City</label>
            <select wire:model.defer="state.city" id="city" name="city" autocomplete="country-name" class="mt-1 block w-full rounded-md border border-gray-300 bg-white py-2 px-3 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                <option value="">Select One</option>
                <option value="jakarta">Jakarta</option>
                <option value="bandung">Bandung</option>
                <option value="yogyakarta">Yogyakarta</option>
            </select>
        </div>

    </x-slot>

    <x-slot name="actions">
        <x-action-message class="mr-3" on="saved">
            {{ __('Saved.') }}
        </x-action-message>

        <x-button wire:loading.attr="disabled" wire:target="photo">
            {{ __('Save') }}
        </x-button>
    </x-slot>
</x-form-section>
