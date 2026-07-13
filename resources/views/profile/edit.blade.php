<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 mb-0">Profile</h2>
    </x-slot>

    <div class="col-md-8">
        <div class="card cc-card p-4 mb-4">
            @include('profile.partials.update-profile-information-form')
        </div>
        <div class="card cc-card p-4 mb-4">
            @include('profile.partials.update-password-form')
        </div>
        <div class="card cc-card p-4">
            @include('profile.partials.delete-user-form')
        </div>
    </div>
</x-app-layout>