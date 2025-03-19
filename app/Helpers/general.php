<?php

use Carbon\Carbon;
use App\Models\User;
use App\Models\Invoice;
use App\Models\Employee;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\UnitManagement;
use App\Models\BusinessSetting;
use Illuminate\Support\Facades\DB;
use App\Models\collections\Receipt;
use Illuminate\Support\Facades\Log;
use App\Models\collections\InvoiceSettings;
use App\Models\collections\ReceiptSettings;
use NumberToWords\NumberToWords;

if (! function_exists('clean_html')) {
    function clean_html($text = null)
    {
        if ($text) {
            $text = strip_tags($text, '<h1><h2><h3><h4><h5><h6><p><br><ul><li><hr><a><abbr><address><b><blockquote><center><cite><code><del><i><ins><strong><sub><sup><time><u><img><iframe><link><nav><ol><table><caption><th><tr><td><thead><tbody><tfoot><col><colgroup><div><span>');

            $text = str_replace('javascript:', '', $text);
        }
        return $text;
    }
}

if (! function_exists('no_data')) {
    function no_data($title = '', $desc = '', $class = null)
    {
        $title       = $title ? $title : __('general.nothing_here');
        $desc        = $desc ? $desc : __('general.nothing_here_desc');
        $class       = $class ? $class : 'my-4 pb-4';
        $no_data_img = asset('images/no-data.svg');

        $output = " <div class='no-data-screen-wrap text-center {$class} '>
            <img src='{$no_data_img}' style='max-height: 250px; width: auto' />
            <h3 class='no-data-title'>{$title}</h3>
            <h5 class='no-data-subtitle'>{$desc}</h5>
        </div>";
        return $output;
    }
}

if (! function_exists('uploadImage')) {

    function uploadImage($request)
    {
        if (! $request->hasFile('image')) {
            return;
        } else {
            $file = $request->file('image');
            $path = $file->store('users', [
                'disk' => 'public',
            ]);
            return $path;
        }
    }
}
if (! function_exists('amount_in_words')) {  
   
    function amount_in_words($amount, $currency_id=0){
        $currency = currency($currency_id);
        // $amount = explode('.', cnv_Float($amount));
        $amount = number_format((float)$amount, $currency['decimal_places'], '.', '');
        $amount = explode('.', $amount);
        $formatter = new \NumberFormatter('en', \NumberFormatter::SPELLOUT);

        $in_words = $currency['code'].'. ';
        $in_words .= str_replace('-', ' ', $formatter->format($amount[0]));
        if((float)$amount[1]){
            $decimal = str_replace('-', ' ', $formatter->format($amount[1]));
            $in_words .= ' and '.$decimal.' '.$currency['symbol_for_decimal'];
        }
        $in_words .= ' only';

        return ucwords($in_words); 
    }
}
if (! function_exists('currency')) {  
   
     function currency($curr_id = 0){
        // if($curr_id){
        //     $currency = find_one($curr_id, 'erp_currency');
        // } else {
            // $company = find_one(1, 'erp_company');
            $company = auth()->user() ?? User::first();
            $currency['code'] = $company['currency'];
            $currency['decimal_places'] = $company['decimals'];
            $currency['symbol_for_decimal'] = $company['denomination'];
        // }
        return $currency; 
    }
}
// if (! function_exists('general_search_unit')) {  
   
//     function general_search_unit($request)
//     {
//         $query = UnitManagement::emptyUnit(); 
    
//         $query->where(function ($mainQuery) use ($request) {
//             for ($i = 1; $i <= $request->total_no_of_required_units; $i++) {
//                 $propertyId        = $request->input("property_id-$i");
//                 $unitDescriptionId = $request->input("unit_description_id-$i");
//                 $unitTypeId        = $request->input("unit_type_id-$i");
//                 $unitConditionId   = $request->input("unit_condition_id-$i");
//                 $viewId            = $request->input("view_id-$i"); 
//                 if (!empty($propertyId) || !empty($unitDescriptionId) || !empty($unitTypeId) || !empty($unitConditionId) || !empty($viewId)) {
//                     $mainQuery->orWhere(function ($q) use ($propertyId, $unitDescriptionId, $unitTypeId, $unitConditionId, $viewId) {
//                         if (!empty($propertyId) && $propertyId != "0") {
//                             $q->where('property_management_id', $propertyId);
//                         }
//                         if (!empty($unitDescriptionId)) {
//                             $q->where('unit_description_id', $unitDescriptionId);
//                         }
//                         if (!empty($unitTypeId) && $unitTypeId != "0") {
//                             $q->where('unit_type_id', $unitTypeId);
//                         }
//                         if (!empty($unitConditionId)) {
//                             $q->where('unit_condition_id', $unitConditionId);
//                         }
//                         if (!empty($viewId)) {
//                             $q->where('view_id', $viewId);
//                         }
//                     });
//                 }
//             }
//         });
    
