<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    public function index(): JsonResponse {
        $groups = Group::all();

        return response()->json([
            'groups' => $groups
        ], 200);
    }

    public function store(Request $request): JsonResponse {
        $this->validate($request, [
            'name' => 'string|required',
        ]);

        $newGroup = new Group([
            'name' => $request->name,
        ]);

        $newGroup->save();

        return response()->json([
            'group' => $newGroup
        ], 200);
    }

    public function edit(Request $request, $id): JsonResponse {
        $this->validate($request, [
            'name' => 'string',
        ]);

        $group = Group::find($id);

        if (!$group) {
            return response()->json([
                'message' => 'Group does not exist'
            ], 400);
        }

        $group->update($request->all());
        $group->save();

        return response()->json([
            'group' => $group
        ], 200);
    }

    public function delete($id): JsonResponse {
        $group = Group::find($id);

        if (!$group) {
            return response()->json([
                'message' => 'Group does not exist'
            ], 400);
        }

        $group->delete();

        return response()->json([
            'message' => 'Group deleted'
        ], 200);
    }
}
