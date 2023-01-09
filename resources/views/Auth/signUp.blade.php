<x-layout>
    <x-flexRow>
        <div class=" shadow-md rounded-md ">
            <form action="" method="post" class="flex flex-col p-5">
                @csrf
                <label class="font-bold text-lg p-1" for="name">Name:</label>
                <input class="border border-blue-400 rounded-md h-5" type="text" id="Name" name="name"
                    value="{{ old('name') }}" autofocus>
                @error('name')
                    <div class="text-red-400">{{ $message }}</div>
                @enderror
                <label class="font-bold text-lg p-1" for="email">Email:</label>
                <input class="border border-blue-400 rounded-md h-5" type="text" id="email" name="email"
                    value="{{ old('email') }}">
                @error('email')
                    <div class="text-red-400">{{ $message }}</div>
                @enderror
                <label class="font-bold text-lg p-1" for="password">Password:</label>
                <input class="border border-blue-400 rounded-md h-5" type="password" id="password" name="password">
                @error('password')
                    <div class="text-red-400">{{ $message }}</div>
                @enderror
                <label class="font-bold text-lg p-1" for="confirm_password">Confirm password:</label>
                <input class="border border-blue-400 rounded-md h-5" type="password" id="confirm_password"
                    name="confirm_password">
                <button class="mt-5 bg-blue-400 text-white rounded-md" type="submit">Sign-up</button>
            </form>
        </div>
    </x-flexRow>
</x-layout>
