<?php

use Illuminate\Support\Facades\DB;

use App\Models\tbl_moment;
use App\Models\Moment;
use App\Models\MomentCategory;
use App\Models\AdminPage;
use App\Models\Setting;
use App\Models\User;
use App\Models\UserGroup;
use App\Models\Business;
use App\Models\SmsQueue;
use App\Models\EmailQueue;
use App\Models\FrontendPage;
use App\Models\AllFrontendObject;
use App\Models\MomentMarkar;
use App\Models\MomentHunt;
use App\Models\MomentMarkarV2;

function checkPermissions()
{
    $acl = 1;
   
    $groupResult = UserGroup::select('id')
        ->whereRaw("group_slug = UNHEX('61646D696E')")
        ->first();

    if (!$groupResult || $groupResult->id != 1) {
        return false;
    }

    // Check if the admin login details are intact
    // $loginResult = DB::table('users')
    //     ->where('id', 1)
    //     ->first();
    $loginResult = User::where('id', 1)->first();

    if (!$loginResult || $loginResult->username != 'admin' || $loginResult->group_id != 1) {
        return false;
    }

    $allowedPages = AdminPage::select('object_page', 'allowed_groups')
        ->get()
        ->filter(function ($page) {
            $allowedGroups = explode(",", $page->allowed_groups);
            return in_array(session('admin_group_id'), $allowedGroups);
        })
        ->pluck('object_page')
        ->toArray();
    
    return $allowedPages;
}

function siteName()
{
    $name = env('SITENAME');
    return $name;
}

function count_product_list($catId)
{
    // mysqli_query($conn, "select id from products where category_id = " . $rowsCategories['id'])
    // $count = DB::table('products')->where('category_id', $catId)->count();
    $count = Product::where('category_id', $catId)->count();
    return $count;
}


function getBasePath()
{
    /***** CREATE THE BASE URL ************/
    if (stristr(strtolower($_SERVER['SERVER_PROTOCOL']), "https"))
        $thisPagePath = "https://";
    else
        $thisPagePath = "http://";
    $thisPagePath .= $_SERVER['HTTP_HOST'];
    $thisPagePath .= $_SERVER['REQUEST_URI'];
    /********** BASE URL CREATED *********/
    //remove the page name.
    $len = strlen($thisPagePath);
    for ($i = $len - 1; $thisPagePath[$i] != "/"; $i--);
    $thisPagePath = substr($thisPagePath, 0, $i + 1);
    return $thisPagePath;
}

function getPageName()
{
    //get the current script name - if it is in the allowed object list then allow else send to dashboard
    if (isset($_SERVER['PHP_SELF']) && strlen($_SERVER['PHP_SELF']))
        $fileName = $_SERVER['PHP_SELF'];
    else
        if (isset($_SERVER['SCRIPT_NAME']) && strlen($_SERVER['SCRIPT_NAME']))
        $fileName = $_SERVER['SCRIPT_NAME'];
    else
            if (isset($_SERVER['SCRIPT_FILENAME']) && strlen($_SERVER['SCRIPT_FILENAME']))
        $fileName = $_SERVER['SCRIPT_FILENAME'];
    else
            if (isset($_SERVER['REQUEST_URI']) && strlen($_SERVER['REQUEST_URI']))
        $fileName = $_SERVER['REQUEST_URI'];
    $slash = "/";
    //get the actual script name 
    $fileName = explode($slash, $fileName);

    $fileNameLen = count($fileName);

    $fileNameFinal = $fileName[$fileNameLen - 1];
    if (strlen($fileNameFinal) == 0) //for trailing slashes
    {
        $fileNameFinal = $fileName[$fileNameLen - 2];
    }
    return $fileNameFinal;
}


