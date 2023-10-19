<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <x-rich-text-trix-styles />
        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    </head>
    <body class="antialiased">
        <div class="relative min-h-screen bg-dots-darker bg-center bg-gray-100 selection:bg-red-500 selection:text-white text-slate-800">
        @if (session('success'))
            <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif
        @if (session('error'))
            <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif

            <div class="max-w-7xl mx-auto p-6 lg:p-8">
                <div class="mt-16">
                    <form method="POST" action="#" enctype="multipart/form-data">
                        <div class="border p-8">
                            @csrf
                            <label
                                class="block mb-2 text-sm font-medium"
                                for="title"
                            >
                                Title:
                            </label>
                            <input
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                                    focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                id="title"
                                name="title"
                                required
                                type="text"
                                value="{!! $post->title ?? old('title') !!}"
                            >
                            <x-trix-field id="content" name="content" />
                        </div>
                        <div class="flex gap-6 mb-4 mt-6 justify-end">
                            <button
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300
                                    font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2"
                                type="submit"
                            >
                                Save
                            </button>
                        </div>
                    </form>
                </div>

                <div class="text-center text-sm sm:text-left">
                    <h2 class="text-2xl font-extrabold">Posts</h2>
                    @if( $posts )
                    <ul class="list-disc">
                        @foreach($posts as $index => $post)
                            <li class="whitespace-nowrap px-6 py-4">
                            <h3>{{ $post->title }}</h3>
                            <div>{!! $post->content !!}</div>
                            </li>
                        @endforeach
                    </ul>
                    @else
                        <div class="whitespace-nowrap px-6 py-4">No posts found.</div>
                    @endif
                </div>
            </div>
        </div>
    </body>
</html>
