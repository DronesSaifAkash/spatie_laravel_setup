<x-app-layout>
    <div class="row">
        <div class="box col-md-12">
            <div class="box-inner">
                <div class="box-header well" data-original-title="">
                    {{-- <h2><i class="glyphicon glyphicon-picture"></i> Dashboard</h2> --}}
                    <h2><i class="glyphicon glyphicon-list"></i> Recreate Image Thumbs </h2>

                    {{-- <div class="box-icon">
                         <a href="#" class="btn btn-setting btn-round btn-default"><i
                                class="glyphicon glyphicon-cog"></i></a>
                        <a href="#" class="btn btn-minimize btn-round btn-default"><i
                                class="glyphicon glyphicon-chevron-up"></i></a>
                        <a href="#" class="btn btn-close btn-round btn-default"><i
                                class="glyphicon glyphicon-remove"></i></a>
                    </div> --}}
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

                    <div class="modal " id="deleteConfirm">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">x</button>
                                    <h3>Recreate Moment Thumbs </h3>
                                </div>
                                <div class="modal-body">
                                    <p style="color: red;">Are you sure you want to recreate moment thumbs?</p>
                                    <p style="color: black;">This may take a while. Thanks for understanding.</p>
                                </div>
                                <div class="modal-body">
                                    <form action="{{route('admin.recreatethumbs_updater')}}" method="post" id="deleteConfirmForm">
                                        @csrf 
                                        <fieldset>
                                            <div class="control-group">
                                                <div class="controls">
                                                    <input type="submit" style="display: none;"
                                                        name="momentScoreUpdateSubmit" id="momentScoreUpdateSubmit" />
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
                    {{-- ends here --}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>