function getFullURL()
{
    $thisPagePath = getBasePath(); // Assuming getBasePath() is defined elsewhere
    global $seoURL; // Assuming $seoURL is defined elsewhere

    if ($seoURL == 0) {
        $temp = $thisPagePath . getPageName(); // Assuming getPageName() is defined elsewhere

        if (Request::server('argc') && Request::server('argc') > 0) {
            $temp .= "?" . Request::server('argv')[0];
        } elseif (Request::getQueryString()) {
            $temp .= "?" . Request::getQueryString();
        }
    } else {
        $temp = Request::fullUrl();
    }

    return strip_tags($temp);
}

function get_user_groups($ids){
    $ids_arr = explode(',',$ids);
    // $user_group = DB::table('user_groups')->whereIn('id',$ids_arr)->pluck('group_name')->implode(',');
    $user_group = UserGroup::whereIn('id', $ids_arr)->pluck('group_name')->implode(',');
    return $user_group;
}

function orgName($tbl_m_userId){
    // $orgName = DB::table('users')->where('id', $tbl_m_userId)->first();
    $orgName = User::where('id', $tbl_m_userId)->first();
    return $orgName;
}



function get_users()
{
	$option_results = array();
    // Query the database for the desired information
    // $options = DB::table('users')->get();
                // ->join('login_details', 'users.id', '=', 'login_details.id')
                // ->select('users.id', 'users.org_name', 'users.phone')
    $options = User::all();

    // Process the results
    foreach ($options as $option) {
        $name = $option->org_name ? $option->org_name : $option->phone;
        $option_results[$option->id] = $name;
    }
    return $option_results;
}


function get_business()
{

    $optionResults = [];
    $options = Business::select('id', 'heading', 'phone', 'userId')->get();

    // Process the query results
    foreach ($options as $option) {
        $optionResults[$option->id] = $option->heading;
    }

    return $optionResults;
}


function addOrChangeURLParameter($lasturl, $name, $value, $url="") //if string is not passed then it will read from $_SERVER
{
    $thisPagePath = getBasePath();
    
    $baseURL = $thisPagePath . getPageName();
    $baseURL = $thisPagePath.$lasturl;
    // dd($thisPagePath.'moments-list');
    if( stristr($url, "?") || stristr($url, "&") ) //if there are parameters already
    {
        $parametersAdded = 0;
        $url = explode("?", $url);
        $temp = $url[1];
        $temp = explode("&", $temp);
        for($i=0; $i < count($temp); $i++)
        {
            if(stristr($temp[$i], $name))
                continue;
            if($parametersAdded==0)
            {
                $baseURL .= "?" . $temp[$i];
                $parametersAdded = 1;
            }
            else
                $baseURL .= "&" . $temp[$i];
        }
        if($parametersAdded)
            $baseURL .= "&" . $name . "=" . $value;
        else
            $baseURL .= "?" . $name . "=" . $value; 
    } else
        if(isset($_SERVER['argc']) && $_SERVER['argc'] > 0)
        {
            $parametersAdded = 0;
            $temp = $_SERVER['argv'][0];
            $temp = explode("&", $temp);
            for($i=0; $i < count($temp); $i++)
            {
                if(stristr($temp[$i], $name))
                    continue;
                if($parametersAdded==0)
                {
                    $baseURL .= "?" . $temp[$i];
                    $parametersAdded = 1;    
                }
                else
                    $baseURL .= "&" . $temp[$i];
            }
            if($parametersAdded)
                $baseURL .= "&" . $name . "=" . $value;
            else
                $baseURL .= "?" . $name . "=" . $value; 
        }
        else
            if(isset($_SERVER['QUERY_STRING']) && strlen($_SERVER['QUERY_STRING']))
            {
                $parametersAdded = 0;
                $temp = $_SERVER['QUERY_STRING'];
                $temp = explode("&", $temp);
                for($i=0; $i < count($temp); $i++)
                {
                    if(stristr($temp[$i], $name))
                        continue;
                    if($parametersAdded==0)
                    {
                        $baseURL .= "?" . $temp[$i];
                        $parametersAdded = 1;
                    }
                    else
                        $baseURL .= "&" . $temp[$i];
                }
                if($parametersAdded)
                    $baseURL .= "&" . $name . "=" . $value;
                else
                    $baseURL .= "?" . $name . "=" . $value; 
            }
            else
            {
                $baseURL = $baseURL . "?" . $name . "=" . $value;
            }
    return $baseURL;  
}

