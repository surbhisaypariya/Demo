<?php

namespace App\Imports;

use App\Models\Donation_item;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
Use PhpOffice\PhpSpreadsheet\Shared\Date;
use Carbon\Carbon;

class DonationItemImport implements ToModel , WithStartRow , WithValidation,SkipsEmptyRows
{
    
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function startRow(): int
    {
        return 2;
    }
    public function __construct(string $donation_id)
    {
        $this->donation_id = $donation_id;
    }
    public function rules():array{
        
        return [
            '22' => 'nullable | integer',
            '04' => 'date_format:d/m/y'
        ];
    }
    
    public function model(array $row)
    {
        if(!empty($row[4]))
        {
            $date = Date::excelToDateTimeObject($row['4'])->format('Y-m-d');
        }
        else{
            $date = "";
        }
        $donation_items = new Donation_item;
        $donation_items->donation_id = $this->donation_id;
        $donation_items->product_code = $row[0];
        $donation_items->manufecturer = $row[1];
        $donation_items->brand_name = $row[2];
        $donation_items->generic_name = $row[3];
        $donation_items->expiry_date =  $date;
        $donation_items->unit_offered = $row[5];
        $donation_items->pack_size = $row[6];
        $donation_items->unit_pallet = $row[7];
        $donation_items->pattle_guesstimate = $row[8];
        $donation_items->batch_number = $row[9];
        $donation_items->udi = $row[10];
        $donation_items->location = $row[11];
        $donation_items->lable_language = $row[12];
        $donation_items->specific_appeal = $row[13];
        
        if($row[14] == 'Y' || $row[14] == 'y'){
            $donation_items->pom = 1;
        }else{
            $donation_items->pom = 0;
        }
        
        if($row[15] == 'Y' || $row[15] == 'y'){
            $donation_items->cold_chain = 1;
        }else{
            $donation_items->cold_chain = 0;
        }
        
        if($row[16] == 'Y' || $row[16] == 'y'){
            $donation_items->controlled_drugs = 1;
        }else{
            $donation_items->controlled_drugs = 0;
        }
        
        if($row[17] == 'Y' || $row[17] == 'y'){
            $donation_items->serialize_stock = 1;
        }else{
            $donation_items->serialize_stock = 0;
        }
        
        if($row[18] == 'Y' || $row[18] == 'y'){
            $donation_items->dangerous_drugs = 1;
        }else{
            $donation_items->dangerous_drugs = 0;
        }
        
        $donation_items->storage_req = $row[19];
        
        if($row[20] == 'Y'){
            $donation_items->supplies = 1;
        }else{
            $donation_items->supplies = 0;
        }
        $donation_items->formulation = $row[21];
        $donation_items->unit_size = $row[22];
        $donation_items->unit_of_sale = $row[23];
        $donation_items->unit_per_case = $row[24];
        $donation_items->supplier_price_unit = $row[25];
        $donation_items->internal_price_unit = $row[26];
        $donation_items->reporting_req = $row[27];
        $donation_items->intended_market = $row[28];
        $donation_items->product_licence = $row[29];
        $donation_items->information = $row[30];
        $donation_items->comments = $row[31];
        $donation_items->status = 1;
        $donation_items->commit_status = 0;
        $donation_items->save();
        return $donation_items;
    } 
}
