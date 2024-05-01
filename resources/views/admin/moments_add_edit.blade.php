{{-- @extends('layout.app')

@section('title', 'home')

@section('content')
    <style type="text/css">
        .pageHeaderButtons div {
            float: left;
            margin-right: 5px;
        }

        #hunt_wrapper {
            padding: 10px;
        }

        .hunt-item {
            border: 1px solid #e9e9e9;
            padding: 20px;
        }
    </style> --}}
<x-app-layout>
    <div class="row">
        <div class="box col-md-12">
            <div class="box-inner">
                <div class="box-header well" data-original-title="">
                    <h2><i class="glyphicon glyphicon-plus "></i> Add Moments </h2>
                </div>
                <div class="box-content">
                    <br>
                    {{-- starts here --}}

                    <form class="form-horizontal  offset6 span8" action="{{ route('moment_adding') }}" method="post"
                        enctype="multipart/form-data">
                        @csrf

                        <!--onsubmit="return validate_hunt_fields()">-->
                        <fieldset>
                            <div class="control-group">
                                <label class="control-label" for="selectError3">Moment Id</label>
                                <div class="controls">
                                    {{ $moment->momentid }}
                                </div>
                            </div>


                            <div class="control-group">
                                <label class="control-label" for="selectError3">User</label>
                                <div class="controls">
                                    <select name="userId" id="userId" onchange="userIdChanged(this)">
                                        <option value="-1">--Select User--</option>
                                        <?php
									if(1)
									{
										$get_options = get_users();
										foreach ($get_options as $key => $value) 
										{
									?>
                                        <option value="{{ $key }}"
                                            @if ($moment->userId == $key) selected @endif><?php echo $value; ?>
                                        </option>
                                        <?php        
										}
									}
									?>
                                    </select>
                                    <span class="help-inline error" id="userIdError"></span>
                                </div>
                            </div>
                            <?php
                            ?>
                            {{-- my code ends --}}


                            <div class="control-group">
                                <label class="control-label" for="selectError3">Name/Title</label>
                                <div class="controls">
                                    <input type="text" name="heading" id="heading" class="input-xlarge focused"
                                        value="{{ $moment->heading }} " required />
                                    <span class="help-inline error" id="headingError"></span>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label" for="selectError3">Description</label>
                                <div class="controls">
                                    {{-- <textarea class="cleditor" id="description" name="description" rows="3"></textarea><span class="help-inline error" id="descriptionError"></span> --}}
                                </div>
                                <div id="editor">
                                    <textarea class="cleditor" id="editor" name="description" rows="3">{{ $moment->description }}</textarea>

                                </div>
                            </div>

                            <div class="control-group">
                                <div class="box">
                                    <h5 style="margin:5px;">Allow Comments</h5>
                                    <div class="control-group">
                                        <div class="controls">
                                            <label class="radio " style="margin-right:15px;">
                                                <input type="radio" name="comment" id="commentY" value="Y"
                                                    {{ $moment->comment == 'Y' ? "checked='checked'" : '' }}> Yes
                                            </label>
                                            <label class="radio " style="margin-top:5px; margin-right:15px;">
                                                <input type="radio" name="comment" id="commentN" value="N"
                                                    {{ $moment->comment == 'N' ? "checked='checked'" : '' }}> No
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
						if(0)
						{
						?>
                            <div class="control-group">
                                <div class="box">
                                    <h5 style="margin:5px;">Public</h5>
                                    <div class="control-group">
                                        <div class="controls">
                                            <label class="radio " style="margin-right:15px;">
                                                <input type="radio" name="ispublic" id="ispublicY" value="Y"
                                                    {{ $moment->ispublic == 'Y' ? "checked='checked'" : '' }}> Yes
                                            </label>
                                            <label class="radio " style="margin-top:5px; margin-right:15px;">
                                                <input type="radio" name="ispublic" id="ispublicN" value="N"
                                                    {{ $moment->ispublic == 'N' ? "checked='checked'" : '' }}> No
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
						}
						?>
                            <?php
						if(0)
						{
						?>
                            <div class="control-group">
                                <div class="box" id="divSharedInputs">
                                    <h5 style="margin:5px;">Shared With</h5>
                                    <input class="btn btn-primary pull-right" type="button"
                                        value="Add More Share Fields" onclick="addShareFields()">
                                    <div class="control-group">
                                        <div class="controls">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <?php 
						}
                        // print_r($moment);
                        // exit;
						?>
                            <div class="control-group">
                                <div class="box">
                                    <h5 style="margin:5px;">URL</h5>
                                    <div class="control-group">
                                        <div class="controls">
                                            <input class="" id="promourl" name="promourl" type="url"
                                                value="{{ $moment->promourl }}">
                                            <span class="help-inline error" id="urlError"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="box">
                                    <h5 style="margin:5px;">Publish Date and Time</h5>
                                    <div class="control-group">
                                        <div class="controls">
                                            <?php
                                            $dateTime = explode(' ', $moment->publishTime);
                                            // echo $moment->SelfDestruct;
                                            // exit;
                                            ?>
                                            <input class="" id="publishDate" name="publishDate" type="date"
                                                value="{{ $dateTime[0] }}">
                                            <span class="help-inline error" id="publishDateError"></span>
                                            <input class="" id="publishTime" name="publishTime" type="time"
                                                value="{{ @$dateTime[1] }}">
                                            <span class="help-inline error" id="publishTimeError"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="control-group">
                                <div class="box">
                                    <h5 style="margin:5px;">Expire Date and Time</h5>
                                    <div class="control-group">
                                        <?php
                                        $dateTime = explode(' ', $moment->selfDestruct);
                                        // print_r($moment);
                                        ?>
                                        <div class="controls">
                                            <input class="" id="expireDate" name="expireDate" type="date"
                                                value="{{ $dateTime[0] }}">
                                            <span class="help-inline error" id="expireDateError"></span>
                                            <input class="" id="expireTime" name="expireTime" type="time"
                                                value="{{ @$dateTime[1] }}">
                                            <span class="help-inline error" id="expireTimeError"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="control-group">
                                <div class="box">
                                    <h5 style="margin:5px;">Location</h5>
                                    <input type="text" name="locationAutoComplete" id="locationAutoComplete">
                                    <input type="text" name="latitude" id="latitude"
                                        value="{{ $moment->latitude }}">
                                    <input type="text" name="longitude" id="longitude"
                                        value="{{ $moment->longitude }}">
                                    <div class="control-group" style="height: 300px;">
                                        <div class="" style="height: 300px;" id="mapbox"></div>
                                    </div>
                                </div>
                            </div>


                            <div class="control-group">
                                <label class="control-label" for="selectError3">Image 1</label>
                                <div class="controls">
                                    <input class="input-file uniform_on" id="Image" name="Image" required
                                        type="file" accept="image/*">
                                </div>
                                <div class="controls thumbnail">
                                    @if (isset($rowsMarker->Image))
                                        @if (strlen($rowsMarker->Image))
                                            <a style="width: 100px;" id="imgHrefTag"
                                                href="{{ asset('/') . 'admin/allfiles/moments/' . $rowsMarker->Image }}"
                                               >
                                                <img style="width:100px"
                                                    src="{{ asset('/') . 'admin/allfiles/moments/thumbs/' . $rowsMarker->Image }}"
                                                    id="imageTag" /> </a>
                                        @endif
                                    @endif
                                </div>
                            </div>

                            <div class="control-group" id="videoHolder1">
                                <label class="control-label" for="selectError3">Media 1 Type</label>
                                <div class="controls">
                                    <select name="media1Type" id="media1Type" onchange="mediaTypeChanged(1)">
                                        <option value=""></option>
                                        <option value="0">Video</option>
                                        <option value="1">3D</option>
                                    </select>
                                    <span class="help-inline error" id="videoType1Error"></span>
                                </div>
                                <div id="media1VideoFieldsHolder" style="">
                                    <label class="control-label" for="selectError3">Media 1</label>
                                    <div class="controls">
                                        <input class="input-file uniform_on" id="video1_ios" name="video1_ios"
                                            type="file" onchange="displayVideoThumb(1, this)" accept="video/*">
                                        <input class="input-file uniform_on" id="video1_android"
                                            name="video1_android" type="hidden">
                                    </div>
                                    <div class="controls">
                                        <?php 
                                          if(strlen($rowsMarker->media1_ios) && $rowsMarker->media1_type == 0)
                                          {
                                        ?>
                                        <video width="320" controls id="videoTag1">
                                            <source
                                                src="https://api.arconnect.app/allfiles/moments/{{ $rowsMarker->media1_ios }}"
                                                id="videoSrcTag1" type="video/mp4">
                                        </video>
                                        <?php       
                                          }
                                        ?>
                                    </div>
                                    <label class="control-label" for="selectError3">HEX code</label>
                                    <div class="controls">
                                        <input class="input-file uniform_on offset6 span2" id="media1Chroma"
                                            name="media1Chroma" type="text" value=""> (Please note putting
                                        any
                                        proper HEX color code will remove the color from the video. So please be
                                        cautious)
                                    </div>
                                </div>
                                <div id="media13DFieldsHolder" style="display:none">
                                    <label class="control-label" for="selectError3">Media 1 iOS</label>
                                    <div class="controls">
                                        <input class="input-file uniform_on" id="media1_ios" name="media1_ios"
                                            type="file" onchange="" accept=".usdz">
                                    </div>
                                    <label class="control-label" for="selectError3">Media 1 Android</label>
                                    <div class="controls">
                                        <input class="input-file uniform_on" id="media1_android"
                                            name="media1_android" type="file" onchange="" accept=".glb">
                                    </div>
                                    <div>&nbsp;</div>
                                </div>
                            </div>

                            <div class="control-group" id="videoHolder2">
                                <label class="control-label" for="selectError3">Media 2 Type</label>
                                <div class="controls">
                                    <select name="media2Type" id="media2Type" onchange="mediaTypeChanged(2)">
                                        <option value=""></option>
                                        <option value="0">Video</option>
                                        <option value="1">3D</option>
                                    </select>
                                    <span class="help-inline error" id="videoType2Error"></span>
                                </div>
                                <div id="media2VideoFieldsHolder" style="">
                                    <label class="control-label" for="selectError3">Media 2</label>
                                    <div class="controls">
                                        <input class="input-file uniform_on" id="video2_ios" name="video2_ios"
                                            type="file" onchange="displayVideoThumb(2, this)" accept="video/*">
                                        <input class="input-file uniform_on" id="video2_android"
                                            name="video2_android" type="hidden">
                                    </div>
                                    <label class="control-label" for="selectError3">HEX code</label>
                                    <div class="controls">
                                        <input class="input-file uniform_on offset6 span2" id="media2Chroma"
                                            name="media2Chroma" type="text" value=""> (Please note putting
                                        any
                                        proper HEX color code will remove the color from the video. So please be
                                        cautious)
                                    </div>
                                </div>
                                <div id="media23DFieldsHolder" style="display:none">
                                    <label class="control-label" for="selectError3">Media 2 iOS</label>
                                    <div class="controls">
                                        <input class="input-file uniform_on" id="media2_ios" name="media2_ios"
                                            type="file" onchange="" accept=".usdz">
                                    </div>
                                    <label class="control-label" for="selectError3">Media 2 Android</label>
                                    <div class="controls">
                                        <input class="input-file uniform_on" id="media2_android"
                                            name="media2_android" type="file" onchange="" accept=".glb">
                                    </div>
                                    <div>&nbsp;</div>
                                </div>
                            </div>


                            <div class="control-group" id="videoHolder3">
                                <label class="control-label" for="selectError3">Media 3 Type</label>
                                <div class="controls">
                                    <select name="media3Type" id="media3Type" onchange="mediaTypeChanged(3)">
                                        <option value=""></option>
                                        <option value="0">Video</option>
                                        <option value="1">3D</option>
                                    </select>
                                    <span class="help-inline error" id="videoType3Error"></span>
                                </div>
                                <div id="media3VideoFieldsHolder" style="">
                                    <label class="control-label" for="selectError3">Media 3</label>
                                    <div class="controls">
                                        <input class="input-file uniform_on" id="video3_ios" name="video3_ios"
                                            type="file" onchange="displayVideoThumb(3, this)" accept="video/*">
                                        <input class="input-file uniform_on" id="video3_android"
                                            name="video3_android" type="hidden">
                                    </div>
                                    <label class="control-label" for="selectError3">HEX code</label>
                                    <div class="controls">
                                        <input class="input-file uniform_on offset6 span2" id="media3Chroma"
                                            name="media3Chroma" type="text" value=""> (Please note putting
                                        any
                                        proper HEX color code will remove the color from the video. So please be
                                        cautious)
                                    </div>
                                </div>
                                <div id="media33DFieldsHolder" style="display:none">
                                    <label class="control-label" for="selectError3">Media 3 iOS</label>
                                    <div class="controls">
                                        <input class="input-file uniform_on" id="media3_ios" name="media3_ios"
                                            type="file" onchange="" accept=".usdz">
                                    </div>
                                    <label class="control-label" for="selectError3">Media 3 Android</label>
                                    <div class="controls">
                                        <input class="input-file uniform_on" id="media3_android"
                                            name="media3_android" type="file" onchange="" accept=".glb">
                                    </div>
                                    <div>&nbsp;</div>
                                </div>
                            </div>

                            <div class="control-group" id="videoHolder4">
                                <label class="control-label" for="selectError3">Media 4 Type</label>
                                <div class="controls">
                                    <select name="media4Type" id="media4Type" onchange="mediaTypeChanged(4)">
                                        <option value=""></option>
                                        <option value="0">Video</option>
                                        <option value="1">3D</option>
                                    </select>
                                    <span class="help-inline error" id="videoType4Error"></span>
                                </div>
                                <div id="media4VideoFieldsHolder" style="">
                                    <label class="control-label" for="selectError3">Media 4</label>
                                    <div class="controls">
                                        <input class="input-file uniform_on" id="video4_ios" name="video4_ios"
                                            type="file" onchange="displayVideoThumb(4, this)" accept="video/*">
                                        <input class="input-file uniform_on" id="video4_android"
                                            name="video4_android" type="hidden">
                                    </div>
                                    <label class="control-label" for="selectError3">HEX code</label>
                                    <div class="controls">
                                        <input class="input-file uniform_on offset6 span2" id="media4Chroma"
                                            name="media4Chroma" type="text" value=""> (Please note putting
                                        any
                                        proper HEX color code will remove the color from the video. So please be
                                        cautious)
                                    </div>
                                </div>
                                <div id="media43DFieldsHolder" style="display:none">
                                    <label class="control-label" for="selectError3">Media 4 iOS</label>
                                    <div class="controls">
                                        <input class="input-file uniform_on" id="media4_ios" name="media4_ios"
                                            type="file" onchange="" accept=".usdz">
                                    </div>
                                    <label class="control-label" for="selectError3">Media 4 Android</label>
                                    <div class="controls">
                                        <input class="input-file uniform_on" id="media4_android"
                                            name="media4_android" type="file" onchange="" accept=".glb">
                                    </div>
                                    <div>&nbsp;</div>
                                </div>
                            </div>


                            <div class="control-group" id="videoHolder5">
                                <label class="control-label" for="selectError3">Media 5 Type</label>
                                <div class="controls">
                                    <select name="media5Type" id="media5Type" onchange="mediaTypeChanged(5)">
                                        <option value=""></option>
                                        <option value="0">Video</option>
                                        <option value="1">3D</option>
                                    </select>
                                    <span class="help-inline error" id="videoType5Error"></span>
                                </div>
                                <div id="media5VideoFieldsHolder" style="">
                                    <label class="control-label" for="selectError3">Media 5</label>
                                    <div class="controls">
                                        <input class="input-file uniform_on" id="video5_ios" name="video5_ios"
                                            type="file" onchange="displayVideoThumb(5, this)" accept="video/*">
                                        <input class="input-file uniform_on" id="video5_android"
                                            name="video5_android" type="hidden">
                                    </div>
                                    <label class="control-label" for="selectError3">HEX code</label>
                                    <div class="controls">
                                        <input class="input-file uniform_on offset6 span2" id="media5Chroma"
                                            name="media5Chroma" type="text" value=""> (Please note putting
                                        any
                                        proper HEX color code will remove the color from the video. So please be
                                        cautious)
                                    </div>
                                </div>
                                <div id="media53DFieldsHolder" style="display:none">
                                    <label class="control-label" for="selectError3">Media 5 iOS</label>
                                    <div class="controls">
                                        <input class="input-file uniform_on" id="media5_ios" name="media5_ios"
                                            type="file" onchange="" accept=".usdz">
                                    </div>
                                    <label class="control-label" for="selectError3">Media 5 Android</label>
                                    <div class="controls">
                                        <input class="input-file uniform_on" id="media5_android"
                                            name="media5_android" type="file" onchange="" accept=".glb">
                                    </div>
                                    <div>&nbsp;</div>
                                </div>
                            </div>

                            <div class="control-group" id="videoHolder6">
                                <label class="control-label" for="selectError3">Media 6 Type</label>
                                <div class="controls">
                                    <select name="media6Type" id="media6Type" onchange="mediaTypeChanged(6)">
                                        <option value=""></option>
                                        <option value="0">Video</option>
                                        <option value="1">3D</option>
                                    </select>
                                    <span class="help-inline error" id="videoType6Error"></span>
                                </div>
                                <div id="media6VideoFieldsHolder" style="">
                                    <label class="control-label" for="selectError3">Media 5</label>
                                    <div class="controls">
                                        <input class="input-file uniform_on" id="video6_ios" name="video6_ios"
                                            type="file" onchange="displayVideoThumb(6, this)" accept="video/*">
                                        <input class="input-file uniform_on" id="video6_android"
                                            name="video6_android" type="hidden">
                                    </div>
                                    <label class="control-label" for="selectError3">HEX code</label>
                                    <div class="controls">
                                        <input class="input-file uniform_on offset6 span2" id="media6Chroma"
                                            name="media6Chroma" type="text" value=""> (Please note putting
                                        any
                                        proper HEX color code will remove the color from the video. So please be
                                        cautious)
                                    </div>
                                </div>
                                <div id="media63DFieldsHolder" style="display:none">
                                    <label class="control-label" for="selectError3">Media 6 iOS</label>
                                    <div class="controls">
                                        <input class="input-file uniform_on" id="media6_ios" name="media6_ios"
                                            type="file" onchange="" accept=".usdz">
                                    </div>
                                    <label class="control-label" for="selectError3">Media 6 Android</label>
                                    <div class="controls">
                                        <input class="input-file uniform_on" id="media6_android"
                                            name="media6_android" type="file" onchange="" accept=".glb">
                                    </div>
                                    <div>&nbsp;</div>
                                </div>
                            </div>



                            <?php
                            if(0)
                            {
                            ?>

                            <div class="control-group">
                                <label class="control-label" for="selectError3">Winner Video</label>
                                <div class="controls">
                                    <input class="input-file uniform_on" id="winnerVideo" name="winnerVideo"
                                        type="file">
                                </div>
                                <div class="controls">
                                    <?php 
                                    if(strlen($rowsMarker->winnerVideo))
                                    {
                                    ?>
                                    <video width="320" controls id="winnerVideoTag">
                                        <source
                                            src="https://api.arconnect.app/allfiles/moments/{{ $rowsMarker->winnerVideo }}"
                                            id="winnerVideoSrcTag" type="video/mp4">
                                    </video>
                                    <?php       
                                    }
                                    else
                                    {
                                    ?>
                                    <video width="320" controls id="winnerVideoTag">
                                        <source src="" id="winnerVideoSrcTag" type="video/mp4">
                                    </video>
                                    <?php							
                                    }
                                  ?>
                                </div>
                                <div class="controls">
                                    <a class="btn btn-small btn-primary pull-right" href="javascript:void(0)"
                                        onclick="submitRotate(' {{ $rowsMarker->winnerVideo }} ')">Fix Video</a>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label" for="selectError3">Winner Visitors are</label>
                                <div class="controls">
                                    <input class="input-file uniform_on" id="winnerVisitors" name="winnerVisitors"
                                        value=" {{ $rowsMarker->winnerVisitors }} " type="text"> (th visitor)
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label" for="selectError3">Winner Message</label>
                                <div class="controls">
                                    <input class="input-file uniform_on" id="winnerMessage" name="winnerMessage"
                                        type="text" value="{{ $rowsMarker->winnerMessage }}"> (Optional)
                                </div>
                            </div>
                            <?php
                            }
                            ?>

                            <?php
                            $flagCount = -1;
                            if(1 || $flagCount > 0)
                            {
                                
                            ?>
                            <div class="control-group">
                                <div class="box">
                                    <h5 style="margin:5px;">Flag Details</h5>
                                    <!--<div class="controls">
                                                    <span class="label label-important">Flagged  by Users</span>
                                                </div>-->

                                    <h6 style="margin:5px;">Flagged By Users: <?php echo $flagCount > 0 ? '<span class="label label-important">Yes</span>' : '<span class="label label-success">No</span>'; ?></h6>

                                    <div class="control-group">
                                        <div class="controls">
                                            {{-- @foreach ($resultFlag as $rowsFlag)
                                                @php
                                                    if (strlen($rowsFlag->name)) {
                                                        $name = $rowsFlag->name;
                                                    } else {
                                                        $name = $rowsFlag->phone;
                                                    }

                                                    echo $name . '<br/>';
                                                @endphp
                                            @endforeach --}}
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label" for="selectError3">Flag It</label>
                                        <div class="controls">
                                            <label class="radio " style="margin-right:15px;">
                                                <input type="radio" name="flag" value="N"
                                                    {{ $moment->flag == 'N' ? "checked='checked'" : '' }}>
                                                Not Flagged by Admin
                                            </label>
                                            <label class="radio " style="margin-top:5px; margin-right:15px;">
                                                <input type="radio" name="flag" value="Y"
                                                    {{ $moment->flag == 'Y' ? "checked='checked'" : '' }}>
                                                Flagged By Admin
                                            </label>
                                            <span class="error" id="statusError"></span>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label" for="selectError3">Flag Reason</label>
                                        <div class="controls">
                                            <textarea type="text" name="reason" id="reason">  
                                                {{ $moment->flag == 'Y' ? $moment->reason : '' }} 
                                            </textarea>
                                            <span class="error" id="reasonError"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                            }
                            if(0)
                            {
                            ?>
                            <div class="control-group">
                                <h3 style="margin:5px;">Add Hunts</h3>
                                <div id="hunt_wrapper" class="box">
                                    <?php
                                    $rowidx = 0;
                                    // done this part
                                    // $resultMomentHunts = mysqli_query($conn, 'select * from tbl_moment_hunts WHERE moment_id=' . $momentId);
                                    // while($rowsMomentHunt = mysqli_fetch_array($resultMomentHunts)){
                                    ?>
                                    @foreach ($resultMomentHunts as $rowsMomentHunt)
                                        <div class="hunt-item">
                                            <div class="control-group">
                                                <label class="control-label" for="selectError3">Select Hunt</label>
                                                <div class="controls">
                                                    <select name="huntId[]" class="hunt-id">
                                                        <option value="">--Select Hunt--</option>
                                                        @foreach ($resultHunts as $rowsHunts)
                                                            <option value="{{ $rowsHunts->huntId }} "
                                                                {{ $rowsMomentHunt->huntId == $rowsHunts->huntId ? 'selected="selected"' : '' }}>
                                                                {{ $rowsHunts->huntName }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <span class="help-inline error"></span>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label" for="selectError3">Select Level</label>
                                                <div class="controls">
                                                    <select name="huntLevel[]" class="hunt-level"
                                                        onchange="huntLevelChanged(this)">
                                                        <option value="">--Select Level--</option>
                                                        <?php
                                                        for($level=1;$level<=10;$level++){
                                                        ?>
                                                        <option value="<?php echo $level; ?>"
                                                            {{ $rowsMomentHunt->huntLevel == $level ? 'selected="selected"' : '' }}>
                                                            <?php echo 'Level ' . $level; ?></option>
                                                        <?php 
                                                        }
                                                        ?>
                                                    </select>
                                                    <span class="help-inline error"></span>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label" for="selectError3">Hint for this
                                                    Moment</label>
                                                <div class="controls">
                                                    <input class="hunt-hint" name="huntHint[]" rows="3"
                                                        value="{{ $rowsMomentHunt->hint }}" />
                                                    <span class="help-inline error"></span>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label" for="selectError3">Message to be shown on
                                                    finding<br><span style="color:red; font-style:italic">Please note:
                                                        system
                                                        will fetch the hint of the next moment and display
                                                        automatically. So
                                                        no
                                                        need to add here</span></label>
                                                <div class="controls">
                                                    <textarea style="height:125px" class="hunt-found-msg" name="huntFoundMsg[]" rows="3">{{ $rowsMomentHunt->huntFoundMsg }}</textarea>
                                                    <span class="help-inline error"></span>
                                                </div>
                                            </div>

                                            <div class="control-group">
                                                <button class="btn btn-danger pull-right btn-remove" type="button"
                                                    onclick="remove_hunt_node(this)"
                                                    style="display: <?php echo $rowidx == 0 ? 'none' : ''; ?>">Remove</button>
                                                <button class="btn btn-primary pull-right btn-add" type="button"
                                                    onclick="add_hunt_node(this)" style="margin-right: 10px;">Add
                                                    More</button>
                                            </div>

                                            <input type="hidden" name="huntMomentid[]" class="huntMomentid"
                                                value="{{ $rowsMomentHunt->id }}" />

                                        </div>
                                        @php
                                            $rowidx++;
                                        @endphp
                                    @endforeach
                                    <?php 
                                    if($rowidx == 0)
                                    {
                                        //that is there are no rows - still show the Add button
                                        // $resultHunts = mysqli_query($conn, "select * from tbl_hunt");  
                                    ?>


                                    <div class="hunt-item">
                                        <div class="control-group">
                                            <label class="control-label" for="selectError3">Select Hunt</label>
                                            <div class="controls">
                                                <select name="huntId[]" class="hunt-id">
                                                    <option value="">--Select Hunt--</option>
                                                    @foreach ($resultHunts as $rowsHunts)
                                                        <?php
                                                        // while($rowsHunts = mysqli_fetch_array($resultHunts)){
                                                        ?>
                                                        <option value="{{ $rowsHunts->huntId }}">
                                                            {{ $rowsHunts->huntName }}</option>
                                                    @endforeach
                                                </select>
                                                <span class="help-inline error"></span>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" for="selectError3">Select Level</label>
                                            <div class="controls">
                                                <select name="huntLevel[]" class="hunt-level"
                                                    onchange="huntLevelChanged(this)">
                                                    <option value="">--Select Level--</option>
                                                    <?php
                                                    for($level=1;$level<=10;$level++){
                                                        ?>
                                                    <option value="<?php echo $level; ?>"><?php echo 'Level ' . $level; ?></option>
                                                    <?php 
                                                        }
                                                    ?>
                                                </select>
                                                <span class="help-inline error"></span>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label" for="selectError3">Hint for this
                                                Moment</label>
                                            <div class="controls">
                                                <input class="hunt-hint" name="huntHint[]" rows="3"
                                                    value="{{ $rowsMomentHunt->hint }} " />
                                                <span class="help-inline error"></span>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label" for="selectError3">Message to be shown on
                                                finding<br><span style="color:red; font-style:italic">Please note:
                                                    system
                                                    will fetch the hint of the next moment and display automatically. So
                                                    no
                                                    need to add here</span></label>
                                            <div class="controls">
                                                <textarea style="height:125px" class="hunt-found-msg" name="huntFoundMsg[]" rows="3"></textarea>
                                                <span class="help-inline error"></span>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <button class="btn btn-danger pull-right btn-remove" type="button"
                                                onclick="remove_hunt_node(this)" style="display: none">Remove</button>
                                            <button class="btn btn-primary pull-right btn-add" type="button"
                                                onclick="add_hunt_node(this)" style="margin-right: 10px;">Add
                                                More</button>
                                        </div>
                                    </div>

                                    <?php
                                        }
                                    ?>
                                </div>
                            </div>

                            <?php
                                }
                            ?>
                            <div class="control-group">
                                <label class="control-label" for="selectError3">Status (Ban/Unban)</label>
                                <div class="controls">
                                    <label class="radio " style="margin-right:15px;">
                                        <input type="radio" name="status" value="Y"
                                            {{ $moment->status == 'Y' ? "checked='checked'" : '' }}> Not Banned
                                    </label>
                                    <label class="radio " style="margin-top:5px; margin-right:15px;">
                                        <input type="radio" name="status" value="N"
                                            {{ $moment->status == 'N' ? "checked='checked'" : '' }}> Banned
                                    </label>
                                    <span class="error" id="statusError"></span>
                                </div>
                            </div>
                            {{-- <div class="control-group">
                                <label class="control-label" for="selectError3">Ban Reason</label>
                                <div class="controls">
                                    <textarea type="text" name="reason" id="reason"></textarea>
                                    <span class="error" id="reasonError"></span>
                                </div>
                            </div> --}}


                            <div class="form-actions" style="border:none; background:none;">
                                <button class="btn btn-primary" name="momentAddSubmit" type="submit">Add</button>
                                <button class="btn btn-primary" name="productEditCancel" type="button"
                                    onclick="javascript:window.location='<?php echo isset($_GET['redirectBack']) && strlen(_sanitize($_GET['redirectBack'])) ? _sanitize($_GET['redirectBack']) : 'moments.php'; ?>'">Cancel</button>
                                <input type="hidden" name="momentId" id="momentId"
                                    value="{{ $moment->momentid }}" />
                                <?php
                                // echo $rowsMoment['momentId'];
                                ?>
                            </div>
                        </fieldset>
                    </form>


                    {{-- starts --}}
                    {{-- my code --}}

                    <script>
                        ClassicEditor
                            .create(document.querySelector('#editor'))
                            .catch(error => {
                                console.error(error);
                            });
                    </script>
                    {{-- ends --}}

                    {{-- ends --}}





                    <script async
                        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC1EuEpS5we_QqZ674M3HrjYyZAq0k-vIs&libraries=geometry,places&callback=initMap">
                    </script>



                    {{-- <script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC1EuEpS5we_QqZ674M3HrjYyZAq0k-vIs&libraries=geometry,places&callback=initMap"></script> --}}


                    <script type="text/javascript">
                        function mediaTypeChanged(whichMedia) {

                            if (document.getElementById("media" + whichMedia + "Type").value == 0) {
                                document.getElementById("media" + whichMedia + "VideoFieldsHolder").style.display = "block";

                                document.getElementById("media" + whichMedia + "3DFieldsHolder").style.display = "none";
                                document.getElementById("media" + whichMedia + "_android").value = null;
                                document.getElementById("media" + whichMedia + "_ios").value = null;
                            } else
                            if (document.getElementById("media" + whichMedia + "Type").value == 1) {
                                document.getElementById("media" + whichMedia + "VideoFieldsHolder").style.display = "none";
                                document.getElementById("media" + whichMedia + "_android").value = null;
                                document.getElementById("media" + whichMedia + "_ios").value = null;
                                document.getElementById("media" + whichMedia + "Chroma").value = null;

                                if (document.getElementById("videoSrcTag" + whichMedia) != null)
                                    document.getElementById("videoSrcTag" + whichMedia).src = "";

                                document.getElementById("media" + whichMedia + "3DFieldsHolder").style.display = "block";
                            }
                        }


                        function submitRotate(videoId) {
                            document.getElementById("IdOfVideoToRotate").value = videoId;
                            $('#rotateConfirm').modal('show');
                        }


                        var attributes = new Array();
                        var xmlHTTPAttributes;

                        var attrbuteFieldsIndex = 0;
                        var len = i = 0;
                        var temp, temp2;

                        function addShareFields() {
                            var attributeTypeSelectBox;

                            var field = attributeTypeSelectBox = document.createElement("input");
                            field.setAttribute("name", "sharedPhoneEmail[" + attrbuteFieldsIndex + "]");
                            field.setAttribute("id", "sharedPhoneEmail" + attrbuteFieldsIndex);
                            field.setAttribute("type", "text");

                            var errorSpan = document.createElement("span");
                            errorSpan.setAttribute("class", "help-inline error");
                            errorSpan.setAttribute("id", "sharedPhoneEmailError" + attrbuteFieldsIndex);

                            var controlDiv = document.createElement("div");
                            controlDiv.setAttribute("class", "controls");

                            var controlGroupDiv = document.createElement("div");
                            controlGroupDiv.setAttribute("class", "control-group");

                            controlDiv.appendChild(field);
                            controlDiv.appendChild(errorSpan);

                            controlGroupDiv.appendChild(controlDiv);

                            document.getElementById("divSharedInputs").appendChild(controlGroupDiv);

                            attrbuteFieldsIndex++;
                        }

                        function getBase64Image(img) {
                            var canvas = document.createElement("canvas");
                            canvas.width = 100;
                            canvas.height = 100;

                            var ctx = canvas.getContext("2d");
                            ctx.drawImage(img, 0, 0);

                            var dataURL = canvas.toDataURL("image/jpg");

                            return dataURL.replace(/^data:image\/(png|jpg|jpeg);base64,/, "");
                        }


                        document.getElementById('Image').addEventListener('change', (e) => {
                            const file = e.target.files[0];
                            const reader = new FileReader();
                            reader.onloadend = () => {
                                // convert file to base64 String
                                const base64String = reader.result.replace('data:', '').replace(/^.+,/, '');
                                // store file
                                localStorage.setItem('Image', base64String);
                                // display image
                                document.getElementById("imageTag").src = `data:image/jpeg;base64,${base64String}`;
                            };
                            reader.readAsDataURL(file);
                        });

                        function displayVideoThumb(id, theObject) {
                            document.getElementById("videoSrcTag" + id).src = window.URL.createObjectURL(theObject.files[0]);
                            document.getElementById("videoTag" + id).load();
                        }


                        /*
                        document.getElementById('winnerVideo').addEventListener('change', (e) => {
                        	document.getElementById("winnerVideoSrcTag").src = window.URL.createObjectURL(e.target.files[0]);
                        	document.getElementById("winnerVideoTag").load(); 
                        });
                        */

                        $(document).ready(function() {

                        })

                        let map;

                        function initMap() {
                            map = new google.maps.Map(document.getElementById("mapbox"), {
                                center: {
                                    lat: <?php echo strlen($moment->latitude) > 0 ? $moment->latitude : '42.9635731'; ?>,
                                    lng: <?php echo strlen($moment->longitude) > 0 ? $moment->longitude : '-85.7068247'; ?>
                                },
                                zoom: 14,
                            });

                            const marker = new google.maps.Marker({
                                position: new google.maps.LatLng(<?php echo strlen($moment->latitude) > 0 ? $moment->latitude : '42.9635731'; ?>, <?php echo strlen($moment->longitude) > 0 ? $moment->longitude : '-85.7068247'; ?>),
                                map: map,
                            });
                            //marker.setPosition(<?php echo $moment->latitude; ?>, <?php echo $moment->latitude; ?>);

                            const input = document.getElementById("locationAutoComplete");
                            const options = {
                                fields: ["address_components", "geometry", "name"],
                                strictBounds: false,
                                types: ["establishment"],
                            };
                            const autocomplete = new google.maps.places.Autocomplete(input, options);


                            autocomplete.addListener("place_changed", () => {
                                marker.setVisible(false);
                                const place = autocomplete.getPlace();

                                if (!place.geometry || !place.geometry.location) {
                                    // User entered the name of a Place that was not suggested and
                                    // pressed the Enter key, or the Place Details request failed.
                                    window.alert("No details available for input: '" + place.name + "'");
                                    return;
                                }

                                // If the place has a geometry, then present it on a map.
                                if (place.geometry.viewport) {
                                    map.fitBounds(place.geometry.viewport);
                                } else {
                                    map.setCenter(place.geometry.location);
                                    map.setZoom(14); // Why 17? Because it looks good.
                                }
                                document.getElementById("latitude").value = place.geometry.location.lat();
                                document.getElementById("longitude").value = place.geometry.location.lng();
                                marker.setPosition(place.geometry.location);
                                marker.setVisible(true);
                                let address = "";

                                if (place.address_components) {
                                    address = [
                                        (place.address_components[0] &&
                                            place.address_components[0].short_name) ||
                                        "",
                                        (place.address_components[1] &&
                                            place.address_components[1].short_name) ||
                                        "",
                                        (place.address_components[2] &&
                                            place.address_components[2].short_name) ||
                                        "",
                                    ].join(" ");
                                }
                            });

                        }

                        function userIdChanged(selectBox) {
                            //change the businessId box to -1
                            document.getElementById("businessId").selectedIndex = "0";
                        }

                        var xmlHTTPbusinessNames

                        function businessIdChanged(selectBox) {
                            //if -1 then need not get details
                            if (selectBox.options[selectBox.selectedIndex].value == -1)
                                return false;


                            if (window.XMLHttpRequest)
                                xmlHTTPbusinessNames = new XMLHttpRequest();
                            else
                                xmlHTTPbusinessNames = new ActiveXObject("Microsoft.XMLHTTP");

                            //xmlHTTPbusinessNames.onreadystatechange = updateAttributeTypes;
                            //console.log(selectBox.options[selectBox.selectedIndex].value);

                            var params = "action=businessDetails&businessId=" + selectBox.options[selectBox.selectedIndex].value + "" +
                                "&rand=" + ajaxR + "&key=" + ajaxKey;
                            xmlHTTPbusinessNames.open("POST", "ajax-backend.php", false);
                            xmlHTTPbusinessNames.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                            xmlHTTPbusinessNames.setRequestHeader("Content-length", params.length);
                            //xmlhttp.setRequestHeader("Connection", "close");
                            xmlHTTPbusinessNames.send(params);

                            if (xmlHTTPbusinessNames.readyState == 4 && xmlHTTPbusinessNames.status == 200) {
                                var selecBox = document.getElementById("userId");

                                var i = 0;
                                businessDetails = $.parseJSON(xmlHTTPbusinessNames.responseText);
                                var businessIdCount = selecBox.options.length;
                                for (i = 0; i < businessIdCount; i++) {
                                    if (selecBox.options[i].value == businessDetails['businessUserId'])
                                        selecBox.selectedIndex = i;
                                }
                            }
                        }
                        var hunt_item = $("#hunt_wrapper").find('.hunt-item');

                        function validate_hunt_fields() {
                            let error = 0;
                            $('.hunt-item').each(function() {
                                let hunt_item_dom = $(this).closest('.hunt-item');

                                if ($(hunt_item_dom).find('.hunt-id').val() == '') {
                                    $(hunt_item_dom).find('.hunt-id').next('.error').text('Please choose hunt');
                                    error = 1;
                                } else {
                                    $(hunt_item_dom).find('.hunt-id').next('.error').text('');
                                }

                                if ($(hunt_item_dom).find('.hunt-level').val() == '') {
                                    $(hunt_item_dom).find('.hunt-level').next('.error').text('Please choose level');
                                    error = 1;
                                } else {
                                    $(hunt_item_dom).find('.hunt-level').next('.error').text('');
                                }

                                let attr = $(hunt_item_dom).find('.hunt-found-msg').attr('req-input');
                                if (typeof attr !== 'undefined' && attr !== false) {
                                    if ($(hunt_item_dom).find('.hunt-found-msg').val().trim().length == 0) {
                                        $(hunt_item_dom).find('.hunt-found-msg').closest('.controls').find('.error').text(
                                            'Please enter message');
                                        error = 1;
                                    } else {
                                        $(hunt_item_dom).find('.hunt-found-msg').closest('.controls').find('.error').text('');
                                    }
                                }
                                if ($(hunt_item_dom).find('.hunt-hint').val().trim().length == 0) {
                                    $(hunt_item_dom).find('.hunt-hint').closest('.controls').find('.error').text(
                                        'Please enter hint');
                                    error = 1;
                                } else {
                                    $(hunt_item_dom).find('.hunt-hint').closest('.controls').find('.error').text('');
                                }


                            });
                            if (error) {
                                return false;
                            } else {
                                return true;
                            }

                        }

                        function huntLevelChanged(e) {
                            if ($(e).val() == '1') {
                                $(e).closest('.hunt-item').find('.hunt-found-msg').attr('req-input', 'req-input');
                            } else {
                                $(e).closest('.hunt-item').find('.hunt-found-msg').removeAttr('req-input');
                            }
                        }

                        function add_hunt_node(e) {
                            let validate_fields = validate_hunt_fields();
                            if (validate_fields) {
                                let hunt_item_clone = $(hunt_item).clone();
                                $(hunt_item_clone).find('option:selected').removeAttr("selected");
                                $(hunt_item_clone).find('.hunt-level').val('');
                                $(hunt_item_clone).find('.hunt-found-msg').val('');
                                $(hunt_item_clone).find('.hunt-next-hint').val('');
                                $(hunt_item_clone).find('.huntMomentid').val('');

                                $(hunt_item_clone).find('.btn-remove').show();
                                $("#hunt_wrapper").append(hunt_item_clone);
                            }
                        }

                        function remove_hunt_node(e) {
                            //$(e).closest('.hunt-item').remove();
                            //console.log((e.parentNode.nextElementSibling.value));
                            $("#huntToRemove").val(e.parentNode.nextElementSibling.value);
                            $("#frmHuntToRemove").submit();
                        }
                    </script>

                    {{-- ends here --}}
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
