<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Group\GroupRequest;
use App\Http\Requests\Api\Lecture\LectureStoreRequest;
use App\Http\Requests\Api\Lecture\LectureUpdateRequest;
use App\Http\Resources\GroupResource;
use App\Http\Resources\LectureResource;
use App\Models\Group;
use App\Models\Lecture;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class LectureController extends Controller
{
    public function __construct(protected Lecture $lecture)
    {
    }

    public function index(): AnonymousResourceCollection
    {
        return LectureResource::collection($this->lecture->all());
    }

    public function show(int $id): LectureResource
    {
        return LectureResource::make($this->lecture->find($id));
    }


    public function store(LectureStoreRequest $request): JsonResponse
    {
        $data = $request->validated();
        $this->lecture::firstOrCreate($data);
        return response()->json('Лекция была успешно создана');
    }

    public function update(LectureUpdateRequest $request,Lecture $lecture): JsonResponse
    {
        $data = $request->validated();
        $lecture->update($data);
        if($data) {
            $lecture->update($data);
            return response()->json('Лекция была успешна обновлена');
        }
        return response()->json('Введите название или описание');
    }

    public function delete(Lecture $lecture): JsonResponse
    {
        $lecture->delete();
        return response()->json('done') ;
    }
}
