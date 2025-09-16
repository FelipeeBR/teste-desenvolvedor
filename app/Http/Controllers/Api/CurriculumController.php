<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Exception;
use App\Services\CurriculumService;
use App\Http\Requests\CurriculumRequest;
use App\Mail\CurriculumMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log;

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
            Log::info('Curriculum created', ['curriculum' => $curriculum]);
            if(!empty($validated['file_path'])) {
                Mail::to($validated['email'])
                    ->send(new CurriculumMail($validated['file_real_path'], $validated));
            }

            return response()->json([
                'message' => 'Curriculo enviado com sucesso!',
                'curriculum' => $curriculum
            ], Response::HTTP_CREATED);

        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_UNPROCESSABLE_ENTITY);
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->errors()], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }
}

