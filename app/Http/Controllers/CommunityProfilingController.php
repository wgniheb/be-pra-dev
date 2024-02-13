<?php

namespace App\Http\Controllers;

use App\Models\Idm;
use App\Models\Fishery;
use App\Models\LandUse;
use App\Models\Village;
use App\Models\Demographic;
use App\Models\FarmProduct;
use Illuminate\Http\Request;
use App\Models\PlantationCrop;
use App\Models\HealthcareWorker;
use App\Models\LivestockProduct;
use App\Models\CommunityProfiling;
use App\Models\DrinkingWaterSource;
use App\Models\SanitationWaterSource;
use App\Models\CommunityProfilingDetail;
use Illuminate\Support\Facades\Validator;

class CommunityProfilingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        $village = Village::with(['communityProfilings' => function ($query) {
            $query->orderBy('year', 'desc')->first(); // Assuming you want to sort by year in ascending order
        }])
        ->with('district', 'city', 'province')
        ->get();
        return response()->json($village);
    }

    public function indexByVillage(int $village)
    {
        $communityProfiling = CommunityProfiling::where('village_id', $village)->orderByDesc('year')->get();
        return response()->json($communityProfiling);
    }

    public function store(Request $request)
    {
        $validator = Validator::make(request()->all(),[
            'year' => 'required',
            'village_id' => 'required|exists:villages,id',
            'idm_year' => 'required',
            'idm_score' => 'required',
            'idm_status_id' => 'required|exists:idm_statuses,id',
            'jumlah_penduduk_laki_laki' => 'required',
            'jumlah_penduduk_perempuan' => 'required',
            'luas_desa' => 'required',
            'is_dokter' => 'required',
            'is_perawat' => 'required',
            'is_mantri' => 'required',
            'is_bidan' => 'required',
            'is_dukun' => 'required',
            'is_padi' => 'required',
            'is_palawija' => 'required',
            'is_holtikultura' => 'required',
            'is_sawit' => 'required',
            'is_karet' => 'required',
            'is_kelapa' => 'required',
            'is_kopi' => 'required',
            'is_kakao' => 'required',
            'is_lada' => 'required',
            'is_unggas' => 'required',
            'is_ternak_besar' => 'required',
            'is_ternak_kecil' => 'required',
            'is_perikanan_budidaya' => 'required',
            'is_perikanan_tangkap' => 'required',
            'is_sungai' => 'required',
            'is_sumur' => 'required',
            'is_air_hujan' => 'required',
            'is_galon' => 'required',
            'is_pamsimas' => 'required',
            'is_sungai_MCK' => 'required',
            'is_sumur_MCK' => 'required',
            'is_air_hujan_MCK' => 'required',
            'is_pamsimas_MCK' => 'required',
            'is_lahan_sawit' => 'required',
            'is_lahan_campuran' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages(), 202);
        }

        $communityProfiling = CommunityProfiling::create([
            'year' => request('year'),
            'village_id' => request('village_id'),
        ]);

        $idm = Idm::create([
            'year' => request('idm_year'),
            'score' => request('idm_score'),
            'idm_status_id' => request('idm_status_id'),
        ]);

        $demographic = Demographic::create([
            'jumlah_penduduk_laki_laki' => request('jumlah_penduduk_laki_laki'),
            'jumlah_penduduk_perempuan' => request('jumlah_penduduk_perempuan'),
            $jt = request('jumlah_penduduk_laki_laki') + request('jumlah_penduduk_perempuan'),
            'jumlah_penduduk_total' => $jt,
            'luas_desa' => request('luas_desa'),
            $kp = $jt / request('luas_desa'),
            'kepadatan_penduduk' => $kp,
        ]);

        $healthcare = HealthcareWorker::create([
            'is_dokter' => request('is_dokter'),
            'is_perawat' => request('is_perawat'),
            'is_mantri' => request('is_mantri'),
            'is_bidan' => request('is_bidan'),
            'is_dukun' => request('is_dukun'),
        ]);

        $farm = FarmProduct::create([
            'is_padi' => request('is_padi'),
            'is_palawija' => request('is_palawija'),
            'is_holtikultura' => request('is_holtikultura'),
        ]);

        $plantation = PlantationCrop::create([
            'is_sawit' => request('is_sawit'),
            'is_karet' => request('is_karet'),
            'is_kelapa' => request('is_kelapa'),
            'is_kopi' => request('is_kopi'),
            'is_kakao' => request('is_kakao'),
            'is_lada' => request('is_lada'),
        ]);

        $livestock = LivestockProduct::create([
            'is_unggas' => request('is_unggas'),
            'is_ternak_besar' => request('is_ternak_besar'),
            'is_ternak_kecil' => request('is_ternak_kecil'),
        ]);

        $fishery = Fishery::create([
            'is_perikanan_budidaya' => request('is_perikanan_budidaya'),
            'is_perikanan_tangkap' => request('is_perikanan_tangkap'),
        ]);

        $drinking = DrinkingWaterSource::create([
            'is_sungai' => request('is_sungai'),
            'is_sumur' => request('is_sumur'),
            'is_air_hujan' => request('is_air_hujan'),
            'is_galon' => request('is_galon'),
            'is_pamsimas' => request('is_pamsimas'),
        ]);

        $sanitation = SanitationWaterSource::create([
            'is_sungai' => request('is_sungai_MCK'),
            'is_sumur' => request('is_sumur_MCK'),
            'is_air_hujan' => request('is_air_hujan_MCK'),
            'is_pamsimas' => request('is_pamsimas_MCK'),
        ]);

        $land = LandUse::create([
            'luas_lahan_sawit' => request('is_lahan_sawit'),
            'luas_lahan_campuran' => request('is_lahan_campuran'),
        ]);

        $detail = CommunityProfilingDetail::create([
            'community_profiling_id' => $communityProfiling->id,
            'idm_id' => $idm->id,
            'demographic_id' => $demographic->id,
            'healthcare_worker_id' => $healthcare->id,
            'farm_product_id' => $farm->id,
            'plantation_crop_id' => $plantation->id,
            'livestock_product_id' => $livestock->id,
            'fishery_id' => $fishery->id,
            'drinking_water_source_id' => $drinking->id,
            'sanitation_water_source_id' => $sanitation->id,
            'land_use_id' => $land->id,
        ]);

        if ($detail) {
            return response()->json(['message' => 'Community Profiling Successfully Added!'], 201);
        } else {
            return response()->json(['message' => 'Community Profiling Failed Added!']);
        }
    }

    public function show(int $communityProfiling)
    {
        $communityProfiling = CommunityProfiling::where('id', $communityProfiling)->with('village')->first();
        return response()->json($communityProfiling);
    }

    public function update(Request $request, int $communityProfiling)
    {
        $validator = Validator::make(request()->all(),[
            'year' => 'required',
            'village_id' => 'required|exists:villages,id',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages(), 202);
        }

        $communityProfiling = CommunityProfiling::where('id', $communityProfiling)->update([
            'year' => request('year'),
            'village_id' => request('village_id'),
        ]);

        if ($communityProfiling) {
            return response()->json(['message' => 'Community Profiling Successfully Updated!'], 201);
        } else {
            return response()->json(['message' => 'Community Profiling Failed Updated!']);
        }
    }

    public function destroy(int $communityProfiling)
    {
        $communityProfiling = CommunityProfiling::where('id', $communityProfiling)->forceDelete();
        if ($communityProfiling) {
            return response()->json(['message' => 'Community Profiling Successfully Deleted!'], 201);
        } else {
            return response()->json(['message' => 'Community Profiling Failed Deleted!']);
        }
    }
}