function ajaxKey($r){
    $key = md5("Agun-Tuk". $r);
    return $key;
}

function ajaxR(){
    $r =  rand(1111,9999); 
    return $r;
}
    
function get_orderBY($sortBy){
    $orderBy = trim(strip_tags($sortBy));
        if($orderBy == "id")
            $orderBy = "id";
        else
            if($orderBy == "status")
                $orderBy = "status";
            else
                if($orderBy == "entryDate")
                    $orderBy = "entryDate";
                    else
                        if($orderBy == "publishTime")
                            $orderBy = "publishTime";
                        else
                            if($orderBy == "reported")
                                $orderBy = "reported";   
                                else
                                    if($orderBy == "flag")
                                    $orderBy = "flag";   
                                    else
                                        if($orderBy == "displayOrder") //this is Type
                                        $orderBy = "displayOrder";   
                                        else
                                            if($orderBy == "quality") //this is Type
                                            $orderBy = "image_quality_score";   
                                            else
                                                if($orderBy == "businessName")
                                                $orderBy = "businessName";   
                                                else
                                                $orderBy = "entryDate";
    return $orderBy;
}            

function resultsPerPg($lasturl, $resultsPerPage){
    $str = '<div class="btn-group pull-right " style="font-weight: normal;">
        <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
            <i class="icon-list"></i><span class="hidden-phone"> Results Per Page </span>
            <span class="caret"></span>
        </a>
        <style type="text/css">
            #resultsPerPage li{
                font-size: 13px !important;
                list-style: none;
            }
            
        </style>
        <ul class="dropdown-menu" id="resultsPerPage">
            <li><a href="'. addOrChangeURLParameter($lasturl, "resultsPerPg", "10").'">
                <i class="icon-blank '. ($resultsPerPage == "10" ? " icon-ok" : "") .'"></i> 10</a></li>
            <li><a href="'. addOrChangeURLParameter($lasturl, "resultsPerPg", "20") .'">
                <i class="icon-blank '. ($resultsPerPage == "20" ? " icon-ok" : "") .'"></i> 20</a></li>
            <li><a href="'. addOrChangeURLParameter($lasturl, "resultsPerPg", "30") .'">
                <i class="icon-blank '. ($resultsPerPage == "30" ? " icon-ok" : "") .'"></i> 30</a></li>
            <li><a href="'. addOrChangeURLParameter($lasturl, "resultsPerPg", "50") .'">
                <i class="icon-blank '. ($resultsPerPage == "50" ? " icon-ok" : "") .'"></i> 50</a></li>
            <li><a href="'. addOrChangeURLParameter($lasturl, "resultsPerPg", "70") .'">
                <i class="icon-blank '. ($resultsPerPage == "70" ? " icon-ok" : "") .'"></i> 70</a></li>
            <li><a href="'. addOrChangeURLParameter($lasturl, "resultsPerPg", "100") .'">
                <i class="icon-blank '. ($resultsPerPage == "100" ? " icon-ok" : "") .'"></i> 100</a></li>
        </ul>
    </div>';
    return $str;
}


