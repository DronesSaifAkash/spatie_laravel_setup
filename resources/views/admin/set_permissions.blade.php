<x-app-layout>
    <div class="row">
        <div class="box col-md-12">
            <div class="box-inner">
                <div class="box-header well" data-original-title="">
                    {{-- <h2><i class="glyphicon glyphicon-picture"></i> Dashboard</h2> --}}
                    <h2><i class="glyphicon glyphicon-file"></i> Manage Group Permissions Any changes here can ruin the Admin
                        Panel.
                    </h2>

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
                    <form action="{{route('admin.update_permissions')}}" method="post">
                        @csrf 
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th></th>
                                @if (isset($totalGroups))
                                    @foreach ($totalGroups as $rowsGroups)
                                        <th width="{{ $columnWidth }}%"> <?php echo ucfirst($rowsGroups->group_name); ?></th>
                                    @endforeach
                                @else
                                    <th width="100%">&nbsp;</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($totalGroups))
                                @if ($totalObjects > 0)
                                    @foreach ($result as $rows)
                                        @php
                                            $allowedGroups = explode(',', $rows->allowed_groups);
                                        @endphp
                                        <tr <?php echo $rows->object_page == 'set-permissions.php' ? "style='background-color: #FFDFE8 !important'" : ''; ?>>
                                            <td width="200px"><?php echo ucfirst($rows->object_name); ?></td>
                                            <?php
                                                $resultGroups = getAllUserGroups();
                                            ?>
                                            @foreach($resultGroups as $rowsGroups )
                                            <td width="200px">
                                                <input type="checkbox" id="obj<?php echo $rows->id; ?>_grp<?php echo $rowsGroups->id; ?>"
                                                    name="obj<?php echo $rows->id; ?>_grp<?php echo $rowsGroups->id; ?>" <?php echo in_array($rowsGroups->id, $allowedGroups) ? "checked='checked'" : ''; ?>
                                                    <?php echo $rows->object_page == 'set-permissions.php' && $rowsGroups->id == 1 ? "readonly='readonly'" : ''; ?> />
                                            </td>
                                            @endforeach
                                        </tr>      
                                    @endforeach
                                @else
                                <tr>
                                    <td>
                                        <h5>No Objects or Pages Found</h5>
                                    </td>
                                </tr>
                                @endif
                            @else
                            <tr>
                                <td>
                                    <h5>No Groups Found</h5>
                                </td>
                            </tr>
                            @endif
                            <tr>
                                <td style="text-align: center;" colspan="<?php echo count($totalGroups) + 1; ?>">
                                    <input type="submit" name="btnPermissionsSubmit" value="Save" class="btn btn-primary" />
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    </form>

                    {{-- ends here --}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>