//         return $query->get();
//     }
// }
// if (! function_exists('expire_unit')) {  
   
//     function expire_unit($expiry_days, $first_model, $second_model)
//     {
//         DB::transaction(function () use ($expiry_days, $first_model, $second_model) {  
//             $firstModelInstance = app()->make("App\\Models\\$first_model");
//             $secondModelInstance = app()->make("App\\Models\\$second_model"); 
//             $expiredItems = $firstModelInstance::where('status', 'pending')
//                 ->whereRaw("DATEDIFF(NOW(), created_at) > ?", [$expiry_days])
//                 ->get();  
//             $item_id = lcfirst($first_model).'_id' ; 
//             if ($expiredItems->isNotEmpty()) { 
//                 $proposalIds = $expiredItems->pluck("id")->toArray();  
//                 foreach ($expiredItems as $proposal) {
//                     $proposal->update(['status' => 'canceled']);
//                 } 
//                 $unitManagementIds = $secondModelInstance::whereIn("$item_id", $proposalIds)
//                     ->pluck('unit_id')
//                     ->toArray(); 
                    
//                 if (!empty($unitManagementIds)) {
//                     UnitManagement::whereIn('id', $unitManagementIds)
//                         ->update(['booking_status' => 'empty']);
//                 }
//             }
//         });
//     }
// }

// if (! function_exists('get_business_settings')) {  
//     function get_business_settings($name)
//     {
//         $config = BusinessSetting::select('type' , 'value')->whereRaw("type LIKE ?", ["$name%"])->get();
//         return $config;
//     }
    
// }
if (! function_exists('get_settings')) {

    function get_settings($object, $type)
    {
        $config = null;
        foreach ($object as $setting) {
            if ($setting['type'] == $type) {
                $config = $setting;
            }
        }
        return $config;
    }
}
if (! function_exists('main_path')) {
    function main_path()
    {
        // by public work on htdocs 
        // without public work on php artisan ser
        return config('app.asset_url') .'public/assets/';
        // return 'assets/';
    }
}
// if (! function_exists('main_path')) {
//     function main_path($url = '/')
//     {
//         // احصل على الرابط الحالي
//         $currentUrl = url()->current();
 
//         $path = asset('assets/'.$url);
 

//         return $path;
//     }
// }
 
define('Enquiry_no_prefix', 'ENQ-');

if (! function_exists('enquiryNo')) {
    function enquiryNo()
    {
        $newId = 1;
        $table = DB::select("SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA = 'facility_management' AND TABLE_NAME = 'enquiries'");

        if (! empty($table)) {
            $newId = $table[0]->AUTO_INCREMENT;
        } else {
            $getId = DB::table('enquiries')->orderBy('id', 'desc')->limit(1)->first();
            $newId = $getId ? $getId->id + 1 : 1;

            // $getId = Enquiry::latest()->first();
        }

        $newIdFormatted = str_pad($newId, 4, '0', STR_PAD_LEFT);

        return Enquiry_no_prefix . $newIdFormatted;
    }
}

if (! function_exists('currencySymbol')) {
    function currencySymbol()
    {
        return 'BHD ';
    }
}
// if (! function_exists('proposalNo')) {
//     function proposalNo()
//     {
//         $proposal_prefix = optional(BusinessSetting::whereType('proposal_prefix')->first())->value;
//         $proposal_digits = optional(BusinessSetting::whereType('proposal_digits')->first())->value;
//         $proposal_date   = optional(BusinessSetting::whereType('proposal_date')->first())->value ?? now()->format('d/m/Y');
//         $proposal_date   = Carbon::createFromFormat('Y-m-d', $proposal_date)->format('Y-m-d');
//         define('proposal_no_prefix', $proposal_prefix);

//         $newId = 1;
//         $table = DB::select("SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA = 'facility_management' AND TABLE_NAME = 'proposals'");

