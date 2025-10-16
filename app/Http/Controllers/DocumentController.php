<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    // Show all uploaded documents
    public function index()
    {
        $documents = Document::all();
        return view('documents.index', compact('documents'));
    }

    // Handle file upload
    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|file|max:10240', // 10MB max
        ]);

        $file = $request->file('file');
        $path = $file->store('documents');

        Document::create([
            'original_name' => $file->getClientOriginalName(),
            'path' => $path,
            'size' => $file->getSize(),
        ]);

        return redirect()->route('documents.index')->with('success', 'File uploaded successfully!');
    }

    public function download($id)
{
    $document = Document::findOrFail($id);
    return Storage::download($document->path, $document->original_name);
}

public function delete($id)
{
    $document = Document::findOrFail($id);

    // Delete the physical file
    Storage::delete($document->path);

    // Remove record from database
    $document->delete();

    return redirect('/')->with('success', 'Document deleted successfully!');
}
}
