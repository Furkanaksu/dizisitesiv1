<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div id="page-content">
    <div class="block">
        <!-- Table Styles Title -->
        <div class="block-title">
            <h2><strong>Admins</strong></h2>
        </div>
        <div class="table-options clearfix">
            <div class="btn-group btn-group-sm pull-right">
                <a href="<?php echo base_url(); ?>admin/AddAdmin" class="btn btn-primary" data-toggle="tooltip" title="Add New Admin">Add</i></a>
            </div>
        </div>
        <?php
        if($this->session->flashdata('Message') != null)
        {
            ?>
            <div class="row">
                <div class="col-xs-12">
                    <div class="alert alert-<?php echo $this->session->flashdata('MessageType'); ?>"><?php echo $this->session->flashdata('Message'); ?></div>
                </div>
            </div>
            <?php
        }
        ?>
        <div class="table-responsive">
            <table id="general-table" bordered class="table table-striped table-vcenter table-bordered">
                <thead>
                <tr>
                    <th class="text-center">Id</th>
                    <th class="text-center">Name</th>
                    <th class="text-center">Date</th>
                    <th class="text-center">Category1</th>
                    <th class="text-center">Category2</th>
                    <th class="text-center">Score</th>
                    <th class="text-center">Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach ($Products as $row){
                    ?>
                    <tr>
                        <!--<td class="text-center"><img src="<?php echo base_url(); ?>
                    assets/admin/img/placeholders/avatars/avatar16.jpg" alt="avatar" class="img-circle"></td>-->
                        <th class="text-center"><?php echo $row->Id; ?></th>
                        <td class="text-center"><?php echo $row->Name; ?></td>
                        <td class="text-center"><?php echo $row->Date; ?></td>
                        <td class="text-center"><?php echo $row->Category; ?> </td>
                        <td class="text-center"><?php echo $row->Category2; ?> </td>
                        <td class="text-center"><?php echo $row->Score; ?></td>
                        <td class="text-center">
                            <a href="<?php echo base_url(); ?>Admin/UpdateAdmin/<?php echo $row->Id; ?>" class="btn btn-primary btn-sm btn btn-warning" title="Update Admin">Update</a>
                            <a href="javascript:void(0)" onclick="showDeleteModal('<?php echo $row->Id; ?>','<?php echo base_url(); ?>admin/DeleteAdmin/<?php echo $row->Id; ?>');" class="btn btn-primary btn-sm btn btn-danger" title="Delete Admin">Delete</a>
                        </td>
                    </tr>
                <?php } ?></tbody>
            </table>
        </div>
        <!-- END Table Styles Content -->
    </div>
</div>

