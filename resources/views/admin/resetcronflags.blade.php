<x-app-layout>
    <div class="row">
        <div class="box col-md-12">
            <div class="box-inner">
                <div class="box-header well" data-original-title="">
                    {{-- <h2><i class="glyphicon glyphicon-picture"></i> Dashboard</h2> --}}
                    <h2><i class="glyphicon glyphicon-file"></i> Reset Cron Flags </h2>

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
                    <p style="color: black;">Useful for cases where auto notifications has stopped</p>
                    <form class="form-horizontal  offset6 span8" action="" method="post"
                        onsubmit="return validateProductCat()">
                        <fieldset>
                            <div class="form-actions" style="border:none; background:none;">
                                <button class="btn btn-primary" name="momentScoreUpdateSubmit1" onclick="deleteConfirm()"
                                    type="button">Reset</button>
                                <button class="btn btn-primary" name="momentScoreUpdateCancelsubmit" type="button"
                                    onclick="javascript:window.location='<?php echo isset($_GET['redirectBack']) && strlen(_sanitize($_GET['redirectBack'])) ? _sanitize($_GET['redirectBack']) : 'moment-categories.php'; ?>'">Cancel</button>
                            </div>
                        </fieldset>
                    </form>

                    <div class="modal" tabindex="-1" role="dialog" id="deleteConfirm">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">x</button>
                                        <h3>Reset Cron Flags</h3>
                                    </div>
                                    <div class="modal-body">
                                        <p style="color: red;">Are you sure you want to reset the cron flags?</p>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{route('resetCron')}}" method="post" id="deleteConfirmForm">
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
                                            onclick="javascript:document.getElementById('momentScoreUpdateSubmit').click()">Reset</a>
                                    </div>
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