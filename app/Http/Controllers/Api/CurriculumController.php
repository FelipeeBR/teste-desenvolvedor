<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Exception;
use App\Services\CurriculumService;
use App\Http\Requests\CurriculumRequest;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class CurriculumController extends Controller
{
    public function store(CurriculumRequest $request, CurriculumService $service) {
        try {
            if($request->hasFile('file')) {
                $file = $request->file('file');
                $fileName = time().'_'.$file->getClientOriginalName();
                $filePath = $file->storeAs('curriculums', $fileName, 'public');
                
                $validated['file_name'] = $fileName;
                $validated['file_path'] = 'storage/'.$filePath;
            }
            $curriculum = $service->create($request->all());

            return response()->json([
                'message' => 'Curriculo enviado com sucesso!',
                'curriculum' => $curriculum
            ], Response::HTTP_CREATED);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_UNPROCESSABLE_ENTITY);
        } catch (ValidationException $e) {
            return response()->json([
                'error' => $e->errors()
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }
}

