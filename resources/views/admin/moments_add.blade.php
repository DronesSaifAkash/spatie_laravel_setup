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

                    <form class="form-horizontal  offset6 span8" action="{{route('moment_adding')}}" method="post" enctype="multipart/form-data" ><!--onsubmit="return validate_hunt_fields()">-->
                        @csrf
                        <fieldset>
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
                                        <option value="{{ $key }}"><?php echo $value; ?></option>
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


                            <div class="control-group">
                                <label class="control-label" for="selectError3">Name/Title</label>
                                <div class="controls">
                                    <input type="text" name="heading" id="heading" class="input-xlarge focused"
                                        value="" required />
                                    <span class="help-inline error" id="headingError"></span>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label" for="selectError3">Description</label>
                                <div class="controls">
                                    {{-- <textarea class="cleditor" id="description" name="description" rows="3"></textarea><span class="help-inline error" id="descriptionError"></span> --}}
                                </div>
                                <div>
                                    <textarea class="cleditor" id="editor" name="description" rows="3"></textarea>
                                    {{-- <p></p> --}}
                                </div>

                            </div>

                            <div class="control-group">
                                <div class="box">
                                    <h5 style="margin:5px;">Allow Comments</h5>
                                    <div class="control-group">
                                        <div class="controls">
                                            <label class="radio " style="margin-right:15px;">
                                                <input type="radio" name="comment" id="commentY" value="Y"> Yes
                                            </label>
                                            <label class="radio " style="margin-top:5px; margin-right:15px;">
                                                <input type="radio" name="comment" id="commentN" value="N"> No
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
                                                <input type="radio" name="ispublic" id="ispublicY" value="Y"> Yes
                                            </label>
                                            <label class="radio " style="margin-top:5px; margin-right:15px;">
                                                <input type="radio" name="ispublic" id="ispublicN" value="N"> No
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
                                    <input class="btn btn-primary pull-right" type="button" value="Add More Share Fields"
                                        onclick="addShareFields()">
                                    <div class="control-group">
                                        <div class="controls">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <?php 
						}
						?>
                            <div class="control-group">
                                <div class="box">
                                    <h5 style="margin:5px;">URL</h5>
                                    <div class="control-group">
                                        <div class="controls">
                                            <input class="" id="promourl" name="promourl" type="url"
                                                value="">
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
                                            <input class="" id="publishDate" name="publishDate" type="date"
                                                value="">
                                            <span class="help-inline error" id="publishDateError"></span>
                                            <input class="" id="publishTime" name="publishTime" type="time"
                                                value="">
                                            <span class="help-inline error" id="publishTimeError"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="control-group">
                                <div class="box">
                                    <h5 style="margin:5px;">Expire Date and Time</h5>
                                    <div class="control-group">
                                        <div class="controls">
                                            <input class="" id="expireDate" name="expireDate" type="date"
                                                value="">
                                            <span class="help-inline error" id="expireDateError"></span>
                                            <input class="" id="expireTime" name="expireTime" type="time"
                                                value="">
                                            <span class="help-inline error" id="expireTimeError"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="control-group">
                                <div class="box">
                                    <h5 style="margin:5px;">Location</h5>
                                    <input type="text" name="locationAutoComplete" id="locationAutoComplete">
                                    <input type="text" name="latitude" id="latitude" value="">
                                    <input type="text" name="longitude" id="longitude" value="">
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
                                    <a style="width: 100px;" id="imgHrefTag" href="#"><img style="width:100px"
                                            src="" id="imageTag" /> </a>
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
                                        <input class="input-file uniform_on" id="video1_android" name="video1_android"
                                            type="hidden">
                                    </div>
                                    <label class="control-label" for="selectError3">HEX code</label>
                                    <div class="controls">
                                        <input class="input-file uniform_on offset6 span2" id="media1Chroma"
                                            name="media1Chroma" type="text" value=""> (Please note putting any
                                        proper HEX color code will remove the color from the video. So please be cautious)
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
                                        <input class="input-file uniform_on" id="media1_android" name="media1_android"
                                            type="file" onchange="" accept=".glb">
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
                                        <input class="input-file uniform_on" id="video2_android" name="video2_android"
                                            type="hidden">
                                    </div>
                                    <label class="control-label" for="selectError3">HEX code</label>
                                    <div class="controls">
                                        <input class="input-file uniform_on offset6 span2" id="media2Chroma"
                                            name="media2Chroma" type="text" value=""> (Please note putting any
                                        proper HEX color code will remove the color from the video. So please be cautious)
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
                                        <input class="input-file uniform_on" id="media2_android" name="media2_android"
                                            type="file" onchange="" accept=".glb">
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
                                        <input class="input-file uniform_on" id="video3_android" name="video3_android"
                                            type="hidden">
                                    </div>
                                    <label class="control-label" for="selectError3">HEX code</label>
                                    <div class="controls">
                                        <input class="input-file uniform_on offset6 span2" id="media3Chroma"
                                            name="media3Chroma" type="text" value=""> (Please note putting any
                                        proper HEX color code will remove the color from the video. So please be cautious)
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
                                        <input class="input-file uniform_on" id="media3_android" name="media3_android"
                                            type="file" onchange="" accept=".glb">
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
                                        <input class="input-file uniform_on" id="video4_android" name="video4_android"
                                            type="hidden">
                                    </div>
                                    <label class="control-label" for="selectError3">HEX code</label>
                                    <div class="controls">
                                        <input class="input-file uniform_on offset6 span2" id="media4Chroma"
                                            name="media4Chroma" type="text" value=""> (Please note putting any
                                        proper HEX color code will remove the color from the video. So please be cautious)
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
                                        <input class="input-file uniform_on" id="media4_android" name="media4_android"
                                            type="file" onchange="" accept=".glb">
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
                                        <input class="input-file uniform_on" id="video5_android" name="video5_android"
                                            type="hidden">
                                    </div>
                                    <label class="control-label" for="selectError3">HEX code</label>
                                    <div class="controls">
                                        <input class="input-file uniform_on offset6 span2" id="media5Chroma"
                                            name="media5Chroma" type="text" value=""> (Please note putting any
                                        proper HEX color code will remove the color from the video. So please be cautious)
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
                                        <input class="input-file uniform_on" id="media5_android" name="media5_android"
                                            type="file" onchange="" accept=".glb">
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
                                        <input class="input-file uniform_on" id="video6_android" name="video6_android"
                                            type="hidden">
                                    </div>
                                    <label class="control-label" for="selectError3">HEX code</label>
                                    <div class="controls">
                                        <input class="input-file uniform_on offset6 span2" id="media6Chroma"
                                            name="media6Chroma" type="text" value=""> (Please note putting any
                                        proper HEX color code will remove the color from the video. So please be cautious)
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
                                        <input class="input-file uniform_on" id="media6_android" name="media6_android"
                                            type="file" onchange="" accept=".glb">
                                    </div>
                                    <div>&nbsp;</div>
                                </div>
                            </div>



                            <?php
						if(0)
						{
							?>

                            <div class="control-group" id="winnerVideoHolder">
                                <label class="control-label" for="selectError3">Winner Video</label>
                                <div class="controls">
                                    <input class="input-file uniform_on" id="winnerVideo" name="winnerVideo"
                                        type="file">
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label" for="selectError3">Winner Visitors are</label>
                                <div class="controls">
                                    <input class="input-file uniform_on" id="winnerVisitors" name="winnerVisitors"
                                        type="text"> (th visitor)
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label" for="selectError3">Winner Message</label>
                                <div class="controls">
                                    <input class="input-file uniform_on" id="winnerMessage" name="winnerMessage"
                                        type="text"> (Optional)
                                </div>
                            </div>

                            <div class="control-group">
                                <h3 style="margin:5px;">Add Hunts</h3>

                                <div id="hunt_wrapper" class="box">
                                    <div class="hunt-item">
                                        <div class="control-group">
                                            <label class="control-label" for="selectError3">Select Hunt</label>
                                            <div class="controls">
                                                <select name="huntId[]" class="hunt-id">
                                                    <option value="">--Select Hunt--</option>
                                                    @foreach ($resultHunts as $rowsHunts)
                                                        <option value="{{ $rowsHunts->huntId }} ">
                                                            {{ $rowsHunts->huntName }}
                                                        </option>
                                                    @endforeach
                                                    <?php
												    // while($rowsHunts = mysqli_fetch_array($resultHunts)){ 
													?>
                                                    {{-- <option value="<?php echo $rowsHunts['huntId']; ?>"><?php echo $rowsHunts['huntName']; ?></option> --}}
                                                    <?php 
												    // }
												    ?>
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
                                            <label class="control-label" for="selectError3">Hint for this Moment</label>
                                            <div class="controls">
                                                <input class="hunt-hint" name="huntHint[]" rows="3" />
                                                <span class="help-inline error"></span>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label" for="selectError3">Message to be shown on
                                                finding<br><span style="color:red; font-style:italic">Please note: system
                                                    will fetch the hint of the next moment and display automatically. So no
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
                                </div>
                            </div>
                            <?php
						}
						
						?>
                            <!--<div class="control-group">
                                <label class="control-label" for="selectError3">Status (Ban/Unban)</label>
                                <div class="controls">
                                    <label class="radio " style="margin-right:15px;">
                                    <input type="radio" name="status" value="Y" checked='checked'> Not Banned
                                    </label>
                                    <label class="radio " style="margin-top:5px; margin-right:15px;">
                                    <input type="radio" name="status" value="N" > Banned
                                    </label>
                                    <span class="error" id="statusError"></span>
                                </div>
                                </div>
                                <div class="control-group">
                                <label class="control-label" for="selectError3">Ban Reason</label>
                                <div class="controls">
                                <textarea type="text" name="reason" id="reason"></textarea>
                                <span class="error" id="reasonError"></span>
                                </div>
                                </div>-->


                            <div class="form-actions" style="border:none; background:none;">
                                <button class="btn btn-primary" name="momentAddSubmit" type="submit">Add</button>
                                <button class="btn btn-primary" name="productEditCancel" type="button"
                                    onclick="javascript:window.location='<?php echo isset($_GET['redirectBack']) && strlen(_sanitize($_GET['redirectBack'])) ? _sanitize($_GET['redirectBack']) : 'moments.php'; ?>'">Cancel</button>
                                <input type="hidden" name="momentId" id="momentId" value="" />
                                <?php
                                // echo $rowsMoment['momentId'];
                                ?>
                            </div>
                        </fieldset>
                    </form>



                    {{-- my code --}}

                    <script>
                        ClassicEditor
                            .create(document.querySelector('#editor'))
                            .catch(error => {
                                console.error(error);
                            });
                    </script>
                    {{-- ends --}}





                    <script async
                        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC1EuEpS5we_QqZ674M3HrjYyZAq0k-vIs&libraries=geometry,places&callback=initMap">
                    </script>


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

                            var dataURL = canvas.toDataURL("image/jpeg");

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

                        /*
                        document.getElementById('video').addEventListener('change', (e) => {
                        	if(document.getElementById("videoTag") == null)
                        	{
                        		var videoTag = document.createElement("video");
                        		videoTag.setAttribute("class","controls videoThumb");
                        		videoTag.setAttribute("id","videoTag");
                        		videoTag.setAttribute("width","320");
                        		videoTag.setAttribute("controls","");
                        		
                        		var videoSrc = document.createElement("source");
                        		videoSrc.setAttribute("src","");
                        		videoSrc.setAttribute("id","videoSrcTag");
                        		videoSrc.setAttribute("type","video/mp4");
                        		
                        		videoTag.appendChild(videoSrc);
                        		document.getElementById('videoHolder').appendChild(videoTag);
                        	}
                        	
                        	document.getElementById("videoSrcTag").src = window.URL.createObjectURL(e.target.files[0]);
                        	document.getElementById("videoTag").load(); 
                        });
                        */

                        function displayVideoThumb(id, theObject) {
                            if (document.getElementById("videoTag" + id) == null) {
                                var videoTag = document.createElement("video");
                                videoTag.setAttribute("class", "controls videoThumb");
                                videoTag.setAttribute("id", "videoTag" + id);
                                videoTag.setAttribute("width", "320");
                                videoTag.setAttribute("controls", "");

                                var videoSrc = document.createElement("source");
                                videoSrc.setAttribute("src", "");
                                videoSrc.setAttribute("id", "videoSrcTag" + id);
                                videoSrc.setAttribute("type", "video/mp4");

                                videoTag.appendChild(videoSrc);
                                document.getElementById('videoHolder' + id).appendChild(videoTag);
                            }

                            document.getElementById("videoSrcTag" + id).src = window.URL.createObjectURL(theObject.files[0]);
                            document.getElementById("videoTag" + id).load();
                        }

                        /*
                        document.getElementById('winnerVideo').addEventListener('change', (e) => {
                        	if(document.getElementById("winnerVideoTag") == null)
                        	{
                        		var videoTag = document.createElement("video");
                        		videoTag.setAttribute("class","controls winnerVideoThumb");
                        		videoTag.setAttribute("id","winnerVideoTag");
                        		videoTag.setAttribute("width","320");
                        		videoTag.setAttribute("controls","");
                        		
                        		var videoSrc = document.createElement("source");
                        		videoSrc.setAttribute("src","");
                        		videoSrc.setAttribute("id","winnerVideoSrcTag");
                        		videoSrc.setAttribute("type","video/mp4");
                        		
                        		videoTag.appendChild(videoSrc);
                        		document.getElementById('winnerVideoHolder').appendChild(videoTag);
                        	}
                        	
                        	document.getElementById("winnerVideoSrcTag").src = window.URL.createObjectURL(e.target.files[0]);
                        	document.getElementById("winnerVideoTag").load(); 
                        });

                        */

                        var browserLat = 0;
                        var browserLong = 0;

                        function getLocation() {
                            if (navigator.geolocation) {
                                navigator.geolocation.getCurrentPosition(showPosition);
                            } else {

                            }
                        }

                        function showPosition(position) {
                            //x.innerHTML = "Latitude: " + position.coords.latitude + "<br>Longitude: " + position.coords.longitude;
                            browserLat = position.coords.latitude;
                            browserLong = position.coords.longitude;
                            console.log(browserLong);
                            initMap();
                        }

                        let map;

                        function initMap() {
                            map = new google.maps.Map(document.getElementById("mapbox"), {
                                center: {
                                    lat: 42.9635731,
                                    lng: -85.7068247
                                },
                                zoom: 14,
                            });

                            const marker = new google.maps.Marker({
                                position: new google.maps.LatLng(42.9635731, -85.7068247),
                                map: map,
                            });

                            const input = document.getElementById("locationAutoComplete");
                            const options = {
                                fields: ["geometry", "name"],
                                strictBounds: false,
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

                        $(document).ready(function() {
                            if (browserLat == 0 && browserLong == 0)
                                getLocation();
                        })
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
                                $(hunt_item_clone).find('.hunt-found-msg').val('');
                                $(hunt_item_clone).find('.hunt-next-hint').val('');
                                $(hunt_item_clone).find('.btn-remove').show();
                                $("#hunt_wrapper").append(hunt_item_clone);
                            }
                        }

                        function remove_hunt_node(e) {
                            $(e).closest('.hunt-item').remove();
                        }
                    </script>

                    {{-- ends here --}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>