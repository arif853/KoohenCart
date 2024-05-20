{{-- <x-app-layout> --}}
@extends('layouts.admin')
@section('title','Profile Update')
@section('content')
{{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
<link rel="stylesheet" href="{{asset('')}}admin/assets/css/main.css?v=3.4">

<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ __('Profile') }}
    </h2>
</x-slot>

<div class="">
    <div class=" mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800  sm:rounded-lg">
            <div class="max-w-xl">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800  sm:rounded-lg">
            <div class="max-w-xl">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        {{-- <div class="p-4 sm:p-8 bg-white dark:bg-gray-800  sm:rounded-lg">
            <div class="max-w-xl">
                @include('profile.partials.delete-user-form')
            </div>
        </div> --}}
    </div>
</div>
@endsection

{{-- </x-app-layout> --}}