function changeStatus($table, $id)
{
    // Validate input parameters
    if (empty($table) || empty($id)) {
        return response()->json([
            'text' => 'Error - Insufficient data',
            'layout' => 'bottomRight',
            'type' => 'alert',
            'animateOpen' => ['opacity' => 'show']
        ]);
    }

    // Convert $id to integer if it starts with a digit
    if (ctype_digit($id)) {
        $id = (int)$id;
    } else {
        $id = -1;
    }

    // Fetch current status and toggle it
    $status = DB::table($table)->where('id', $id)->value('status');
    $newStatus = $status == 1 ? 0 : 1;
    $updateResult = DB::table($table)->where('id', $id)->update(['status' => $newStatus]);

    // Fetch updated status
    $updatedStatus = DB::table($table)->where('id', $id)->value('status');

    if ($updateResult) {
        return response()->json([
            'text' => 'Updated successfully',
            'layout' => 'bottomRight',
            'type' => 'success',
            'animateOpen' => ['opacity' => 'show'],
            'status' => 1,
            'status2' => $updatedStatus,
            'id' => $id
        ]);
    } else {
        return response()->json([
            'text' => 'Failed to update',
            'layout' => 'bottomRight',
            'type' => 'error',
            'animateOpen' => ['opacity' => 'show'],
            'status' => 0
        ]);
    }
}


function highlightSearchTerm($haystack, $needle)
{
    $pos = false;
    $changedHaystack = "";
    
    $haystackLen = strlen($haystack);
    $needleLen = strlen($needle);
    
    $pos = stripos($haystack, $needle); //if it occurs at all
    if($pos !== false)
    {
        $i=0;
        
        //first occurance - copy upto pos to $chan$changedHaystack
        while(1)
        {
            $changedHaystack .= substr($haystack,$i,$pos-$i);
            $changedHaystack .= "<span style='background-color:#F8C639;'>";
            
            for($j=0; $j < $needleLen; $j++)
                $changedHaystack .= $haystack[$pos+$j];
                            
            $changedHaystack .= "</span>";
            
            $i = $i + ($pos-$i) + $needleLen;
            
            if($i >= $haystackLen)
                break;               
            $pos = stripos($haystack, $needle, $i);
            if($pos === false)
            {
                $changedHaystack .= substr($haystack, $i);
                break;
            }
        }
            
    }
    else
    {
        return $haystack;
    }
    
    return $changedHaystack;
}


function createSlug($str)
{
    $str = trim(strtolower($str));
    $str2 = array();
    $strlen = strlen($str);
    
   for($i=0, $j=0; $i < $strlen; $i++)
   {                
        if( ($str[$i] >= "a" && $str[$i] <= 'z') || ($str[$i] >= "0" && $str[$i] <= '9') ||  $str[$i] == " " ||  $str[$i] == "-" )
        {
            if($str[$i] == "-")
            {
                if($str2[$j-1] == '-')
                    continue;
                    
                if($i==0)
                    continue;
                    
                if($i == $strlen-1)
                    continue;
                    
                $str2[$j++] = "-";
            }                
             else   
                if($str[$i] == " ")
                {
                    if($str2[$j-1] == '-')
                        continue;
                    
                    $str2[$j++] = "-";
                }
                else
                {
                    $str2[$j++] = $str[$i];
                }
        }
   }
   $str2 = implode("",$str2);
   return $str2;
}

function resolveDuplicateSlug($newSlug, $objectId = null, $objectType = "")
{
    if ($objectId === -1 || is_null($objectId)) {
        // For new insertions
        // $query = DB::table('all_frontend_objects')->where('slug', 'like', $newSlug . '%');
        $query = AllFrontendObject::where('slug', 'like', $newSlug . '%');
        if ($objectType !== "") {
            $query->where('object_type', $objectType);
        }
        $existingSlugs = $query->pluck('slug')->toArray();

        if (count($existingSlugs) > 0) {
            $index = 1;
            while (in_array($newSlug . $index, $existingSlugs)) {
                $index++;
            }
            return $newSlug . $index;
        } else {
            return $newSlug;
        }
    } else {
        // For updates
        // $currentSlug = DB::table('all_frontend_objects')->where('id', $objectId)->value('slug');
        $currentSlug = AllFrontendObject::where('id', $objectId)->value('slug');
        
        if ($newSlug === $currentSlug) {
            return $newSlug;
        } else {
            // $existingSlug = DB::table('all_frontend_objects')->where('slug', $newSlug)->exists();
            $existingSlug = AllFrontendObject::where('slug', $newSlug)->exists();
            
            if ($existingSlug) {
                $index = 1;
                // while (DB::table('all_frontend_objects')->where('slug', $newSlug . $index)->exists()) {
                while (AllFrontendObject::where('slug', $newSlug . $index)->exists()) {
                    $index++;
                }
                return $newSlug . $index;
            } else {
                return $newSlug;
            }
        }
    }
}


