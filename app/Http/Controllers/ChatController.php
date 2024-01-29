<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\_chat;
class ChatController extends Controller
{
    public function chat(Request $request){
        if($request->ajax()){
            $message = $request->message;
            $senderid = $request->senderid;
            $receiverid = $request->receiverid;
            $senderdata = ['sender_id'=>$senderid,'receiver_id'=>$receiverid];
            $receiverdata = ['receiver_id'=>$senderid,'sender_id'=>$receiverid];
            if($message == ""){
                $data = _chat::where($senderdata)
                ->orWhere($receiverdata)
                ->get();
                return response()->json(['data'=>$data]);
            }else{
            $data = new _chat;
            $data->message = $message;
            $data->sender_id = $senderid;
            $data->receiver_id = $receiverid;
            $data->save();
            $data = _chat::where($senderdata)
            ->orWhere($receiverdata)
            ->get();
            return response()->json(['data'=>$data]);}}
            else{
                return view('syndash.chat');
            }
    }
    public function users(){
        $users = User::get();
        return view('syndash.chat',['users'=>$users]);
    }
}
