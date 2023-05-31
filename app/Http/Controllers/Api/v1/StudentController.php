<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Student\StudentStoreRequest;
use App\Http\Requests\Api\Student\StudentUpdateRequest;
use App\Http\Resources\StudentResource;
use App\Models\Student;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;


class StudentController extends Controller
{
    public function __construct(protected Student $student)
    {
    }

    public function index(): AnonymousResourceCollection
    {
        return StudentResource::collection($this->student->all());
    }

    public function show(int $id): StudentResource
    {
        return StudentResource::make($this->student::with(['group.lectures'])->find($id));
    }

    public function store(StudentStoreRequest $request): JsonResponse
    {
        $data = $request->validated();
        $this->student::firstOrCreate($data);
        return response()->json('Студент был успешно создан');

    }

    public function update(StudentUpdateRequest $request,Student $student): JsonResponse
    {
        $data = $request->validated();
        if($data) {
            $student->update($data);
            return response()->json('Студент успешно обновлен');
        }
        return response()->json('Введите имя или класс');
    }



    public function delete(Student $student): JsonResponse
    {
        $student->delete();
        return response()->json('done') ;
    }

}