//         if (! empty($table)) {
//             $newId = $table[0]->AUTO_INCREMENT;
//         } else {
//             $getId = DB::table('proposals')->orderBy('id', 'desc')->limit(1)->first();
//             $newId = $getId ? $getId->id + 1 : 1;
//         }

//         $newIdFormatted = str_pad($newId, $proposal_digits, '0', STR_PAD_LEFT);

//         return proposal_no_prefix . $newIdFormatted;
//     }
// }

// if (! function_exists('bookingNo')) {
//     function bookingNo()
//     {
//         $booking_prefix = optional(BusinessSetting::whereType('booking_prefix')->first())->value;
//         $booking_digits = optional(BusinessSetting::whereType('booking_digits')->first())->value;
//         $booking_date   = optional(BusinessSetting::whereType('booking_date')->first())->value ?? now()->format('d/m/Y');
//         $booking_date   = Carbon::createFromFormat('Y-m-d', $booking_date)->format('Y-m-d');
//         define('booking_no_prefix', $booking_prefix);

//         $newId = 1;
//         $table = DB::select("SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA = 'facility_management' AND TABLE_NAME = 'bookings'");

//         if (! empty($table)) {
//             $newId = $table[0]->AUTO_INCREMENT;
//         } else {
//             $getId = DB::table('bookings')->orderBy('id', 'desc')->limit(1)->first();
//             $newId = $getId ? $getId->id + 1 : 1;
//         }

//         $newIdFormatted = str_pad($newId, $booking_digits, '0', STR_PAD_LEFT);

//         return booking_no_prefix . $newIdFormatted;
//     }
// }

// if (! function_exists('agreementNo')) {
//     function agreementNo()
//     {
//         $agreement_prefix = optional(BusinessSetting::whereType('agreement_prefix')->first())->value;
//         $agreement_digits = optional(BusinessSetting::whereType('agreement_digits')->first())->value;
//         $agreement_date   = optional(BusinessSetting::whereType('agreement_date')->first())->value ?? now()->format('d/m/Y');
//         $agreement_date   = Carbon::createFromFormat('Y-m-d', $agreement_date)->format('Y-m-d');
//         define('agreement_no_prefix', $agreement_prefix);

//         $newId = 1;
//         $table = DB::select("SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA = 'facility_management' AND TABLE_NAME = 'agreements'");

//         if (! empty($table)) {
//             $newId = $table[0]->AUTO_INCREMENT;
//         } else {
//             $getId = DB::table('agreements')->orderBy('id', 'desc')->limit(1)->first();
//             $newId = $getId ? $getId->id + 1 : 1;
//         }

//         $newIdFormatted = str_pad($newId, $agreement_digits, '0', STR_PAD_LEFT);

//         return agreement_no_prefix . $newIdFormatted;
//     }
// }
// if (! function_exists('complaintNo')) {
//     function complaintNo()
//     {
//         $complaint_prefix = optional(BusinessSetting::whereType('complaint_prefix')->first())->value;
//         $complaint_width  = optional(BusinessSetting::whereType('complaint_width')->first())->value;
//         $complaint_suffix = optional(BusinessSetting::whereType('complaint_suffix')->first())->value;
//         $complaint_date   = optional(BusinessSetting::whereType('complaint_date')->first())->value ?? now()->format('d/m/Y');
//         $complaint_date   = Carbon::createFromFormat('Y-m-d', $complaint_date)->format('Y-m-d');
//         define('complaint_no_prefix', $complaint_prefix);

//         $newId = 1;
//         $table = DB::select("SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA = 'facility_management' AND TABLE_NAME = 'complaint_registrations'");

//         if (! empty($table)) {
//             $newId = $table[0]->AUTO_INCREMENT;
//         } else {
//             $getId = DB::table('complaint_registrations')->orderBy('id', 'desc')->limit(1)->first();
//             $newId = $getId ? $getId->id + 1 : 1;
//         }

//         $newIdFormatted = str_pad($newId, $complaint_width, '0', STR_PAD_LEFT);

//         return complaint_no_prefix . $newIdFormatted . '/' . $complaint_suffix;
//     }
// }
// if (! function_exists('invoiceNo')) {
//     function invoiceNo($type)
//     {
//         $invoice_settings = InvoiceSettings::where('invoice_type', 'like', "%{$type}%")->first();
//         $last_invoice     = Invoice::where('invoice_number', 'LIKE', "{$invoice_settings->invoice_prefix}%")
//             ->orderBy('id', 'desc')
//             ->first();

