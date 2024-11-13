<div>
    <!-- Agent Name -->
    <x-formInput type="text" title="name" label="Name & Surname" model='name'/>
    <!-- id="title" -->
    @error('name')
        <p id="error-message" class="py-2 text-sm text-red-500">{{ $message }}</p>
    @enderror

    <!-- Agent email -->
    <x-formInput type="text" title="email" label="Email" model='email'/>
    <!-- id="title" -->
    @error('email')
        <p id="error-message" class="py-2 text-sm text-red-500">{{ $message }}</p>
    @enderror

    <!-- Agent phone number -->
    <x-formInput type="text" title="phoneNumber" label="Phone number" model='phoneNumber'/>
    <!-- id="title" -->
    @error('phoneNumber')
        <p id="error-message" class="py-2 text-sm text-red-500">{{ $message }}</p>
    @enderror
    <!-- Agent password -->
    <x-formInput type="password" title="password" label="New password" model='password' />
    <!-- id="title" -->

    <!-- Confirm agent password -->
    <x-formInput type="password" title="password" label="Confirm new password" model='confirmPass' />
    <!-- id="title" -->
    @error('password')
        <p id="error-message" class="py-2 text-sm text-red-500">{{ $message }}</p>
    @enderror
</div>
