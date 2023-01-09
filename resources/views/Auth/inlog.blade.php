<x-layout>
    <x-flexRow>
        <div class=" shadow-md  rounded-md  p-5">
            <form action="" method="post" class=" flex flex-col ">
                @csrf
                <label class="font-bold text-lg p-1" for="email">Email:</label>
                <input class="border border-blue-400 rounded-md h-5" type="email" name="email" id="email" required
                    autofocus>
                <label class="font-bold text-lg p-1" for="password">Password:</label>

                <input class="border border-blue-400 rounded-md h-5" type="password" name="password" id="password"
                    required>
                <button class="mt-5 bg-blue-400 text-white rounded-md" type="submit">Login</button>
            </form>
        </div>
    </x-flexRow>
</x-layout>
