<?php

namespace App\Http\Controllers;

use App\DialActivity;
use Illuminate\Http\Request;

class DialActivityController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, [
            'task_id' => 'required',
            'owner' => 'required',
            'created_by' => 'required',
            'activity_date' => 'required',
            'what' => 'required',
            'status' => 'required',
            'subject' => 'required',
            'priority' => 'required',
        ]);
        $dialActivity = DialActivity::where('task_id',$request->task_id)->get()->first();
        if(is_null($dialActivity)){
            $dialActivity = new DialActivity();
        }

        $dialActivity->task_id = $request->task_id;
        $dialActivity->owner = $request->owner;
        $dialActivity->owner_info = $request->has('owner_info') ? $request->owner_info : "{}";
        $dialActivity->created_by = $request->has('created_by') ? $request->created_by : "NULL";
        $dialActivity->created_by_info = $request->has('created_by_info') ? $request->created_by_info : "{}";
        $dialActivity->activity_date = $request->has('activity_date') ? $request->activity_date : "NULL";
        $dialActivity->what = $request->has('owner') ? $request->what : "NULL";
        $dialActivity->status = $request->has('status') ? $request->status : "NULL";
        $dialActivity->subject = $request->has('subject') ? $request->subject : "NULL";
        $dialActivity->priority = $request->has('priority') ? $request->priority : "NULL";
        $dialActivity->call_duration = $request->has('call_duration') ? $request->call_duration : 0;
        $dialActivity->call_object = $request->has('call_object') ? $request->call_object : "NULL";
        $dialActivity->call_disposition = $request->has('call_disposition') ? $request->call_disposition : "NULL";
        $dialActivity->call_type = $request->has('call_type') ? $request->call_type : "NULL";
        $dialActivity->description = $request->has('description') ? $request->description : "NULL";
        $dialActivity->is_recurrence = $request->has('is_recurrence') ? $request->is_recurrence : 0;
        $dialActivity->email = $request->has('email') ? $request->email : "NULL";
        $dialActivity->last_modified_by = $request->has('last_modified_by') ? $request->last_modified_by : "NULL";
        $dialActivity->last_modified_by_info = $request->has('last_modified_by_info') ? $request->last_modified_by_info : "{}";
        $dialActivity->who = $request->has('who') ? $request->who : "NULL";
        $dialActivity->who_info = $request->has('who_info') ? $request->who_info : "{}";
        $dialActivity->phone = $request->has('phone') ? $request->phone : "NULL";
        $dialActivity->priority = $request->has('priority') ? $request->priority : "NULL";
        $dialActivity->recurrence_interval = $request->has('recurrence_interval') ? $request->recurrence_interval : 0;
        $dialActivity->what = $request->has('what') ? $request->what : "NULL";
        $dialActivity->client_id = $request->has('client_id') ? $request->client_id : "NULL";
        $dialActivity->client_name = $request->has('client_name') ? $request->client_name : "NULL";
        $dialActivity->grocery_store_id = $request->has('grocery_store_id') ? $request->grocery_store_id : "NULL";
        $dialActivity->grocery_store_name = $request->has('grocery_store_name') ? $request->grocery_store_name : "NULL";
        $dialActivity->garbage_dumpster_id = $request->has('garbage_dumpster_id') ? $request->garbage_dumpster_id : "NULL";
        $dialActivity->garbage_dumpster_name = $request->has('garbage_dumpster_name') ? $request->garbage_dumpster_name : "NULL";
        $dialActivity->is_reminder_set = $request->has('is_reminder_set') ? $request->is_reminder_set : 0;
        $dialActivity->recurrence_regenerated_type = $request->has('recurrence_regenerated_type') ? $request->recurrence_regenerated_type : "NULL";
        $dialActivity->task_subtype = $request->has('task_subtype') ? $request->task_subtype : "NULL";
        $dialActivity->type = $request->has('type') ? $request->type : "NULL";

        //Debugging purpose
        $dialActivity->request_data = json_encode($request->all());
        $dialActivity->save();

        return response()->json([
            'success' => true,
            'data' => $dialActivity->toArray()
        ]);
    }

    public function showByClientID($id)
    {
        $logs = DialActivity::where('client_id',$id)->get()->toArray();
        if (!$logs) {
            return response()->json([
                'success' => false,
                'message' => 'Client with id ' . $id . ' not found'
            ], 400);
        }

        return response()->json([
            'success' => true,
            'data' => $logs
        ], 400);
    }

    public function showByStoreID($id)
    {
        $logs = DialActivity::where('grocery_store_id',$id)->get()->toArray();
        if (!$logs) {
            return response()->json([
                'success' => false,
                'message' => 'Store with id ' . $id . ' not found'
            ], 400);
        }

        return response()->json([
            'success' => true,
            'data' => $logs
        ], 400);
    }

    public function showByDumpsterID($id)
    {
        $logs = DialActivity::where('garbage_dumpster_id',$id)->get()->toArray();
        if (!$logs) {
            return response()->json([
                'success' => false,
                'message' => 'Dumpster with id ' . $id . ' not found'
            ], 400);
        }

        return response()->json([
            'success' => true,
            'data' => $logs
        ], 400);
    }
}