//         if ($last_invoice) {
//             $last_invoice_number    = (int) str_replace([$invoice_settings->invoice_prefix, $invoice_settings->invoice_suffix], '', $last_invoice->invoice_number);
//             $current_invoice_number = $last_invoice_number + 1;
//         } else {
//             $current_invoice_number = $invoice_settings->invoice_start_number;
//         }
//         $invoice_number = str_pad($current_invoice_number, $invoice_settings->invoice_width, '0', STR_PAD_LEFT);

//         return "{$invoice_settings->invoice_prefix}{$invoice_number}{$invoice_settings->invoice_suffix}";
//     }

// }
// if (! function_exists('receiptNo')) {
//     function receiptNo($type = 0)
//     {
//         if ($type == 0) {
//             $receipt_settings = ReceiptSettings::first();
//         } else {
//             $receipt_settings = ReceiptSettings::where('id', $type)->first();
//         }

//         if (! $receipt_settings) {
//             return ("لم يتم العثور على إعدادات الإيصال.");
//         }
//         //$receipt_settings->first()->result
//         // $receipt_settings = ReceiptSettings::where('id',  $type )->first();
//         $last_receipt = Receipt::where('receipt_ref', 'LIKE', "%{$receipt_settings->prefix}%")
//             ->orderBy('id', 'desc')
//             ->first();
//         // dd($last_receipt );
//         if ($last_receipt) {
//             $last_receipt_number    = (int) str_replace([$receipt_settings->prefix, $receipt_settings->sufix], '', $last_receipt->receipt_ref);
//             $current_receipt_number = $last_receipt_number + 1;
//         } else {
//             $current_receipt_number = $receipt_settings->starting_number;
//         }
//         $receipt_number = str_pad($current_receipt_number, $receipt_settings->total_digit, '0', STR_PAD_LEFT);

//         return "{$receipt_settings->prefix}{$receipt_number}{$receipt_settings->sufix}";
//     }

// }
// function invoiceNo($type)
// {
//     $invoice_settings = InvoiceSettings::where('invoice_type' , $type)->first();
//         $invoice_prefix = optional(BusinessSetting::whereType('invoice_prefix')->first())->value ?? '';
//         $invoice_width = optional(BusinessSetting::whereType('invoice_width')->first())->value ?? 6;
//         $invoice_suffix = optional(BusinessSetting::whereType('invoice_suffix')->first())->value ?? '';
//         $invoice_start_number = optional(BusinessSetting::whereType('invoice_start_number')->first())->value ?? 1;
//         static $current_invoice_number = null;

//         if (is_null($current_invoice_number)) {
//             $current_invoice_number = $invoice_start_number;
//         } else {
//             $current_invoice_number++;
//         }
//         $invoice_number = str_pad($current_invoice_number, $invoice_width, '0', STR_PAD_LEFT);
//         return "{$invoice_prefix}{$invoice_number}{$invoice_suffix}";
//     }
// }

if (! function_exists('selected')) {
    function selected($selected, $current = true, $echo = true)
    {
        return __checked_selected_helper($selected, $current, $echo, 'selected');
    }
}

if (! function_exists('__checked_selected_helper')) {
    function __checked_selected_helper($helper, $current, $echo, $type)
    {
        if ((string) $helper === (string) $current) {
            $result = " $type='$type'";
        } else {
            $result = '';
        }

        if ($echo) {
            echo $result;
        }

        return $result;
    }
}
 
 
if (!function_exists('uploadFile')) {
    function uploadFile(Request $request, $path)
    { 
        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');
            $extension = $file->getClientOriginalExtension(); 
            if (in_array($extension, ['jpg', 'jpeg', 'png', 'webp'])) {
                $folder = 'image'; 
            } elseif ($extension === 'pdf') {
                $folder = 'pdf'; 
            } else {
                return null;  
            } 
            $fileName = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $extension; 
            $destinationPath = public_path($folder . '/' . $path); 
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            } 
            $file->move($destinationPath, $fileName);

            return [
                'path' => $folder . '/' . $path . '/' . $fileName,  
                'type' => $folder
            ];
        }
        return null;  
    }
}


 
 