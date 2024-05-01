<x-app-layout>
    <div class="row">
        <div class="box col-md-12">
            <div class="box-inner">
                <div class="box-header well" data-original-title="">
                    {{-- <h2><i class="glyphicon glyphicon-picture"></i> Dashboard</h2> --}}
                    <h2><i class="glyphicon glyphicon-list"></i> Update Marker Score </h2>
                </div>
                <div class="box-content">
                    <br>
                    {{-- starts here --}}

                    <div class="box-content">
                        <form class="form-horizontal  offset6 span8" action="" method="post"
                            onsubmit="return validateProductCat()">
                            <fieldset>
                                <div class="form-actions" style="border:none; background:none;">
                                    <button class="btn btn-primary" name="momentScoreUpdateSubmit1"
                                        onclick="deleteConfirm()" type="button">Update</button>
                                    <button class="btn btn-primary" name="momentScoreUpdateCancelsubmit" type="button"
                                        onclick="javascript:window.location='<?php echo isset($_GET['redirectBack']) && strlen(_sanitize($_GET['redirectBack'])) ? _sanitize($_GET['redirectBack']) : 'moment-categories.php'; ?>'">Cancel</button>
                                </div>
                            </fieldset>
                        </form>

                    </div>



                    {{-- ends here --}}
                </div>
            </div>
            <div class="modal" id="deleteConfirm">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">x</button>
                            <h3>Update Moment Score </h3>
                        </div>
                        <div class="modal-body">
                            <p style="color: red;">Are you sure you want to udpate moment scores?</p>
                            <p style="color: black;">This may take a while. Thanks for understanding.</p>
                        </div>
                        <div class="modal-body">
                            <form action="{{route('admin.moment_score_updater_fun')}}" method="post" id="deleteConfirmForm">
                                @csrf 
                                <fieldset>
                                    <div class="control-group">
                                        <div class="controls">
                                            <input type="submit" style="display: none;" name="momentScoreUpdateSubmit"
                                                id="momentScoreUpdateSubmit" />
                                        </div>
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <a href="#" class="btn" data-dismiss="modal">Cancel</a>
                            <a href="#" class="btn btn-primary"
                                onclick="javascript:document.getElementById('momentScoreUpdateSubmit').click()">Update</a>
                        </div>
                    </div>
                </div>
            </div>

            <script type="text/javascript">
                function deleteConfirm(attributeId, attributeName) {
                    $('#deleteConfirm').modal('show');
                }
            </script>
</x-app-layout>