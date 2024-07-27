<?php

namespace App\Http\Controllers\Staff\Inquiry;

use App\Http\Controllers\Controller;
use App\Models\Inquiries;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;
use App\Mail\InquiryMailSend;

class InquiryController extends Controller
{
    public function displayInquiry(){
        $inquiry = Inquiries::where('status', '=', 'uncatered')
                    ->orderBy('lname', 'asc')
                    ->get();
        return $inquiry;
    }

    public function replyInquiry(Request $request, $id){
        $inquiry = Inquiries::findOrFail($id);
        $request['status'] = 'catered';
        $inquiry->update($request->all());

        $inquiryData = [
            'name' => $inquiry->fname . ' ' . $inquiry->lname,
            'email' => $inquiry->email,
            'message' => $inquiry->message,
            'reply' => $inquiry->reply,
        ];

        Mail::to($request->email)->send(new InquiryMailSend($inquiryData));

        return response()->json([
            'status' => 'success',
            'data' => $inquiry,
        ], 200);
    }

    public function alreadyCatered(Request $request, $id){
        $alCatered = Inquiries::findOrFail($id);
        $request['status'] = 'catered';
        $alCatered->update($request->all());

        return response()->json([
            'status' => 'success',
            'data' => $alCatered,
        ], 200);
    }
}
