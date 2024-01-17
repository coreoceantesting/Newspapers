<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\SignatureRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Signature;

class SignatureController extends Controller
{
    public function index(){
        $signature = Signature::first();

        return view('master.signature.index')->with(['signature' => $signature]);
    }


    public function store(SignatureRequest $request){
        DB::beginTransaction();
        if(isset($request->id)){
            $signature = Signature::find($request->id);
            if (Storage::exists($signature->name)){
                Storage::delete($signature->name);
            }
        }else{
            $signature = new Signature;
        }

        $signature->updated_by = Auth::user()->id;
        $signature->name = $request->name->store('signature');
        $signature->save();
        DB::commit();
        return redirect()->route('signature.index')->with('success', 'Signature Updated Successfully');
    }

}
