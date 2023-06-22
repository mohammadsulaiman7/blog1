<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Group;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GroupController extends Controller
{

    public function index()
    {
        // $user=User::find(Auth::user()->id);
        // $hasTask=$user->groups()->where('id','2')->exists();
        // return $hasTask;
        $groups=Group::get();
        return view("groups.index", compact('groups'));
    }

    public function create()
    {
        $categories = Category::get();
        return view("groups.create", compact('categories'));
    }

    public function store(Request $request)
    {
        $group = Group::create($request->all() + ['user_id' => Auth::user()->id]);
        if ($request->has('cover')) {
            $coverMedia = $request->file('cover');
            $coverName = $group->id . '.' . $coverMedia->extension();
            $coverMedia->storeAs('groups-cover', $coverName, 'public');
            $group->cover = $coverName;
        }
        if ($group->save()) {
            $group->users()->attach($group->user_id);
            return redirect()->route('groups.index')->with('success', 'create group successfuly');
        } else
            return back()->with('error', "there's error in creating group");
    }

    public function show(Group $group)
    {

        return view('groups.show', compact('group'));
    }

    public function edit(Group $group)
    {
        return view('groups.edit', compact('group'));
    }

    public function update(Request $request, Group $group)
    {
        if (!Gate::allows('update-comment', $group)) {
            abort(404);
        } else
            return "you can update it ";
    }
    
    public function destroy(Group $group)
    {
        if($group->delete())
        {
            return back()->with('success','delete group successfuly');
        }
        else 
        return back()->with('error','error in deleteing group');
    }
    public function join($id)
    {
        $group = Group::find($id);
        if ($group->users()->attach(Auth::user()->id)) {
            return redirect()->route('groups.index')->with('success', 'you joined to the group');
        } else
            return back()->with('success', 'adding to the group successfuly');
    }
    public function joinPrivacy($id, Request $request)
    {
        $group = Group::find($id);
        if ($request->key == $group->key) {
            if ($group->users()->attach(Auth::user()->id)) {
                return redirect()->route('groups.index')->with('success', 'you joined to the group privacy');
            }
            else 
            return redirect()->route('groups.index')->with('success', 'you joined to the group privacy');

        } else
            return redirect()->route('groups.index')->with('error', 'error in adding to the group');
    }
}
