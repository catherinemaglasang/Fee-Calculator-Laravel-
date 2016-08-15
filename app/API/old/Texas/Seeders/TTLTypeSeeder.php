<?php
namespace Thirty98\API\Texas\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Thirty98\API\General\Models\Fee;
use Thirty98\API\General\Models\State;
use Thirty98\API\General\Models\TtlType;

class TTLTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $stateCode = 'TX';
        $state = State::where('code', $stateCode)->first();

        if (!$state) {
            return $this->command->error('[TTL TYPE} State: ' . $stateCode . ' not found!');
        }

        $data = "NR,New Title/New Registration;TP,New Title/Transfer Plate;DT,Duplicate Title;TO,Title Only;RO,Registration Only;TRC,Title Registration Correction";

        $data = explode(';', $data);

        foreach ($data as $ttlType) {
            $ttlType = explode(',', $ttlType);

            $code = trim($ttlType[0]);
            $name = trim($ttlType[1]);

            $model = TtlType::where('code', $code)->first();

            // If not found, create a new one.
            if (!$model) {
                $model = new TtlType;
            }

            $model->code = $code;
            $model->name = $name;
            $model->save();
        }

        $this->command->info('[TTL TYPE] Successfully added data for ttltypes table.');

        // States - TTL Types
        $data = "SALES_TAX_RATE,YES,YES,NO,YES,YES,NO
                SALES_TAX_LT_PNLTY,YES,YES,NO,YES,YES,NO
                NEW_RESID_TAX,YES,YES,NO,YES,YES,NO
                GIFT_TAX,YES,YES,NO,YES,YES,NO
                EVEN_TRADE_TAX,YES,YES,NO,YES,YES,NO
                EMISSION_FEE,YES,YES,NO,NO,YES,NO
                TITLE_FEE,YES,YES,YES,YES,NO,YES
                DUP_TITLE_FEE,NO,NO,YES,NO,NO,NO
                DLR_LT_PNLTY,YES,YES,NO,YES,YES,NO
                CASUAL_LT_PNLTY,YES,YES,NO,YES,YES,NO
                REG_FEE,YES,NO,NO,NO,YES,NO
                REG_OPTIONS,YES,NO,NO,NO,YES,NO
                LOCAL_FEES,YES,NO,NO,NO,YES,NO
                FARM_RANCH_EXEMPT,YES,YES,NO,NO,YES,NO
                REG_DPS_FEE,YES,NO,NO,NO,YES,NO
                AUTOMAT_FEE,YES,NO,NO,NO,YES,NO
                TEMP_TAG_FEE,YES,YES,NO,YES,YES,NO
                DIESEL_FEE,YES,YES,NO,NO,YES,NO
                EMM_SURCHARGE,YES,YES,NO,NO,YES,NO
                YNG_FRMR_FEE,YES,YES,NO,NO,YES,NO
                VIT_TAX,YES,YES,NO,YES,YES,NO
                INSP_FEE,YES,YES,NO,YES,YES,NO
                SPEC_PLATE_RULES,NO,NO,NO,NO,NO,NO";

        $data = explode("\n", $data);

        $model = DB::table('states_ttltypes');

        foreach ($data as $ttlType) {
            list($feeName, $nr, $tp, $dt, $to, $ro, $trc) = explode(',', $ttlType);

            $feeName = trim($feeName);

            $fee = Fee::where('name', $feeName)->first();

            // Don't proceed if fee name is not found.
            if (!$fee) {
                continue;
            }

            $input = [
                'nr' => $nr,
                'tp' => $tp,
                'dt' => $dt,
                'to' => $to,
                'to' => $to,
                'ro' => $ro,
                'trc' => $trc,
            ];

            foreach ($input as $key => $value) {

                $ttlTypeModel = TtlType::where('code', strtoupper($key))->first();

                if (!$ttlTypeModel) {
                    continue;
                }

                $model->insert([
                    'state_id' => $state->id,
                    'ttltype_id' => $ttlTypeModel->id,
                    'fee_id' => $fee->id,
                    'value' => ($value == 'YES') ? 1 : 0
                ]);
            }
        }

        $this->command->info('[TTL TYPE] Seeder successful.');
    }
}
