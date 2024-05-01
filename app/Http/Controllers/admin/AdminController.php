<?php

namespace App\Http\Controllers\admin;

use Session;
use App\Models\Moment;
use Illuminate\Http\Request;
use App\Models\MomentMarkarV2;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{

    // public function adminLogout(){
    //     Session::forget('admin_user_id');
    //     Session::forget('admin_sid');
    //     Session::forget('admin_salt');
    //     Session::forget('admin_group_id');
    //     Session::forget('admin_group_slug');
    //     Session::forget('admin_email');
    //     Session::forget('admin_name');

    //     // Regenerate session ID to prevent session fixation attacks
    //     Session::regenerate();
    //     auth()->logout();

    //     // Redirect to the desired location
    //     return redirect()->route('login');
    // }
    //

    public function moments_newList(Request $request){
        $data['search'] = $search = $request->search;
        $data['sort_by'] = $sort_by = $request->sort_by;
        $data['tbl_moment'] = Moment::query()
        ->when($search, function ($query, $search) {
            return $query->where('heading', $search);
        })
        ->when($request->has('sort_by'), function ($query) use ($request) {
            $sortField = $request->input('sort_by');
            return $query->orderBy($sortField);
        }, function ($query) {
            // Default sorting if 'sort_by' parameter is not provided
            return $query->orderBy('status');
        })
        ->paginate(9);
        
        
        // {{ $moments->links() }}        
        return view('admin.moments',$data);
    }

    public function update_product(Request $request){
       
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer',
            'value' => 'required|integer',
        ], [
            'id.integer' => 'The ID must be an integer.',
            'value.integer' => 'The order must be an integer.',
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
                'text' => 'Error - Insufficient data',
                'layout' => 'bottomRight',
                'type' => 'alert',
                'animateOpen' => ['opacity' => 'show']
            ], 422);
        }
        
        $id = $request->id;
        $order = $request->value;
    
        $result = Moment::where('momentId', $id)->update(['display_order' => $order]);

        if($result) {
            return response()->json([
                'text' => 'Updated successfully',
                'layout' => 'bottomRight',
                'type' => 'success',
                'animateOpen' => ['opacity' => 'show'],
                'status' => '1',
                'id' => (string) $id,
                'currrentOrder' => $order
            ]);
        } else {
            return response()->json([
                'text' => 'Failed to update',
                'layout' => 'bottomRight',
                'type' => 'error',
                'animateOpen' => ['opacity' => 'show'],
                'status' => '0'
            ]);
        }        
    }


    public function moments_add_edit(Request $req){
        $momentId = $req->tbl_m_id;
        $data['moment'] = Moment::where('momentid', $momentId)->first();
        $data['rowsMarker'] = MomentMarkarV2::where('momentId', $momentId)->first();
        
        // $data['resultFlag'] = MomentFlag::where('momentId', $momentId)->join('users', 'users.id', '=', 'momentflag.userId')->select('momentflag.userId', 'users.name', 'users.phone')->get();
        // $data['flagCount'] = $data['resultFlag']->count();
        // $data['resultMomentHunts'] = MomentHunt::where('moment_id', $momentId)->get();
        // $data['resultHunts'] = Hunt::all();
        return view('admin.moments_add_edit',$data);   
    
    }


    public function moments_add(){
        return view('admin.moments_add');
    }


    public function moment_adding(Request $request){
        // dd();
        // userId, heading, description, comment, promourl, publishDate, publishTime, expireDate, expireTime, locationAutoComplete, latitude, longitude, 
        
        // media1Type, video1_android, media1Chroma, media2Type, video2_android, media2Chroma, media3Type, video3_android, media3Chroma, media4Type, video4_android, media4Chroma, media5Type, video5_android, media5Chroma, media6Type, video6_android, media6Chroma, momentAddSubmit, momentId

        // files : Image
        // dd($request);
        $validator = Validator::make($request->all(), [
            'userId' => 'required',
            'heading' => 'required',
            'description' => 'required',
            'comment' => 'required',
            'promourl' => 'required',
            'publishDate' => 'required',
            'publishTime' => 'required',
            'expireDate' => 'required',
            'expireTime' => 'required',
            // 'locationAutoComplete' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
        ]);
    
        // dd($validator->fails());
        if ($validator->fails()) {
            return redirect()->route('admin.moments_newList');
        }

        // Instantiate an Amazon S3 client.
        $s3 = new S3Client([
            'region'      => 'us-east-1', // Replace with your S3 region
            'version'     => 'latest',
            'credentials' => [
                'key'    => 'AKIAXIKRHG7OHYHE6NFF', // Replace with your AWS access key ID
                'secret' => '+x1L0Jtmy5/cTwSE0wwhlRtoYo54wpwi2zPitvF7', // Replace with your AWS secret access key
            ],
        ]);

        // Instantiate an Amazon S3 client.
        $cloudfront = CloudFrontClient::factory(array(
            'credentials'=> [
                    'key'    => 'AKIAXIKRHG7OHYHE6NFF',
                    'secret' => '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'
            ],
            'region'=>'us-east-1', 
            'version'=>'latest'
        ));

        if( isset($request->heading) &&  isset($request->userId)  ) {
            // dd(isset($request->momentAddSubmit) ,  isset($request->heading) ,  isset($request->userId));
            $error = 0;
            $errorMessage = "";

            if(isset($request->userId) && strlen(strip_tags(trim($request->userId))))
            {
                $userId = strip_tags(trim($request->userId));
            }
            else $userId = "1";

            if(isset($request->momentId) && strlen(strip_tags(trim($request->momentId))))
            {
                $momentId = strip_tags(trim($request->momentId));
            }
            else $momentId = -1;
            
            if(isset($$request->businessId) && strlen(strip_tags(trim($request->businessId))))
            {
                $businessId = strip_tags(trim($request->businessId));
            }
            else $businessId = -1;

            if(isset($request->heading) && strlen(strip_tags(trim($request->heading))))
            {
                $heading = strip_tags(trim($request->heading));
            }
            else $heading = "";

            if(isset($request->description) && strlen(strip_tags(trim($request->description))))
            {
                $description = strip_tags(trim($request->description));
            }
            else $description = "";

            if(isset($request->sharedPhoneEmail) && count($request->sharedPhoneEmail) )
            {
                $sharedPhoneEmail = $request->sharedPhoneEmail;
            }
            else $contacts = array();
            
            if(isset($request->phones) && count($request->phones) )
            {
                $phones = $request->phones;
            }
            else $phones = array();
            
            if(isset($request->emails) && count($request->emails) )
            {
                $emails = $request->emails;
            }
            else $emails = array();

            if(isset($request->comment) && strlen(strip_tags(trim($request->comment))))
            {
                $comment = strip_tags(trim($request->comment));
            }
            else $comment = "";

            if(isset($request->ispublic) && strlen(strip_tags(trim($request->ispublic))))
            {
                $ispublic = strip_tags(trim($request->ispublic));
            }
            else $ispublic = "Y";

            if(isset($request->latitude) && strlen(strip_tags(trim($request->latitude))))
            {
                $latitude = strip_tags(trim($request->latitude));
            }
            else $latitude = "";

            if(isset($request->longitude) && strlen(strip_tags(trim($request->longitude))))
            {
                $longitude = strip_tags(trim($request->longitude));
            }
            else $longitude = "";

            if(isset($request->promourl) && strlen(strip_tags(trim($request->promourl))))
            {
                $promourl = strip_tags(trim($request->promourl));
            }
            else $promourl = "";


            if(isset($request->distance) && strlen(strip_tags(trim($request->distance))))
            {
                $distance = strip_tags(trim($request->distance));
            }
            else $distance = 0;

            if(isset($request->SelfDestruct) && strlen(strip_tags(trim($request->SelfDestruct))))
            {
                $SelfDestruct = strip_tags(trim($request->SelfDestruct));
            }
            else $SelfDestruct = '9999-01-01 00:00:00';

            if(isset($request->publishTime) && strlen(strip_tags(trim($request->publishTime))))
            {
                $publishTime = strip_tags(trim($request->publishTime));
            }
            else 
                $publishTime = date("Y-m-d H:i:s", time()); //'9999-01-01 00:00:00';
            
            
            if(isset($request->status) && strlen(strip_tags($request->status)))
            {
                $status = strip_tags($request->status);
            }
            else
                $status = '';
            
            if(isset($request->reason) && strlen(strip_tags($request->reason)))
            {
                $reason = strip_tags($request->reason);
            }
            else
		        $reason = '';


            // Update query
            // $query2 = DB::table('momentmarkar_v2');
            $query2 = MomentMarkarV2::query();

            if(isset($request->media1Type) && strlen(strip_tags($request->media1Type))) {
                $query2->update(['media1_type' => intval(trim(strip_tags($request->media1Type )))]);
            } else {
                $query2->update(['media1_type' => 0]);
            }
            
            if(isset($request->media1Chroma ) && strlen(strip_tags($request->media1Chroma ))) {
                $query2->update(['media1_chroma' => trim(strip_tags($request->media1Chroma))]);
            } else {
                $query2->update(['media1_chroma' => 'null']);
            }

            if(isset($request->media2Type) && strlen(strip_tags($request->media2Type)))
            {
                $query2->update(['media2_type' =>intval(trim(strip_tags($request->media2Type) )) ]);
            }
            else
                $query2->update([ 'media2_type' => "0" ]);
            
            if(isset($request->media2Chroma) && strlen(strip_tags($request->media2Chroma)))
            {
                $query2->update(["media2_chroma" => trim(strip_tags($request->media2Chroma))."'" ]);
            }
            else
                $query2->update(["media2_chroma" => 'null']);
            
            
            if(isset($request->media3Type) && strlen(strip_tags($request->media3Type)))
            {
                $query2->update([ "media3_type" => intval(trim(strip_tags($request->media3Type)))  ]);
            }
            else
                $query2->update([ "media3_type" =>"0" ]);


            if(isset($request->media3Chroma) && strlen(strip_tags($request->media3Chroma)))
            {
                $query2->update([ "media3_chroma" => trim(strip_tags($request->media3Chroma))."'" ]);
            }
            else
                $query2->update([ "media3_chroma" => 'null' ]);
                
                
            if(isset($request->media4Type) && strlen(strip_tags($request->media4Type)))
            {
                $query2->update([ "media4_type" => intval(trim(strip_tags($request->media4Type))) ]);
            }
            else
                $query2->update([ "media4_type" =>"0" ]);
            
            if(isset($request->media4Chroma) && strlen(strip_tags($request->media4Chroma)))
            {
                $query2->update(["media4_chroma" => trim(strip_tags($request->media4Chroma))."'" ]);
            }
            else
                $query2->update([ "media4_chroma" => 'null' ]);


            if(isset($request->media5Type) && strlen(strip_tags($request->media5Type)))
            {
                $query2->update(["media5_type" => intval(trim(strip_tags($request->media5Type))) ]);
            }
            else
                $query2->update(["media5_type" => "0"]);
            
            if(isset($request->media5Chroma) && strlen(strip_tags($request->media5Chroma)))
            {
                $query2->update([ "media5_chroma" =>trim(strip_tags($request->media5Chroma))."'" ]);
            }
            else
                $query2->update([ "media5_chroma" => 'null' ]);
            
            
            if(isset($request->media6Type) && strlen(strip_tags($request->media6Type)))
            {
                $query2->update([ "media6_type" => intval(trim(strip_tags($request->media6Type))) ]);
            }
            else
                $query2->update([ "media6_type" => "0" ]);

            if(isset($request->media6Chroma) && strlen(strip_tags($request->media6Chroma)))
            {
                $query2->update(["media6_chroma" => trim(strip_tags($request->media6Chroma))."'" ]);
            }
            else
                $query2->update([ "media6_chroma" => 'null' ]);

            // insert query
            if(isset($request->winnerVisitors) && strlen(strip_tags($request->winnerVisitors)))
            {
                $winnerVisitors = strip_tags($request->winnerVisitors );
                //remove astray spaces
                $winnerVisitorsArray = explode(",",$winnerVisitors);
                $winnerVisitorsArrayLen = count($winnerVisitorsArray);
                for($i = 0; $i < $winnerVisitorsArrayLen; $i++){
                    $winnerVisitorsArray[$i] = trim($winnerVisitorsArray[$i]);
                }
                $winnerVisitors = implode(",", $winnerVisitorsArray);
            }
            else
                $winnerVisitors = '';
            
            if(isset($request->winnerMessage) && strlen(strip_tags($request->winnerMessage)))
            {
                $winnerMessage = strip_tags($request->winnerMessage );
            }
            else
                $winnerMessage = '';

            // $query = DB::table('tbl_moment');
            // $updateFlag = 0;
            // $query->insert([
            //     'heading' => addslashes($heading),
            //     'description' => addslashes($description),
            //     'comment' => (strlen($comment) && $comment == "Y") ? addslashes($comment) : 'N',
            //     'ispublic' => (strlen($ispublic) && $ispublic == "Y") ? addslashes($ispublic) : 'N',
            //     'latitude' => addslashes($latitude),
            //     'longitude' => addslashes($longitude),
            //     'promourl' => addslashes($promourl),
            //     'distance' => $distance,
            //     'SelfDestruct' => addslashes($SelfDestruct),
            //     'userId' => $request->userId,
            //     'businessId' => '-1'
            // ]);
            $query = new tbl_moment();
            $query->heading = addslashes($heading);
            $query->description = addslashes($description);
            $query->comment = (strlen($comment) && $comment == "Y") ? addslashes($comment) : 'N';
            $query->ispublic = (strlen($ispublic) && $ispublic == "Y") ? addslashes($ispublic) : 'N';
            $query->latitude = addslashes($latitude);
            $query->longitude = addslashes($longitude);
            $query->promourl = addslashes($promourl);
            $query->distance = $distance;
            $query->SelfDestruct = addslashes($SelfDestruct);
            $query->userId = $request->userId;
            $query->businessId = '-1';
            $query->save();
                

            $contactsarr = [];
            if (isset($sharedPhoneEmail)) {
                $contactsarr = array_merge($contactsarr, $sharedPhoneEmail);
            }
            if (isset($phones)) {
                $contactsarr = array_merge($contactsarr, $phones);
            }
            if (isset($emails)) {
                $contactsarr = array_merge($contactsarr, $emails);
            }

            $shareemail="";
            $sharephone="";
            $shareemailarr=array();
            $sharephonearr=array();
            if (count($contactsarr)) {
                foreach ($contactsarr as $contact) {
                    if (strpos($contact, '@') !== false) {
                        $emailId = trim($contact);
                        if (strlen($emailId)) {
                            $shareemailarr[] = $emailId;
                        }
                    } else {
                        $phoneNumber = trim($contact);
                        if (strlen($phoneNumber)) {
                            $sharephonearr[] = $phoneNumber;
                        }
                    }
                }
                
                $shareemail = implode('##', array_filter($shareemailarr));
                $sharephone = implode('##', array_filter($sharephonearr));
            }

            if (strlen($shareemail)) {
                $query->where('momentid', $query->id)->update(['shareemail' => $shareemail]);
            }
            if (strlen($sharephone)) {
                $query->where('momentid', $query->id)->update(['sharephone' => $sharephone]);
            }
            $resss = $query->where('momentid', $query->id)->update([
                'userId' => $userId,
                'businessId' => $businessId,
                'isBusinessMoment' => ($businessId != -1) ? 1 : 0
            ]);

            if ($resss) {
                $errorMessage .= "<br>Moment saved successfully";
                $error = 0;
                $momentId = DB::getPdo()->lastInsertId();
            } else {
                $errorMessage .= "<br>Failed to update moment";
                $error = 1;
                $momentId = -1;
            }

            $im = false;
            if ($request->hasFile('Image')) {
                // To determine disk space requirement. First get the previous saved images and video sizes and then find the new size required
                $previousMediaSpace = 0;
                $file = $request->file('Image');
                $data = file_get_contents($file->getPathname());
                $im = imagecreatefromstring($data);

                if ($im !== false) {
                    // First delete the previous image/png
                    $target_path = asset('/')."admin/allfiles/moments/";
                    // Generate the image
                    ob_start();
                    imagejpeg($im, null, 80);
                    $outputImage = ob_get_contents();
                    ob_end_clean();
                    $imageSize = strlen($outputImage);

                    // Generate thumbnail
                    $thumbNailImage = doProcessingNoCrop3(256, 256, "image/jpeg", $data);
                    ob_start();
                    imagejpeg($thumbNailImage, null, 80);
                    $thumbNailImage = ob_get_contents();
                    ob_end_clean();
                    $thumbnailSize = strlen($thumbNailImage);

                    // Generate markar image
                    $markarImage = doProcessingNoCrop3(512, 512, "image/jpeg", $data);
                    ob_start();
                    imagejpeg($markarImage, null, 80);
                    $markarImage = ob_get_contents();
                    ob_end_clean();
                    $markarImageSize = strlen($markarImage);
                } else {
                    $errorMessage .= "<br>Error: failed to save Image";
                    $error = 1;
                }
            }

            $tempVideoName = [];
            $targetPath = asset('/')."admin/allfiles/moments/";

            for ($i = 1; $i <= 6; $i++) {



                if ($request->hasFile('video' . $i . '_ios') && $request->file('video' . $i . '_ios')->isValid() && intval(trim(strip_tags($request->input('media' . $i . 'Type')))) == 0) {
                    $previousMediaSpace = 0;

                    $videoFile = $request->file('video' . $i . '_ios');
                    $tempVideoName[$i - 1] = "TEMP_" . time() . rand(111, 999) . $userId . 'V' . $i . '.mp4';
                    
                    // Save the video data to temporary file
                    $videoData = file_get_contents($videoFile->getPathname());
                    Storage::put($targetPath . '/' . $tempVideoName[$i - 1] . "RAW", $videoData);
                    
                    // Convert the video to MP4 format
                    exec("ffmpeg -y -i " . storage_path('app/' . $targetPath . '/' . $tempVideoName[$i - 1] . "RAW") . " -crf 25 -metadata:s:v rotate=0 -map 0 -threads 2 -pix_fmt yuva420p -c:a copy -c:v libx264 -tune fastdecode " . storage_path('app/' . $targetPath . '/' . $tempVideoName[$i - 1]), $outputMessage1, $returnMessage1);
                    
                    // Delete the temporary RAW file
                    Storage::delete($targetPath . '/' . $tempVideoName[$i - 1] . "RAW");
                    
                    // Get the video size
                    $videoSize = Storage::size($targetPath . '/' . $tempVideoName[$i - 1]);
                } else {
                    $tempVideoName[$i - 1] = "";
                }
            }
            
            if ($request->hasFile('winnerVideo') && $request->file('winnerVideo')->isValid() && strlen($request->input('winnerVisitors'))) {
                $targetPath = asset('/')."admin/allfiles/moments/";
                $previousMediaSpace = 0;
                $winnerVideoFile = $request->file('winnerVideo');
                $winnerVideoData = file_get_contents($winnerVideoFile->getPathname());
                $tempWinnerVideoName = "TEMP_" . time() . rand(111, 999) . $userId . 'WV.mp4';
            
                // Save the winner video data to a temporary file
                Storage::put($targetPath . '/' . $tempWinnerVideoName . "RAW", $winnerVideoData);
            
                // Convert the winner video to MP4 format and record the size
                exec("ffmpeg -y -i " . storage_path('app/' . $targetPath . '/' . $tempWinnerVideoName . "RAW") . " -c:v libx264 -c:a aac -crf 25 -vf scale=-2:720,format=yuv420p -metadata:s:v rotate=0 -threads 1 -c:v libx264 -tune fastdecode " . storage_path('app/' . $targetPath . '/' . $tempWinnerVideoName));
                // Delete the temporary RAW file
                Storage::delete($targetPath . '/' . $tempWinnerVideoName . "RAW");
                // Get the size of the processed winner video
                $winnerVideoSize = Storage::size($targetPath . '/' . $tempWinnerVideoName);
            }
            
	
            if ($error == 0) {
                $mediaInsertQuery = "";
                $targetPath = asset('/')."admin/allfiles/moments/";
                // $target_path = asset('/')."admin/allfiles/moments/";
                
                for ($i = 1; $i <= 6; $i++) {
                    if (strlen($tempVideoName[$i - 1])) {
                        // Video already saved as TEMP
                        // Rename the TEMP video to actual name
                        $videoName = $momentId . 'V' . $i . '.mp4';
                        $mediaInsertQuery .= "media" . $i . "_ios ='" . $videoName . "', ";
                        rename(storage_path('app/' . $targetPath . '/' . $tempVideoName[$i - 1]), storage_path('app/' . $targetPath . '/' . $videoName));
                        
                        // Process video thumbnail asynchronously
                        $videoPath = storage_path('app/' . $targetPath . '/' . $videoName);
                        Queue::push(new ProcessVideoThumbnail($videoPath, $momentId, $i));
                        
                        // Upload the video to AWS S3
                        try {
                            $s3 = new S3Client([
                                'version' => 'latest',
                                'region' => 'your-aws-region',
                                'credentials' => [
                                    'key' => 'your-aws-access-key',
                                    'secret' => 'your-aws-secret-key',
                                ],
                            ]);
            
                            $s3->putObject([
                                'Bucket' => 'arconnect-medias',
                                'Key' => $videoName,
                                'Body' => fopen($videoPath, 'r'),
                                'ACL' => 'public-read',
                            ]);
                        } catch (Aws\S3\Exception\S3Exception $e) {
                            echo "There was an error uploading the file.\n";
                            echo($e);
                        }
                    }
                }

                //$threeDInsertQuery = "";
                $mediaInsertQuery = "";
                $targetPath = asset('/')."admin/allfiles/moments/";
                
                for ($i = 1; $i <= 6; $i++) {
                    // if( isset($_FILES['media'.$i."_ios"]['tmp_name']) && strlen($_FILES['media'.$i."_ios"]['tmp_name']) && intval(trim(strip_tags($_POST['media'.$i.'Type']))) == 1 )
                    if ($request->hasFile('media' . $i . '_ios') && $request->file('media' . $i . '_ios')->isValid() && intval(trim(strip_tags($request->input('media' . $i . 'Type')))) == 1) {
                        $threeDNameIOS = $momentId . '3D' . $i . '.usdz';
                        
                        if (Storage::exists($targetPath . '/' . $threeDNameIOS)) {
                            Storage::delete($targetPath . '/' . $threeDNameIOS);
                        }
                
                        $request->file('media' . $i . '_ios')->storeAs($targetPath, $threeDNameIOS);
                
                        // Upload to S3
                        try {
                            $s3 = new S3Client([
                                'version' => 'latest',
                                'region' => 'your-aws-region',
                                'credentials' => [
                                    'key' => 'your-aws-access-key',
                                    'secret' => 'your-aws-secret-key',
                                ],
                            ]);
                
                            $s3->putObject([
                                'Bucket' => 'arconnect-medias',
                                'Key' => $threeDNameIOS,
                                'Body' => fopen(storage_path('app/' . $targetPath . '/' . $threeDNameIOS), 'r'),
                                'ACL' => 'public-read',
                            ]);
                        } catch (Aws\S3\Exception\S3Exception $e) {
                            echo "There was an error uploading the file.\n";
                            echo $e->getMessage();
                        }
                        
                        $mediaInsertQuery .= "media" . $i . "_ios ='" . $threeDNameIOS . "', ";
                    }
                
                    if ($request->hasFile('media' . $i . '_android') && $request->file('media' . $i . '_android')->isValid() && intval(trim(strip_tags($request->input('media' . $i . 'Type')))) == 1) {
                        $threeDNameAndroid = $momentId . '3D' . $i . '.glb';
                        
                        if (Storage::exists($targetPath . '/' . $threeDNameAndroid)) {
                            Storage::delete($targetPath . '/' . $threeDNameAndroid);
                        }
                
                        $request->file('media' . $i . '_android')->storeAs($targetPath, $threeDNameAndroid);
                
                        // Upload to S3
                        try {
                            $s3 = new S3Client([
                                'version' => 'latest',
                                'region' => 'your-aws-region',
                                'credentials' => [
                                    'key' => 'your-aws-access-key',
                                    'secret' => 'your-aws-secret-key',
                                ],
                            ]);
                
                            $s3->putObject([
                                'Bucket' => 'arconnect-medias',
                                'Key' => $threeDNameAndroid,
                                'Body' => fopen(storage_path('app/' . $targetPath . '/' . $threeDNameAndroid), 'r'),
                                'ACL' => 'public-read',
                            ]);
                        } catch (Aws\S3\Exception\S3Exception $e) {
                            echo "There was an error uploading the file.\n";
                            echo $e->getMessage();
                        }
                
                        $mediaInsertQuery .= "media" . $i . "_android ='" . $threeDNameAndroid . "', ";
                    }
                }

                if ($request->hasFile('winnerVideo') && $request->file('winnerVideo')->isValid() && strlen($winnerVisitors)) {
                    $targetPath = "allfiles/moments";
                    $winnerVideoName = $momentId . 'WV.mp4';
                
                    // Move the temporary winner video file to its final destination
                    $request->file('winnerVideo')->move(storage_path('app/' . $targetPath), $winnerVideoName);
                } else {
                    $winnerVideoName = "";
                }


                // Assuming $im is an image resource obtained earlier in the code
                if ($im !== false) {
                    $fileName = $momentId . 'I.jpg'; // Image will be saved as JPG
                    
                    // Save the image to the specified directories
                    $targetPath = asset('/')."admin/allfiles/moments/";
                    
                    Storage::put($targetPath . $fileName, $outputImage);

                    $targetPath = asset('/')."admin/allfiles/moments/thumbs/";
                    Storage::put($targetPath . $fileName, $thumbNailImage);

                    $targetPath = asset('/')."admin/allfiles/moments/markars/";
                    Storage::put($targetPath . $fileName, $markarImage);

                    // Destroy the image resource to free up memory
                    imagedestroy($im);

                    // Execute arcoreimg command to evaluate image quality
                    exec('./arcoreimg eval-img --input_image_path=allfiles/moments/markars/' . $fileName . ' 2>&1', $outputImageScoreM, $returnImageScore);

                    // Insert data into the database using Eloquent ORM
                    // $result = DB::table('momentmarkar_v2')->insert([
                    $result = MomentMarkarV2::create([
                        'image_quality_score_t' => $thumbScore,
                        'image_quality_score_m' => intval($outputImageScoreM[0]),
                        'momentId' => $momentId,
                        'Image' => $fileName,
                        // Add other columns and values as needed
                        'winnerVideo' => $winner_video_name,
                        'winnerVisitors' => $winnerVisitors,
                        'winnerMessage' => $winnerMessage,
                        'uniqueId' => '',
                        'createDate' => now(),
                        'status' => 'Y'
                    ]);
                    
                    if ($result) {
                        $score = intval($outputImageScoreM[0]);
                        $errorMessage .= "<br>Markers saved successfully";
                        $errorMessage .= "<br>Score: " . $score;
                        $error = 0;
                    } else {
                        $errorMessage .= "<br>Failed to save markers";
                        $error = 1;
                    }
                }

                $query2 .= " where momentId = ".$momentId;

                // Execute the query and check for success
                if (DB::update($query2) && $error == 0) {
                    $errorMessage .= "Moment updated successfully";
                    $error = 0;
                } else {
                    $errorMessage .= "Failed to update moment";
                    $error = 1;
                }


                $countEmails = count($shareemailarr);

                if ($countEmails) {
                    $text = "New Moment Shared. TeamDLS. <a href='https://api.arconnect.app/view.html'>Click to see!</a>";
                    $subject = "New Moment " . $heading . " shared with you";

                    // Insert emails into the email queue
                    foreach ($shareemailarr as $email) {
                        // DB::table('tbl_emailqueue')->insert([
                        //     'emailId' => $email,
                        //     'momentId' => $momentId,
                        //     'subject' => $subject,
                        //     'text' => $text,
                        //     'queuedTimestamp' => now()->timestamp,
                        //     'sent' => 0,
                        //     'sentTimestamp' => -1,
                        //     'retried' => 0,
                        //     'failed' => 0
                        // ]);
                        EmailQueue::create([
                            'emailId' => $email,
                            'momentId' => $momentId,
                            'subject' => $subject,
                            'text' => $text,
                            'queuedTimestamp' => now()->timestamp,
                            'sent' => 0,
                            'sentTimestamp' => -1,
                            'retried' => 0,
                            'failed' => 0
                        ]);

                    }
                }

                $countPhones = count($sharephonearr);
                if ($countPhones) {
                    $text = "New Moment Shared. TeamDLS App. Click to see! https://api.arconnect.app/view.html";
                    // Insert phone numbers into the SMS queue
                    foreach ($sharephonearr as $phoneNumber) {
                        SmsQueue::create([
                            'phoneNumber' => $phoneNumber,
                            'momentId' => $momentId,
                            // 'subject' => '',
                            'text' => $text,
                            'queuedTimestamp' => now()->timestamp,
                            'sent' => 0,
                            'sentTimestamp' => -1,
                            'retried' => 0,
                            'failed' => 0
                        ]);
                    }
                }


                $shareWithPublic = 'Y';
                if($shareWithPublic == 'Y') //wll be public always hence the 1
                {
                    $server_key = ""; // get this from Firebase project settings->Cloud Messaging
                    $FCMUrl = 'https://fcm.googleapis.com/fcm/send';
                    $user_token = "/topics/newpublicmoment"; // Token generated from Android device after setting up firebase
                    $title = "New AR Content Released";
                    $id = intval(time() + rand(111, 999));
                    $file_name = "your_image_file_name.jpg"; // Set the image file name

                    $fcmMsgData = [
                        'body' => "New AR Content Shared. TeamDLS App. Click to see!",
                        'title' => $title,
                        'date' => date("Y-m-d H:i:s", time()),
                        'openScene' => "moment",
                        'id' => $id,
                        'apns' => [
                            "payload" => [
                                "aps" => [
                                    "content_available" => 1,
                                    "apns-priority" => 5,
                                    "mutable-content" => 1,
                                    "showinforeground" => true
                                ]
                            ],
                            "fcm_options" => ["image" => 'https://api.arconnect.app/allfiles/moments/thumbs/' . $file_name]
                        ],
                        'momentId' => $momentId, // Assuming $momentId is already defined
                        'momentImage' => 'https://api.arconnect.app/allfiles/moments/thumbs/' . $file_name
                    ];

                    $newData = [
                        'data' => $fcmMsgData,
                        'id' => $id
                    ];

                    $fcmMsgNotification = [
                        'body' => "New AR Content Shared. TeamDLS App. Click to see!",
                        'title' => $title,
                        'sound' => "default",
                        'click_action' => 'com.google.firebase.MESSAGING_EVENT',
                        'date' => date("Y-m-d H:i:s", time()),
                        'image' => 'https://api.arconnect.app/allfiles/moments/thumbs/' . $file_name
                    ];

                    $fcmFields = [
                        'to' => $user_token,
                        'priority' => 'high',
                        'notification' => $fcmMsgNotification,
                        'data' => $newData
                    ];

                    $client = new Client();
                    $response = $client->post($FCMUrl, [
                        'headers' => [
                            'Content-Type' => 'application/json',
                            'Authorization' => 'key=' . $server_key
                        ],
                        'json' => $fcmFields
                    ]);

                    $FCMResult = $response->getBody()->getContents();
                    file_put_contents("public_push_status.txt", $FCMResult, FILE_APPEND);
                    
                }

            }// error = 0 

            if ($momentId != -1 && isset($request->huntId)) {
                foreach ($request->huntId as $key => $huntId) {
                    if (strlen($huntId)) {
                        // First check if there is a hunt already in the same position
                        $resultHuntPositionCheck = DB::select("SELECT id FROM moment_hunts WHERE huntLevel = ? AND moment_id != ?", [$request->huntLevel[$key], $momentId]);
                        if (count($resultHuntPositionCheck) > 0) {
                            $huntName = DB::table('hunts')->where('huntId', $huntId)->value('huntName') ?? "";
                            $errorMessage .= "<br>Failed to save Hunt " . $huntName . ". Another moment already exists in the same position";
                            $error = 1;
                            continue;
                        }
            
                        $insertData = [
                            'moment_id' => $momentId,
                            'huntId' => $huntId,
                            'huntLevel' => $request->huntLevel[$key],
                            'hint' => htmlspecialchars(_sanitize($request->huntHint[$key]), ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML401),
                            'huntFoundMsg' => htmlspecialchars(_sanitize($request->huntFoundMsg[$key]), ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML401)
                        ];
            
                        if (MomentHunt::create($insertData)) {
                            $errorMessage .= "<br>Hunts saved successfully";
                            $error = 0;
                        } else {
                            $errorMessage .= "<br>Failed to save Hunts";
                            $error = 1;
                        }
                    }
                }
            }

            if($error){
                Session::put('error', 1);
                Session::put('errorMsg', '{"text":"'.$errorMessage.'","layout":"bottomRight","type":"error","animateOpen": {"opacity": "show"}}' );
            }else{
                Session::put('error' , 0);
                Session::put('errorMsg', '{"text":"'.$errorMessage.'","layout":"bottomRight","type":"success","animateOpen": {"opacity": "show"}}' );
            }
        }

        return redirect()->route('admin.moments_newList')->with('message', 'Your message goes here');
    }


    public function resetcronflags(){

        return view('admin.resetcronflags');
    }


    public function resetCron(Request $request)
    {
            $error = 0;
            $errorMessage = "";

            if (!Storage::put('smscronflag', '0')) {
                $error = 1;
                $errorMessage .= "Failed to reset SMS Cron<br/>";
            }

            // Reset Email Cron flag
            if (!Storage::put('emailcronflag', '0')) {
                $error = 1;
                $errorMessage .= "Failed to reset Email Cron<br/>";
            }

            // Reset Expiry Processing Cron flag
            if (!Storage::put('inappexpirycronflag', '0')) {
                $error = 1;
                $errorMessage .= "Failed to reset Expiry Processing Cron<br/>";
            }

            // Reset Expiry Notification Cron flag
            if (!Storage::put('expirynotcronflag', '0')) {
                $error = 1;
                $errorMessage .= "Failed to reset Expiry Notification Cron<br/>";
            }

            
            // Set session error and message
            $_SESSION['error'] = $error;
            if ($error == 1) {
                $type = "error";
            } else {
                $type = "success";
                $errorMessage .= "All Cron flags were reset<br/>";
            }

            $_SESSION['errorMsg'] = '{"text":"' . $errorMessage . '","layout":"bottomRight","type":"' . $type . '","animateOpen": {"opacity": "show"}}';

            return redirect()->route('resetcronflags');

    }
}
