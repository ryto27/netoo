<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Member;
use App\Models\User;

class MemberController extends Controller
{
    public function index(){
        return view('members.show');
    }
    
    public function getMembers(){
        $members = Member::all();

        return view('members.memberlist', [
            'members' => $members
        ]);
    }

    public function save(Request $request){
        if ($request->ajax()){
            // Create New Member
            $member = $request->validate([
                'firstname' => 'required',
                'lastname' => 'required|min:5',
            ], [
                'firstname.required' => 'firstname is required',
                'lastname.required' => 'lastname is required'
            ]);

            $member = new Member;
            $member->firstname = $request->firstname;
            $member->lastname = $request->lastname;
            // Save Member
            $member->save();

            return response()->json([
                'success' => true,
                'message' => 'The email is available'
            ]);
        }
    }

    public function check(Request $request)
    {

        $data = $request->email; // This will get all the request data.
        $userCount = User::where('email', $data)->get();
        if ($userCount->count()) {
            return response()->json(array('msg' => true));
        } else {
            return response()->json(array('msg' => 'false'));
        }
    }

    public function delete(Request $request){
        if ($request->ajax()){
            Member::destroy($request->id);
        }
    }

    public function update(Request $request){
        if ($request->ajax()){
            $member = Member::find($request->id);
            $member->firstname = $request->input('firstname');
            $member->lastname = $request->input('lastname');

            $member->update();
            return response($member);
        }
    }
}