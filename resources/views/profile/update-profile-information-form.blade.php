<x-jet-form-section submit="updateProfileInformation">
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

                <x-jet-label for="photo" value="{{ __('Photo') }}" />

                <!-- Current Profile Photo -->
                <div class="mt-2" x-show="! photoPreview">
                    <img src="{{ $this->user->profile_photo_url }}" alt="{{ $this->user->name }}" class="rounded-full h-20 w-20 object-cover">
                </div>

                <!-- New Profile Photo Preview -->
                <div class="mt-2" x-show="photoPreview">
                    <span class="block rounded-full w-20 h-20 bg-cover bg-no-repeat bg-center"
                          x-bind:style="'background-image: url(\'' + photoPreview + '\');'">
                    </span>
                </div>

                <x-jet-secondary-button class="mt-2 mr-2" type="button" x-on:click.prevent="$refs.photo.click()">
                    {{ __('Select A New Photo') }}
                </x-jet-secondary-button>

                @if ($this->user->profile_photo_path)
                    <x-jet-secondary-button type="button" class="mt-2" wire:click="deleteProfilePhoto">
                        {{ __('Remove Photo') }}
                    </x-jet-secondary-button>
                @endif

                <x-jet-input-error for="photo" class="mt-2" />
            </div>
        @endif

        <!-- Name -->
        <div class="col-span-6 sm:col-span-4">
            {{-- <x-jet-label for="name" value="{{ __('Name') }}" /> --}}
            <label for="name"> {{ __('Name') }} </label>
            <x-jet-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="state.name" autocomplete="name" />
            <x-jet-input-error for="name" class="mt-2" />
        </div>

        <!-- Email -->
        <div class="col-span-6 sm:col-span-4">
            <label for="email"> {{ __('Email') }} </label>
            {{-- 7/11/2021 --}}
            {{-- <x-jet-label for="email" value="{{ __('Email') }}" /> --}} 
            <x-jet-input id="email" type="email" class="mt-1 block w-full" wire:model.defer="state.email" />
            <x-jet-input-error for="email" class="mt-2" />
        </div>

        <!-- maxWalkDistance(int meters) 7/11/2021 -->
        <div class="col-span-6 sm:col-span-4">
            <label for="maxWalkDistance"> {{ __('Maximum distance to walk (meters)') }} </label>
            <x-jet-input id="maxWalkDistance" type="text" class="mt-1 block w-full" wire:model.defer="state.maxWalkDistance" autocomplete="maxWalkDistance" />
            <x-jet-input-error for="maxWalkDistance" class="mt-2" />
        </div>

        <!-- maxBikeDistance(int meters) 7/11/2021 -->
        <div class="col-span-6 sm:col-span-4">
            <label for="maxBikeDistance"> {{ __('Maximum distance to bike (meters)') }} </label>
            <x-jet-input id="maxBikeDistance" type="text" class="mt-1 block w-full" wire:model.defer="state.maxBikeDistance" autocomplete="maxBikeDistance" />
            <x-jet-input-error for="maxBikeDistance" class="mt-2" />
        </div>

        <!-- worstWeatherToWalk(int meters) 7/11/2021 -->
        <div class="col-span-6 sm:col-span-4">
        <label for="worstWeatherToWalk"> {{ __('Worst weather category to walk') }} </label>
        <x-jet-input id="worstWeatherToWalk" type="range" min="1" max="10" step="1" value="state.worstWeatherToWalk" class="mt-1 block w-full" wire:model.defer="state.worstWeatherToWalk" autocomplete="worstWeatherToWalk" oninput="onInput('worstWeatherToWalk')"/>
        <div id="worstWeatherToWalkIndicator" style="height:32px; position:relative"></div>
        <x-jet-input-error for="worstWeatherToWalk" class="mt-2" />
        </div> 

        <!-- worstWeatherToBike(int meters) 7/11/2021 -->
        <div class="col-span-6 sm:col-span-4">
        <label for="worstWeatherToBike"> {{ __('Worst weather category to bike') }} </label>
        <x-jet-input id="worstWeatherToBike" type="range" min="1" max="10" step="1" value="state.worstWeatherToBike" class="mt-1 block w-full" wire:model.defer="state.worstWeatherToBike" autocomplete="worstWeatherToBike" oninput="onInput('worstWeatherToBike')"/>
        <div id="worstWeatherToBikeIndicator" style="height:32px; position:relative"></div>
        <x-jet-input-error for="worstWeatherToBike" class="mt-2" />
        </div> 

        <script type="text/javascript" src="{{ asset('/js/profile.js') }}"></script>
    </x-slot>

    <x-slot name="actions">
        <x-jet-action-message class="mr-3" on="saved">
            {{ __('Saved.') }}
        </x-jet-action-message>

        <x-jet-button wire:loading.attr="disabled" wire:target="photo" onclick="setup(1000)">
            {{ __('Save') }}
        </x-jet-button>
    </x-slot>
</x-jet-form-section>
