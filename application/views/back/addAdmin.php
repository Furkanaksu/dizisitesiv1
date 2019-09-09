<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div id="page-content">
    <div class="row" >
        <div class="col-md-12">
            <div class="block">
                <div class="block-title">
                    <h2><strong>Admins</strong></h2>
                </div>
                <form action="<?php echo base_url(); ?>admin/AddAdmin" method="post" class="form-horizontal form-bordered" id="form-validation" >
                    <?php
                    if($this->session->flashdata('Message') != null)
                    {
                        ?>
                        <div class="form-group">
                            <div class="col-xs-12">
                                <div class="alert alert-<?php echo $this->session->flashdata('MessageType'); ?>"><?php echo $this->session->flashdata('Message'); ?></div>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Email:</label>
                        <div class="col-md-3">
                            <input type="email" id="Email" name="Email" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Password:</label>
                        <div class="col-md-3">
                            <input type="password" id="Password" name="Password" class="form-control"  />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Name:</label>
                        <div class="col-md-3">
                            <input type="text" id="Name" name="Name" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Surname:</label>
                        <div class="col-md-3">
                            <input type="text" id="Surname" name="Surname" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Date:</label>
                        <div class="col-md-3">
                            <input type="text" id="AddedDate" name="AddedDate" class="form-control input-datepicker" value="<?php echo date('Y-m-d h:i:s'); ?>" data-date-format="yyyy-mm-dd 00:00:00" placeholder="yyyy-mm-dd">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="Status">Status:</label>
                        <div class="col-md-3">
                            <select id="Status"  name="Status" class="form-control" size="1">
                                <option value="0">Blocked</option>
                                <option value="1">Active</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group form-actions">
                        <div class="col-md-11 text-center">
                            <input type="submit" value="Add" class="btn btn-md btn-primary" />
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

