<section>
    <header>
        <h2 class="text-lg font-medium  d">
            {{ __('Update Password') }}
        </h2>

        <p class="mt-1 text-sm  ">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div>
                    <x-input-label for="update_password_current_password" class="form-label mt-5" :value="__('Current Password')" />
                    <x-text-input id="update_password_current_password" name="current_password" type="password" class="form-control mt-1 block w-full" autocomplete="current-password" />
                    <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
                </div>
            </div>
            <div class="col-lg-6 col-md-6"></div>
            <div class="col-lg-6 col-md-6">
                <div>
                    <x-input-label for="update_password_password" class="form-label mt-5" :value="__('New Password')" />
                    <x-text-input id="update_password_password" name="password" type="password" class="form-control mt-1 block w-full" autocomplete="new-password" />
                    <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
                </div>
            </div>
            <div class="col-lg-6 col-md-6"></div>
            <div class="col-lg-6 col-md-6">
                <div>
                    <x-input-label for="update_password_password_confirmation" class="form-label mt-5" :value="__('Confirm Password')" />
                    <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="form-control mt-1 block w-full" autocomplete="new-password" />
                    <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
                </div>

            </div>
        </div>
        <div class="flex items-center gap-4 mt-10">
            <x-primary-button class="btn btn-primary ">{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
