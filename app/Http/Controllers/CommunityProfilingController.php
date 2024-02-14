<?php

namespace App\Http\Controllers;

use App\Models\Idm;
use App\Models\Group;
use App\Models\Income;
use App\Models\Fishery;
use App\Models\LandUse;
use App\Models\Village;
use App\Models\Religion;
use App\Models\Demographic;
use App\Models\FarmProduct;
use Illuminate\Http\Request;
use App\Models\RoadCondition;
use App\Models\PlantationCrop;
use App\Models\Transmigration;
use App\Models\PrimaryLivehood;
use App\Models\EconomicFacility;
use App\Models\HealthcareWorker;
use App\Models\LivestockProduct;
use App\Models\PrimaryLivelihood;
use App\Models\CommunityProfiling;
use App\Models\DrinkingWaterSource;
use App\Models\EconomicInstitution;
use App\Models\SecondaryLivelihood;
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
        // $village = Village::with('communityProfilings:id,year,village_id')->get();
        // return response()->json($village);
        $village = Village::with(['communityProfilings' => function ($query) {
            $query
            ->orderBy('year', 'desc')
            ->select('id', 'year', 'village_id')
            ; // Assuming you want to sort by year in ascending order
        }])
        ->with('district:id,name', 'city:id,name', 'province:id,name')
        ->get(['id', 'name', 'district_id', 'city_id', 'province_id']);
        return response()->json($village);
    }

    public function indexByVillage(int $village)
    {
        $communityProfiling = CommunityProfiling::where('village_id', $village)->orderByDesc('year')->get(['id', 'year', 'village_id']);
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
            'is_pasar' => 'required',
            'is_kios' => 'required',
            'income' => 'required',
            'is_bank' => 'required',
            'is_koperasi' => 'required',
            'is_credit_union' => 'required',
            'is_brilink' => 'required',
            'is_petani' => 'required',
            'is_pekebun' => 'required',
            'is_pns' => 'required',
            'is_karyawan_swasta' => 'required',
            'is_wirausaha' => 'required',
            'is_nelayan' => 'required',
            'is_jasa' => 'required',
            'is_karyawan_swasta_secondary' => 'required',
            'is_pns_secondary' => 'required',
            'is_wirausaha_secondary' => 'required',
            'is_penggarap_lahan_secondary' => 'required',
            'is_nelayan_secondary' => 'required',
            'is_lokal' => 'required',
            'is_transmigrasi' => 'required',
            'is_islam' => 'required',
            'is_kristen' => 'required',
            'is_katolik' => 'required',
            'is_hindu' => 'required',
            'is_budha' => 'required',
            'is_konghucu' => 'required',
            'is_kaharingan' => 'required',
            'is_melayu' => 'required',
            'is_jawa' => 'required',
            'is_banjar' => 'required',
            'is_batak' => 'required',
            'is_minang' => 'required',
            'is_dayak' => 'required',
            'is_flores' => 'required',
            'is_bugis' => 'required',
            'is_papua' => 'required',
            'is_manado' => 'required',
            'is_toraja' => 'required',
            'is_timor' => 'required',
            'is_aspal' => 'required',
            'is_cor' => 'required',
            'is_tanah' => 'required',
            'is_batu' => 'required',
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

        $economicFasility = EconomicFacility::create([
            'is_pasar' => request('is_pasar'),
            'is_kios' => request('is_kios'),
        ]);

        $income = Income::create([
            'income' => request('income'),
        ]);

        $economicInstitution = EconomicInstitution::create([
            'is_bank' => request('is_bank'),
            'is_koperasi' => request('is_koperasi'),
            'is_credit_union' => request('is_credit_union'),
            'is_brilink' => request('is_brilink'),
        ]);

        $primaryLivehood = PrimaryLivelihood::create([
            'is_petani' => request('is_petani'),
            'is_pekebun' => request('is_pekebun'),
            'is_pns' => request('is_pns'),
            'is_karyawan_swasta' => request('is_karyawan_swasta'),
            'is_wirausaha' => request('is_wirausaha'), // 'is_jasa' => request('is_jasa'), // 'is_nelayan' => request('is_nelayan'),
            'is_nelayan' => request('is_nelayan'),
            'is_jasa' => request('is_jasa'),
        ]);

        $secondaryLivelihood = SecondaryLivelihood::create([
            'is_karyawan_swasta' => request('is_karyawan_swasta_secondary'),
            'is_pns' => request('is_pns_secondary'),
            'is_wirausaha' => request('is_wirausaha_secondary'),
            'is_penggarap_lahan' => request('is_penggarap_lahan_secondary'),
            'is_nelayan' => request('is_nelayan_secondary'),
        ]);

        $transmigration = Transmigration::create([
            'is_lokal' => request('is_lokal'),
            'is_transmigrasi' => request('is_transmigrasi'),
        ]);

        $religion = Religion::create([
            'is_islam' => request('is_islam'),
            'is_kristen' => request('is_kristen'),
            'is_katolik' => request('is_katolik'),
            'is_hindu' => request('is_hindu'),
            'is_budha' => request('is_budha'),
            'is_konghucu' => request('is_konghucu'),
            'is_kaharingan' => request('is_kaharingan'),
        ]);

        $group = Group::create([
            'is_melayu' => request('is_melayu'),
            'is_jawa' => request('is_jawa'),
            'is_banjar' => request('is_banjar'),
            'is_batak' => request('is_batak'),
            'is_minang' => request('is_minang'),
            'is_dayak' => request('is_dayak'),
            'is_flores' => request('is_flores'),
            'is_bugis' => request('is_bugis'),
            'is_papua' => request('is_papua'),
            'is_manado' => request('is_manado'),
            'is_toraja' => request('is_toraja'),
            'is_timor' => request('is_timor'),
        ]);

        $road = RoadCondition::create([
            'is_aspal' => request('is_aspal'),
            'is_cor' => request('is_cor'),
            'is_tanah' => request('is_tanah'),
            'is_batu' => request('is_batu'),
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
            'economic_facility_id' => $economicFasility->id,
            'income_id' => $income->id,
            'economic_institution_id' => $economicInstitution->id,
            'primary_livelihood_id' => $primaryLivehood->id,
            'secondary_livelihood_id' => $secondaryLivelihood->id,
            'transmigration_id' => $transmigration->id,
            'religion_id' => $religion->id,
            'group_id' => $group->id,
            'road_condition_id' => $road->id,
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