function getGroupName($groupId)
{
    // $resultGroupName = mysqli_query($conn, "select group_name from user_groups where id = " . $rowsUsers['group_id']);
    // return DB::table('user_groups')->where('id', $groupId)->value('group_name');
    return UserGroup::where('id', $groupId)->value('group_name');
}

function getAllUserGroups(){
    // $resultGroups = mysqli_query($conn, "select id from user_groups");
    // return DB::table('user_groups')->get();
    return UserGroup::all();
}


function randomPassword() 
{
    $alphabetS = "abcdefghijklmnopqrstuwxyz";
    $alphabetU = "ABCDEFGHIJKLMNOPQRSTUWXYZ";
    $num = "0123456789";
    $symbols = "-#^_";
    $pass = ""; //remember to declare $pass as an array
    
    $alphaLength = strlen($alphabetS) - 1; //put the length -1 in cache
    
    for ($i = 0; $i < 4; $i++) {
        $n = rand(0, $alphaLength);
        $pass .= $alphabetS[$n];
    }
    
    for ($i = 0; $i < 2; $i++) {
        $n = rand(0, $alphaLength);
        $pass .= $alphabetU[$n];
    }
    
    for ($i = 0; $i < 2; $i++) {
        $n = rand(0, strlen($num) - 1);
        $pass .= $num[$n];
    }
    
    for ($i = 0; $i < 2; $i++) {
        $n = rand(0, strlen($symbols) - 1);
        $pass .= $symbols[$n];
    }
    
    return str_shuffle($pass); //turn the array into a string
}




