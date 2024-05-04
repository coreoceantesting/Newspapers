<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NewsPaper;
use App\Models\AdvertiseNewsPaper;
use App\Models\Signature;
use App\Models\Advertise;
use App\Mail\SendMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class SendMailController extends Controller
{
    public function index(Request $request)
    {
        $advertise = Advertise::find($request->id);

        if ($advertise && $advertise->is_mail_send == "1") {
            return redirect()->route('advertise.index');
        }

        $newsPaperId = AdvertiseNewsPaper::where('advertise_id', $request->id)->pluck('news_paper_id');

        $newsPapers = NewsPaper::whereHas('advertiseNewsPaper', function ($query) use ($newsPaperId) {
            $query->whereIn('news_paper_id', $newsPaperId);
        })->get();

        return view('send-mail.index')->with([
            'newsPapers' => $newsPapers,
            'advertise' => $advertise
        ]);
    }

    public function sendEmail(Request $request)
    {
        set_time_limit(0);
        DB::beginTransaction();
        try {
            $signature = Advertise::where('id', $request->id)->value('image');

            $pdf = Advertise::where('id', $request->id)->value('generate_pdf_url');

            if (isset($request->email)) {
                for ($i = 0; $i < count($request->email); $i++) {
                    Mail::to($request->email[$i])->send(new SendMail($signature, $pdf, $request));
                }
            }

            DB::table('advertises')->where('id', $request->id)->update([
                'is_mail_send' => 1,
                'email_subject' => $request->subject,
                'email_description' => $request->description,
            ]);

            DB::commit();
            return redirect()->route('advertise.sendMail')->with('success', 'Mail send successfully');
        } catch (\Exception $e) {
            DB::rollback();
            Log::info($e);
            return redirect()->route('advertise.sendMail')->with('error', 'Something Went Wrog !');
        }
    }
}
