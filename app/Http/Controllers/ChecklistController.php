<?php

namespace App\Http\Controllers;

use App\Models\Checklist;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ChecklistController extends Controller
{
    public function getChecklists()
    {
        $checklists = Checklist::all();

        return response()
            ->json(['data' => $checklists]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|string|max:255',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());
        }

        $checklist = Checklist::create([
            'name' => $request->name,
        ]);

        return response()
            ->json(['data' => $checklist]);
    }

    public function destroy(Checklist $checklist)
    {
        $checklist->delete();

        return response()
            ->json(['success' => "Data has been deleted"]);
    }


}
