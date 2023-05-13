<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Group;
// use App\Models\User;
use Illuminate\Auth\Access\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Storage;
// use Illuminate\Support\Facades\DB;
class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $groups=Group::get();
        // $groups=Group::select('groups.*')
        // ->join('group_user','group_user.group_id','=','groups.id')
        // ->where('group_user.user_id','!=',Auth::user()->id)
        // ->where('groups.user_id','!=',Auth::user()->id)
        // ->where('group_user.user_id','!=',Auth::user()->id)
        // ->select('group_user.*')
        // ->get();
        // return $groups;
        return view("groups.index",compact('groups'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories=Category::get();
        return view("groups.create",compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $group=Group::create($request->all() + ['user_id'=>Auth::user()->id] );
        if($request->has('cover'))
        {
            $coverMedia=$request->file('cover');
            $coverName=$group->id . '.' . $coverMedia->extension();
            $coverMedia->storeAs('groups-cover',$coverName,'public');
            $group->cover=$coverName;
        }
        if($group->save())
        {
            $group->users()->attach($group->user_id);
            return redirect()->route('groups.index')->with('success','create group successfuly');
        }
        else 
        return back()->with('error',"there's error in creating group");
    }

    /**
     * Display the specified resource.
     */
    public function show(Group $group)
    {
        
        return view('groups.show',compact('group'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Group $group)
    {
        return view('groups.edit',compact('group'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Group $group)
    {
        if(!Gate::allows('update-comment',$group))
        {
            abort(404);
        }
        else 
        return "you can update it ";
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Group $group)
    {
        //
    }
    public function join($id){
        $group= Group::find($id);
        if($group->users()->attach(Auth::user()->id))
        {
            return redirect()->route('groups.index')->with('success','you joined to the group');
        }
        else 
        return back()->with('error','error in adding to the group');
    }
}