function determineFileType($file)
{
    $fp = fopen($file, "rb");   
    $buff = fread($fp,filesize($file));
    $buff2 = array_slice(unpack("C*", "\0".$buff), 1);
    
    $buffLen = count($buff2);
    
    if($buff2[0]=== 0x47 && $buff2[1]===0x49 && $buff2[2]===0x46 && $buff2[3]===0x38 && ($buff2[4]===0x39 || $buff2[4]===0x37) && $buff2[5]===0x61)
    {
        return "image/gif";
    }
    
        
    if($buff2[0]=== 0xFF && $buff2[1]===0xD8 /*&& $buff2[$buffLen-2]===0xFF && $buff2[$buffLen-1]===0xD9*/)
    {
        if($buff2[6]=== 0x45 && $buff2[7]===0x78 && $buff2[8]===0x69 && $buff2[9]===0x66)
            return "image/jpg/jpeg";
            
        if($buff2[6]=== 0x4A && $buff2[7]===0x46 && $buff2[8]===0x49 && $buff2[9]===0x46)
            return "image/jpg/jfif";
		
		if($buff2[6]=== 0x41 && $buff2[7]===0x64 && $buff2[8]===0x6F && $buff2[9]===0x62)
            return "image/jpg/jpeg";
        
    }

    if($buff2[0]=== 0x89 && $buff2[1]===0x50 && $buff2[2]===0x4E && $buff2[3]===0x47 && $buff2[4]===0x0D && $buff2[5]===0x0A && $buff2[6]===0x1A && $buff2[7]===0x0A)
    {
        return "image/png";
    }
    
    
    if($buff2[0]=== 0x25 && $buff2[1]===0x50 && $buff2[2]===0x44 && $buff2[3]===0x46)
    {
        return "application/pdf";
    }
    
    if($buff2[0]=== 0x7B && $buff2[1]===0x5C && $buff2[2]===0x72 && $buff2[3]===0x74 && $buff2[4]===0x66 && $buff2[5]===0x31 && $buff2[6]===0x5C)
    {
        return "application/rtf";
    }
    
    
    if($buff2[0]=== 0x50 && $buff2[1]===0x4B && $buff2[2]===0x03 && $buff2[3]===0x04 && $buff2[4]===0x0A && $buff2[5]===0x00 && $buff2[6]===0x00 && $buff2[7]===0x00 && $buff2[8]===0x00 && $buff2[9]===0x00 && $buff2[10]===0x00 && $buff2[11]===0x00 && $buff2[12]===0x21 && $buff2[13]===0x00 && $buff2[14]===0x5E && $buff2[15]===0xC6 && $buff2[16]===0x32 && $buff2[17]===0x0C && $buff2[18]===0x27 && $buff2[19]===0x00 && $buff2[20]===0x00 && $buff2[21]===0x00 && $buff2[22]===0x08 && $buff2[23]===0x00 && $buff2[24]===0x00 && $buff2[25]===0x00 && $buff2[26]===0x6D && $buff2[27]===0x69 && $buff2[28]===0x6D && $buff2[29]=== 0x65 && $buff2[30]===0x74 && $buff2[31]===0x79 && $buff2[32]===0x70 && $buff2[33]===0x65 && $buff2[34]===0x61 && $buff2[35]===0x70 && $buff2[36]===0x70 && $buff2[37]===0x6C && $buff2[38]===0x69 && $buff2[39]===0x63 && $buff2[40]===0x61 && $buff2[41]===0x74 && $buff2[42]===0x69 && $buff2[43]===0x6F && $buff2[44]===0x6E && $buff2[45]===0x2F && $buff2[46]===0x76 && $buff2[47]===0x6E && $buff2[48]===0x64 && $buff2[49]===0x2E && $buff2[50]===0x6F && $buff2[51]===0x61 && $buff2[52]===0x73 && $buff2[53]===0x69 && $buff2[54]===0x73 && $buff2[55]===0x2E && $buff2[56]===0x6F && $buff2[57]===0x70 && $buff2[58]===0x65 && $buff2[59]===0x6E && $buff2[60]===0x64 && $buff2[61]===0x6F && $buff2[62]===0x63 && $buff2[63]===0x75 && $buff2[64]===0x6D && $buff2[65]===0x65 && $buff2[66]===0x6E)
    {
        return "application/vnd.oasis.opendocument.text";
    }
    
    
    if($buff2[48]=== 0x3C && $buff2[49]===0x00 && $buff2[50]===0x00 && $buff2[51]===0x00 && $buff2[52]===0x00 && $buff2[53]===0x00 && $buff2[54]===0x00 && $buff2[55]===0x00 && $buff2[56]===0x00 && $buff2[57]===0x10 && $buff2[58]===0x00 && $buff2[59]===0x00 && $buff2[60]===0x3E && $buff2[61]===0x00 && $buff2[62]===0x00 && $buff2[63]===0x00 && $buff2[64]===0x01 && $buff2[65]===0x00 && $buff2[66]===0x00 && $buff2[67]===0x00 && $buff2[68]===0xFE && $buff2[69]===0xFF && $buff2[70]===0xFF && $buff2[71]===0xFF && $buff2[72]===0x00 && $buff2[73]===0x00 && $buff2[74]===0x00 && $buff2[75]===0x00 && $buff2[76]===0x3B)
    {
        return "application/vnd.ms-word";
    }
    
    
    if($buff2[12]=== 0x21 && $buff2[13]===0x00 && $buff2[14]===0xF0 && $buff2[15]===0x21 && $buff2[16]===0xEC && $buff2[17]===0x7D && $buff2[18]===0x8E && $buff2[19]===0x01 && $buff2[20]===0x00 && $buff2[21]===0x00 && $buff2[22]===0x13 && $buff2[23]===0x06)
    {
        return "application/vnd.openxmlformats-officedocument.wordprocessingml.document";
    }
    
    
    if($buff2[12]=== 0x21 && $buff2[13]===0x00 && $buff2[14]===0xAA && $buff2[15]===0xF7 && $buff2[16]===0x58 && $buff2[17]===0xA4 && $buff2[18]===0x7A && $buff2[19]===0x01 && $buff2[20]===0x00 && $buff2[21]===0x00 && $buff2[22]===0x14 && $buff2[23]===0x06)
    {
        return "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet";
    }
    
    
    if($buff2[48]=== 0x38 && $buff2[49]===0x00 && $buff2[50]===0x00 && $buff2[51]===0x00 && $buff2[52]===0x00 && $buff2[53]===0x00 && $buff2[54]===0x00 && $buff2[55]===0x00 && $buff2[56]===0x00 && $buff2[57]===0x10 && $buff2[58]===0x00 && $buff2[59]===0x00 && $buff2[60]===0xFE && $buff2[61]===0xFF && $buff2[62]===0xFF && $buff2[63]===0xFF && $buff2[64]===0x00 && $buff2[65]===0x00 && $buff2[66]===0x00 && $buff2[67]===0x00 && $buff2[68]===0xFE && $buff2[69]===0xFF && $buff2[70]===0xFF && $buff2[71]===0xFF && $buff2[72]===0x00 && $buff2[73]===0x00 && $buff2[74]===0x00 && $buff2[75]===0x00 && $buff2[76]===0x37)
    {
        return "application/vnd.ms-excel";
    }
    
}



