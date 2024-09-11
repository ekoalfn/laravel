<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Update Password</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="w-full max-w-sm mx-auto p-6 bg-white rounded-lg shadow-lg">
        @if ($errors->any())
            <div class="alert alert-danger fade show mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                @foreach ($errors->all() as $error)
                    <span class="block sm:inline">{{ $error }}</span>
                @endforeach
                <button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3" data-bs-dismiss="alert" aria-label="Close">
                    <span class="text-red-700">&times;</span>
                </button>
            </div>            
        @endif

        @if (session()->has('status'))
            <div class="alert alert-success alert-dismissible fade show mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                {{ session()->get('status') }}
                <button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3" data-bs-dismiss="alert" aria-label="Close">
                    <span class="text-green-700">&times;</span>
                </button>
            </div>
        @endif

        <form action="{{route('password.update')}}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label for="password" class="block text-gray-700 font-medium">Password</label>
                <input type="password" name="password" id="password" class="form-control w-full mt-1 px-4 py-2 border rounded-md focus:ring focus:ring-indigo-200">
            </div>
            
            <div>
                <input type="hidden" name="token" value="{{request()->token}}">
                <input type="hidden" name="email" value="{{request()->email}}">
                <label for="password_confirmation" class="block text-gray-700 font-medium">Password Confirmation</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control w-full mt-1 px-4 py-2 border rounded-md focus:ring focus:ring-indigo-200">
                <p id="password-match-message" class="text-sm mt-2 text-red-500 hidden">Passwords do not match.</p>
            </div>

            <input type="submit" value="Update Password" class="w-full bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-500 transition-colors cursor-pointer">
        </form>
    </div>

    <script>
        const password = document.getElementById('password');
        const passwordConfirmation = document.getElementById('password_confirmation');
        const message = document.getElementById('password-match-message');

        passwordConfirmation.addEventListener('input', function() {
            if (password.value !== passwordConfirmation.value) {
                message.classList.remove('hidden');
            } else {
                message.classList.add('hidden');
            }
        });
    </script>
</body>
</html>
