<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGroupRequest;
use App\Http\Requests\UpdateGroupRequest;
use App\Models\Group;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $groups = Group::all();

        return response()->json([
            'groups' => $groups
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreGroupRequest $request)
    {
        $validation = $request->validated();

        $newGroup = new Group([
            'name' => $request->name,
            'own_computer' => $request->own_computer
        ]);

        $newGroup->save();

        return response()->json([
            'group' => $newGroup
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $group = Group::find($id);

        if (!($group instanceof Group)) {
            return response()->json([
                'message' => 'Group does not exist'
            ], 400);
        }

        return response()->json([
            'group' => $group
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateGroupRequest $request, $id)
    {
        $validation = $request->validated();

        $group = Group::find($id);

        if (!($group instanceof Group)) {
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $group = Group::find($id);

        if (!($group instanceof Group)) {
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
