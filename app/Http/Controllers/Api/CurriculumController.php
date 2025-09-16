<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Curriculum;
use Illuminate\Http\Request;
use App\Http\Enums\Education;
use Exception;

class CurriculumController extends Controller
{
    public function store(Request $request) {
        try {
            $validated = $request->validate([
                'name' => 'required|string',
                'email' => 'required|email',
                'phone' => 'required|string',
                'position' => 'required|string',
                'education' => 'required|in:' . implode(',', array_column(Education::cases(), 'value')),
                'observations' => 'nullable|string',
                'file' => 'nullable|file|mimes:pdf,doc,docx|max:1024',
            ]);

            if($request->hasFile('file')) {
                $file = $request->file('file');
                $fileName = time().'_'.$file->getClientOriginalName();
                $filePath = $file->storeAs('curriculums', $fileName, 'public');

                $validated['file_name'] = $fileName;
                $validated['file_path'] = 'storage/'.$filePath;
            }

            $curriculum = Curriculum::create($validated);

            return response()->json($curriculum, 201);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 422);
        }
    }
}
