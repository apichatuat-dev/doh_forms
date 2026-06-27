<?php

namespace App\Http\Controllers;

use App\Models\BordingLog;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\Province;
use App\Models\District;
use App\Models\SubDistrict;
use Illuminate\Support\Facades\Auth;

class FormsController extends Controller
{
    public function index()
    {
    dd(Auth::user());
    $bording_logs = BordingLog::with('province')->get();

        return view('forms.index', compact('bording_logs'));
    }

    public function create()
    {
        $provinces = Province::all();

        return view('forms.create', compact('provinces'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'map' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10240',
        ]);
        $indexNumber = 100291; // หรือดึงจากฐานข้อมูล
        // ดึงข้อมูลทั้งหมด ยกเว้น map
        $data = $request->except('map');
$data['hole_feature_date'] = $this->thaiDateToMysql($request->hole_feature_date);
        $data['index_number'] = $indexNumber;

        $files = [
            'map' => '1_map',
            'section' => '2_section',
            'soil_profile' => '3_soil_profile',
            'boringlog' => '4_boringlog',
            'base_use_suggest' => '5_base_use_suggest',
            'lab_test_result' => '6_lab_test_result',
            'picture' => '7_picture',
        ];

        foreach ($files as $field => $folder) {

            if ($request->hasFile($field)) {

                $file = $request->file($field);

                $filename = now()->format('YmdHis').'_'.Str::random(10).'.'.$file->getClientOriginalExtension();

                $data[$field] = $file->storeAs(
                    "{$indexNumber}/{$folder}",
                    $filename,
                    'public'
                );
            }
        }

        BordingLog::create($data);

        // $mapPath = null;

        // if ($request->hasFile('map')) {

        //     $file = $request->file('map');

        //     $filename = 'map.' . $file->getClientOriginalExtension();

        //     $mapPath = $file->storeAs(
        //         "2/{$indexNumber}/1_map",
        //         $filename,
        //         'public'
        //     );
        // }

        // บันทึกลงฐานข้อมูล
        // Bording::create([
        //     'index_number' => $indexNumber,
        //     'map' => $mapPath,
        // ]);
        // dd($request->all());
        // BordingLog::create($request->all());
        //100291
        return redirect()
            ->route('forms.index')
            ->with('success', 'บันทึกข้อมูลเรียบร้อย');
    }

    public function delete(Request $request, $id)
    {
        // dd($id);
        BordingLog::where('gid', $id)->delete();

        return back();
    }

    public function edit($id)
    {

        $bording_log = BordingLog::where('gid', $id)->first();
    $provinces = Province::all();

    $districts = District::where('province_id', $bording_log->province_code)->get();

    $subdistricts = SubDistrict::where('district_id', $bording_log->amphur_code)->get();

        return view('forms.edit', compact('bording_log','provinces','districts', 'subdistricts'));

    }

    public function update(Request $request, $id)
    {
        // dd($id);
        // dd($request->all());
        // $bording_log = BordingLog::where('gid', $id)->firstOrFail();
        // $data = $request->all();
         $bordingLog = BordingLog::where('gid', $id)->firstOrFail();


    $data = $request->except([
            '_token',
    '_method',
    'hole_feature_date',
        'map',
        'section',
        'soil_profile',
        'boringlog',
        'base_use_suggest',
        'lab_test_result',
        'picture'
    ]);

             $data['hole_feature_date'] = $this->thaiDateToMysql($request->hole_feature_date);


    $files = [
        'map' => '1_map',
        'section' => '2_section',
        'soil_profile' => '3_soil_profile',
        'boringlog' => '4_boringlog',
        'base_use_suggest' => '5_base_use_suggest',
        'lab_test_result' => '6_lab_test_result',
        'picture' => '7_picture',
    ];
// $indexNumber = 100291; // หรือดึงจากฐานข้อมูล
        // ดึงข้อมูลทั้งหมด ยกเว้น map
        // $data = $request->except('map');
    // dd($bordingLog->index_number);
        // $data['index_number'] = $indexNumber;
    foreach ($files as $field => $folder) {

        if ($request->hasFile($field)) {

            // ลบไฟล์เก่า
            if (!empty($bordingLog->$field)) {
                Storage::disk('public')->delete($bordingLog->$field);
            }

            $file = $request->file($field);
            // dd($file);
            $filename = now()->format('YmdHis')
                . '_' . Str::random(10)
                . '.' . $file->getClientOriginalExtension();
            // dd($folder);
            $data[$field] = $file->storeAs(
                "{$bordingLog->index_number}/{$folder}",
                $filename,
                'public'
            );
        }
    }
    // dd($data);
    // $bordingLog->update($data);

        // // อัพโหลดไฟล์ใหม่
        // if ($request->hasFile('map')) {

        //     // ลบไฟล์เก่า
        //     if ($bording_log->map) {
        //         Storage::disk('public')->delete($bording_log->map);
        //     }

        //     $data['map'] = $request->file('map')
        //         ->store('maps', 'public');
        // }
    //     $data = $request->except('_token', '_method');
    // dd($data);
        // $bording_log->update($data);
         BordingLog::where('gid', $id)->update($data);

        return redirect()
            ->route('forms.index')
            ->with('success', 'แก้ไขข้อมูลเรียบร้อย');
    }

    private function thaiDateToMysql($date)
{
    if (empty($date)) {
        return null;
    }

    [$day, $month, $year] = explode('/', $date);

    return sprintf(
        '%04d-%02d-%02d',
        $year - 543,
        $month,
        $day
    );
}
}
