<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DocFlow - Simple Document Manager</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-50 text-gray-800">
    <div class="max-w-4xl mx-auto mt-8 p-6 bg-white rounded-lg shadow">
        <h1 class="text-2xl font-semibold mb-4">📄 DocFlow - Simple Document Manager</h1>

        @if(session('success'))
            <div class="bg-green-100 border border-green-300 text-green-800 px-4 py-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form action="/upload" method="POST" enctype="multipart/form-data" class="flex items-center gap-3 mb-6">
            @csrf
            <input type="file" name="file" class="border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-blue-300">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-medium px-4 py-2 rounded transition">
                Upload
            </button>
        </form>

        <table class="min-w-full border border-gray-200 rounded-lg overflow-hidden">
            <thead class="bg-gray-100 text-left">
                <tr>
                    <th class="py-2 px-4">Name</th>
                    <th class="py-2 px-4">Size (KB)</th>
                    <th class="py-2 px-4">Path</th>
                    <th class="py-2 px-4 text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($documents as $doc)
                    <tr class="border-t hover:bg-gray-50">
                    <tr class="border-t hover:bg-gray-50">
    <td class="py-3 px-4">{{ $doc->original_name }}</td>
    <td class="py-3 px-4">{{ number_format($doc->size / 1024, 2) }}</td>
    <td class="py-3 px-4 text-sm text-gray-500 truncate max-w-xs">{{ $doc->path }}</td>
    <td class="py-3 px-4">
        <div class="flex items-center justify-end gap-2">
            <a href="{{ route('documents.download', $doc->id) }}"
               class="bg-emerald-600 hover:bg-emerald-700 text-white text-sm px-3 py-1.5 rounded transition">
               Download
            </a>
            <form action="{{ route('documents.delete', $doc->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="bg-red-600 hover:bg-red-700 text-white text-sm px-3 py-1.5 rounded transition">
                    Delete
                </button>
            </form>
        </div>
    </td>
</tr>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
