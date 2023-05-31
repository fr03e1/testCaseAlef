<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Group\GroupRequest;
use App\Http\Requests\Api\StudyPlan\StudyPlanStoreRequest;
use App\Http\Resources\GroupResource;
use App\Models\Group;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class GroupController extends Controller
{
    public function __construct(protected Group $group)
    {
    }

    public function index(): AnonymousResourceCollection
    {
        return GroupResource::collection($this->group->all());
    }

    public function show(int $id): GroupResource
    {
        return GroupResource::make($this->group::with(['students'])->find($id));
    }


    public function store(GroupRequest $request): JsonResponse
    {
        $data = $request->validated();
        $this->group::firstOrCreate($data);
        return response()->json('Класс был успешно создан');
    }

    public function update(GroupRequest $request, Group $group): JsonResponse
    {
        $data = $request->validated();

        $group->update($data);
        return response()->json('Класс был успешно обновлен');
    }


    public function delete(Group $group): JsonResponse
    {
        $group->delete();
        return response()->json('done');
    }

    public function lectures(int $id): GroupResource
    {
        return GroupResource::make($this->group::with(['lectures'])->find($id));
    }

    public function storeStudyPlan(StudyPlanStoreRequest $storeRequest): JsonResponse
    {
        $data = $storeRequest->validated();

        if ($data) {
            $group = $this->group->find($data['study_plan'][0]["group_id"]);
            $group->lectures()->attach($data['study_plan'][0]["lecture_id"], [
                'order' => $data['study_plan'][0]["order"],
            ]);

            return response()->json('Учебный план создан');
        }
        return response()->json('Выберите либо другое время, либо другую лекцию');
    }

}
