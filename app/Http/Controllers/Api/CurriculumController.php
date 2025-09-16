<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Exception;
use App\Services\CurriculumService;
use App\Http\Requests\CurriculumRequest;
use App\Jobs\SendCurriculumEmail;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class CurriculumController extends Controller
{
    public function store(CurriculumRequest $request, CurriculumService $service) {
        try {
            $validated = $request->validated();

            if($request->hasFile('file')) {
                $file = $request->file('file');
                $fileName = time().'_'.$file->getClientOriginalName();
                $filePath = $file->storeAs('curriculums', $fileName, 'public');

                $validated['file_name'] = $fileName;
                $validated['file_path'] = 'storage/'.$filePath;
                $validated['file_real_path'] = storage_path('app/public/'.$filePath);
            }

            $curriculum = $service->create($validated);

            if(!empty($validated['file_path'])) {
                $emailData = [
                    'email' => $validated['email'],
                    'file_real_path' => $validated['file_real_path'],
                    'name' => $validated['name'],
                    'phone' => $validated['phone'],
                    'position' => $validated['position'],
                    'education' => $validated['education'],
                    'observations' => $validated['observations'] ?? null,
                    'file_name' => $validated['file_name']
                ];
                SendCurriculumEmail::dispatch($emailData);
            }

            return response()->json([
                'message' => 'Curriculo enviado com sucesso!',
                'curriculum' => $curriculum
            ], Response::HTTP_CREATED);

        } catch (ValidationException $e) {
            return response()->json(['error' => $e->errors()], Response::HTTP_UNPROCESSABLE_ENTITY);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }
}

