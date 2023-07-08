<?php

namespace App\Http\Controllers;

use App\Http\Requests\Group\CollectiveRequest;
use App\Http\Requests\Group\CreateRequest;
use App\Http\Requests\Group\DeleteRequest;
use App\Http\Requests\Group\UpdateRequest;
use App\Http\Requests\SearchRequest;
use App\Models\Group;
use App\Models\GroupUniversityCollective;
use Illuminate\Http\JsonResponse;

class GroupController extends Controller
{
    public Group $group;

    public function __construct(Group $group)
    {
        $this->group = $group;
    }

    public function create(CreateRequest $request): JsonResponse
    {
        $newGroup = Group::create($request->validated());

        return response()->json($newGroup);
    }

    public function update(UpdateRequest $request): JsonResponse
    {
        $group = $this->group->find($request->group_id);
        $group->update($request->validated());

        return response()->json($group);
    }

    public function search(SearchRequest $request): JsonResponse
    {
        $group = $this->group->where('group_address_id', 'LIKE', '%'.$request->search_query.'%')->get();

        return response()->json($group);
    }

    public function delete(DeleteRequest $request): JsonResponse
    {
        $deleted = $this->group->find($request->group_id)->delete();

        return response()->json(['success' => $deleted]);
    }

    public function collectiveAdd(CollectiveRequest $request): JsonResponse
    {
        $attached = $this->group->collectiveAdd($request->group_id, $request->collective_ids);

        return response()->json(['message' => $attached ? 'User cant add' : 'User add successfully']);
    }

    public function collectiveShow($groupId=null): JsonResponse
    {
        $group = $this->group->groupWithCollective($groupId);

        return response()->json($group);
    }

    public function collectiveRemove(CollectiveRequest $request): JsonResponse
    {
        $deleted = false;
        foreach ($request->collective_ids as $collectiveId)
        {
            $deleted = (bool) GroupUniversityCollective::where('group_id', $request->group_id)
                ->where('university_collective_id', $collectiveId)
                ->delete();
        }

        return response()->json(['success' => $deleted]);
    }
}