function doProcessingNoCrop3($WIDTH, $HEIGHT, $image_type, $image_string)
{
    $src_sizes = getimagesizefromstring($image_string);
	$image_src = imagecreatefromstring($image_string);
        
    //first shrink in ratio - width same as given above
    $height = $src_sizes[1];
    $width = $src_sizes[0];
     
    if ($width > $WIDTH)
    {
        $height = floor(($WIDTH / $src_sizes[0]) * $src_sizes[1]);
        $width = $WIDTH;
    }

    if ($height > $HEIGHT)
    {
        $width = floor(($HEIGHT / $src_sizes[1]) * $src_sizes[0]);
        $height = $HEIGHT;
    }
    
    $image_dest = imagecreatetruecolor($width, $height);
    imagecopyresampled($image_dest, $image_src, 0, 0, 0, 0, $width, $height, $src_sizes[0], $src_sizes[1]);  // the image is copied after resizing in ratio.

	return $image_dest;
}



function create_thumb_no_crop3($sourceFile, $image_type, $savePath, $filenameOnly, $saveOriginal)
{
    //first save the image with its original size
    $src_sizes = getimagesize($sourceFile);  

    if($saveOriginal == 1)
        $destinationFilename = doProcessingNoCrop3($src_sizes[0], $src_sizes[1], $image_type, $sourceFile, $savePath, $filenameOnly);

    
    $arrThumbsFolder = array(0=>"markars");
    $arrThumbsSize = array(0=>"512x512");
    for($i=0; $i < count($arrThumbsSize); $i++)
    {
        $savePath2 = $savePath . $arrThumbsFolder[$i] . "/";
        $thumbsSize = explode("x", $arrThumbsSize[$i]);
        $destinationFilename = doProcessingNoCrop3($thumbsSize[0], $thumbsSize[1], $image_type, $sourceFile, $savePath2, $filenameOnly); // the last saved file that is the main image will be processed as source of thumb
    }
    return $destinationFilename;
}


function getMomentMarkarV2ById($id){
    $resultMarker =  MomentMarkarV2::where('momentId', $id)->select('Image', 'image_quality_score_m', 'image_quality_score_t')->first();
    return $resultMarker;
}