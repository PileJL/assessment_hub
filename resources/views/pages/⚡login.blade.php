<?php

use Livewire\Component;
use Livewire\Attributes\Validate;

new class extends Component
{
    #[Validate('required|email')]
    public $email = '';
    #[Validate('required')]
    public $password = '';
    public $loginMessage ='';

    public function authenticate()
    {
        $this->validate();

        $valid = \Auth::attempt(['email' => $this->email, 'password' => $this->password]);

        if($valid) {
            $this->redirectIntended('/admin-dashboard');
        }
        else {
            $this->loginMessage = 'Incorrect email and/or password.';
        }
    }
};
?>

<div class="flex flex-col min-h-screen justify-center items-center pb-20">
    <div class="space-y-4 min-w-full sm:min-w-fit">
        {{-- back button --}}
        <a x-data="{ loading: false }" @click="loading = true" href="/" wire:navigate class="flex gap-3 items-center text-primary font-medium rounded-lg hover:bg-green hover:text-white px-3 py-1 w-fit">
            <x-icons.back size="size-3.5"/>
            <span x-show="!loading">Back</span>
            <span x-show="loading"><x-icons.loading  size="size-5" /></span>
        </a>
        {{-- form container --}}
        <form wire:submit="authenticate">
            <div class="flex flex-col gap-1 justify-center items-center rounded-xl border-2 border-muted/30 bg-white sm:px-5 p-6 sm:pt-8 sm:pb-9 w-full sm:w-sm">
                {{-- login icon --}}
                <div class="bg-green rounded-xl px-3 py-2.5 text-white w-fit">
                    <x-icons.login/>
                </div>
                {{-- header --}}
                <div class="mt-2 text-primary font-semibold text-xl">
                    Admin Login
                </div>
                <div class="text-muted font-normal text-sm">
                    Sign in to manage assessment data
                </div>
                {{-- email field --}}
                <x-label-input class="mt-6" label="Email" propertyName="email" type="email" placeholder="youremail@mail.com" />
                {{-- password field --}}
                <label class="text-primary font-medium text-sm mt-4 w-full tracking-wide">Password</label>
                <div class="relative w-full mt-1" x-data="{ show: false }">
                    <input wire:model="password" :type="show ? 'text' : 'password'" placeholder="yourpassword"
                        class="w-full border border-muted/30 bg-background rounded-lg px-3 py-2 pr-10 font-normal text-primary focus:border-secondary/50 focus:ring-1 focus:ring-secondary/50">
                    
                    <button type="button" @click="show = !show" 
                        class="absolute inset-y-0 right-0 pr-3 flex items-center text-muted hover:text-primary transition-colors outline-none">
                        <div x-show="!show"><x-icons.eye-slashed size="size-5"/></div>
                        <div x-show="show" x-cloak><x-icons.eye size="size-5"/></div>
                    </button>
                </div>
                @error('password') <span class="text-red-500 text-xs mt-1 self-start">{{ $message }}</span> @enderror
                {{-- Login Failed Message --}}
                @if($loginMessage)
                    <div class="mt-3 text-red-500 text-sm font-normal w-full text-center">
                        {{ $loginMessage }}
                    </div>
                @endif
                {{-- signin button --}}
                <button type="submit" wire:loading.attr="disabled" class="w-full mt-3 font-semibold text-white text-md rounded-lg bg-secondary py-2.5 tracking-wide hover:cursor-pointer">
                    <span wire:loading.remove>Sign In</span>
                    <span wire:loading>Signing in...</span>
                </button>
            </div>
        </form>
    </div>
</div>