<?php

namespace App\Http\Controllers;

use App\Models\Checklist;
use App\Models\ChecklistItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ChecklistItemController extends Controller
{
    public function getItemsChecklist(Checklist $checklist)
    {
        $checklist_items = ChecklistItem::where('checklist_id', '=', $checklist->id)->get();

        return response()
            ->json(['data' => $checklist_items]);
    }

    public function store(Checklist $checklist, Request $request)
    {
        $validator = Validator::make($request->all(),[
            'itemName' => 'required|string|max:255',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());
        }

        $checklist_item = ChecklistItem::create([
            'itemName' => $request->itemName,
            'status' => "on progress",
            'checklist_id' => $checklist->id
        ]);

        return response()
            ->json(['data' => $checklist_item]);
    }

    public function show(Checklist $checklist, ChecklistItem $checklist_item)
    {
        $checklist_item = ChecklistItem::find($checklist_item->id);

        return response()
            ->json(['data' => $checklist_item]);
    }

    public function update(Checklist $checklist, ChecklistItem $checklist_item)
    {
        $checklist_item = ChecklistItem::find($checklist_item->id);

        $checklist_item->update([
           'status' => 'done'
        ]);

        return response()
            ->json(['data' => $checklist_item]);
    }

    public function destroy(Checklist $checklist, ChecklistItem $checklist_item)
    {
        $checklist_item = ChecklistItem::find($checklist_item->id);

        $checklist_item->delete();

        return response()
            ->json(['success' => "Data has been deleted"]);
    }

    public function rename(Checklist $checklist, ChecklistItem $checklist_item, Request $request)
    {
        $checklist_item = ChecklistItem::find($checklist_item->id);

        $validator = Validator::make($request->all(),[
            'itemName' => 'required|string|max:255',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());
        }

        $checklist_item->update([
            'itemName' => $request->itemName
        ]);

        return response()
            ->json(['data' => $checklist_item]);
    }
}
