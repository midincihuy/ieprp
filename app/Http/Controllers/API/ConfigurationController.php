<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\API\BaseController as BaseController;

use App\Models\Reference;

class ConfigurationController extends BaseController
{
    public function saveConfig(Request $request){
        \Log::info('===Masuk Save Config API===');
        \Log::info($request->all());
        $reference = Reference::findOrFail($request->id);
        $reference->value = $request->value;
        $reference->save();
        $response = ['result' => 'Success', 'msg' => "Successfully Updated Data"];
        return json_encode($response);
    }

    public function saveConfigValue(Request $request){
        \Log::info('===Masuk Save Config Value API===');
        \Log::info($request->all());
        parse_str($request->serializedData, $serializedData);
        $count = 0;
        foreach($serializedData as $key => $value){
            $count++;
            \Log::info($key);
            $split = explode("_", $key);
            $id = $split[2];
            if($id != "new"){
                $reference = Reference::findOrFail($id);
                $reference->value = $value;
                $reference->save();
            }else{
                $sort = $count;
                $reference = new Reference();
                $reference->code = $split[1];
                $reference->item = $value;
                $reference->value = $value;
                $reference->sort = $sort;
                $reference->save();
            }
        }
        /*
        $reference = Reference::findOrFail($request->id);
        $reference->value = $request->value;
        $reference->save();
        */
        $response = ['result' => 'Success', 'msg' => "Successfully Updated Data"];
        return json_encode($response);
    }
}