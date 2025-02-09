<?php

namespace App\Http\Controllers;

use App\Models\Population;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PopulationController
{
    public function index(Request $request)
    {
        //一覧のデータ
        $populations = Population::select('prefecture', 'year', 'population')
        ->get()
        ->groupBy('prefecture');

        if ($request->has('year') != "Total") {
            $populations->where('year', $request->year);
        }

        if ($request->has('prefecture') != "Total") {
            $populations->where('prefecture', 'like', '%' . $request->prefecture . '%');
        }
        
        //検索機能の選択
        $years = Population::select('year')->distinct()->orderBy('year')->pluck('year');
        $prefectures = Population::select('prefecture')->distinct()->orderBy('prefecture')->pluck('prefecture');        

        return view('population.index', compact('years', 'prefectures','populations'));
    }

    public function importView()
    {
        return view('population.import');
    }

    public function import(Request $request)
    {

        try {
            //テーブルのデータを削除
            Population::query()->truncate();

            //ファイルの内容
            $file = $request->file('csv_file');
            $data = array_map('str_getcsv', file($file));

            //utf-8に変更
            $data = mb_convert_encoding($data, "UTF-8", "sjis-win");

            //不要な行を削除
            $data = array_slice($data, 14);

            //年
            $years = array_shift($data);
            $years = array_slice($years, 1);

            DB::beginTransaction();

            foreach ($data as $row) {

                $prefecture = array_shift($row);
                

                foreach($row as $key => $population){
                    //数字がない場合はスキップ
                    if(is_numeric($population)){
                        Population::create([
                            'prefecture' => $prefecture,
                            'year' => $years[$key],
                            'population' => $population,
                        ]);
                    }
                }
            }
            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();
     
            return view('population.import')->with([
                'import_status' => false
            ]);
        }

        return view('population.import')->with([
            'import_status' => true
        ]);

        return redirect()->route('population.import')->with('success', 'Data imported successfully!');
    }

}
