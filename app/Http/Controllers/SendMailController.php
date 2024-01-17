<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NewsPaper;
use App\Models\AdvertiseNewsPaper;
use App\Models\Signature;
use App\Models\Advertise;
use App\Mail\SendMail;
use Illuminate\Support\Facades\Mail;

class SendMailController extends Controller
{
    public function index(Request $request){
        $newsPaperId = AdvertiseNewsPaper::where('advertise_id', $request->id)->pluck('news_paper_id');

        $newsPapers = NewsPaper::whereHas('advertiseNewsPaper', function($query) use($newsPaperId){
            $query->whereIn('news_paper_id', $newsPaperId);
        })->get();
        // return $newsPapers;
        $advertise = Advertise::find($request->id);

        return view('send-mail.index')->with([
            'newsPapers' => $newsPapers,
            'advertise' => $advertise
        ]);
    }

    public function sendEmail(Request $request){
        set_time_limit(0);

        $signature = Signature::value('name');

        $pdf = Advertise::where('id', $request->id)->value('generate_pdf_url');

        if(isset($request->email)){
            for($i=0; $i < count($request->email); $i++){
                Mail::to($request->email[$i])->send(new SendMail($signature, $pdf, $request));
            }
        }

        return redirect()->route('advertise.index')->with('success', 'Mail send successfully');

    }
}
