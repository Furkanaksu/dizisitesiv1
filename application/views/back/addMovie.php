<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div id="page-content">
    <div class="row" >
        <div class="col-md-12">
            <div class="block">
                <div class="block-title">
                    <h2><strong>Movies</strong></h2>
                </div>
                <form action="<?php echo base_url(); ?>admin/AddMovie" method="post" class="form-horizontal form-bordered" id="form-validation" >
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
                        <label class="col-md-3 control-label">Name:</label>
                        <div class="col-md-3">
                            <input type="text" id="Name" name="Name" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Category:</label>
                        <div class="col-md-3">
                            <input type="text" id="Category" name="Category" class="form-control"  />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Category2:</label>
                        <div class="col-md-3">
                            <input type="text" id="Category2" name="Category2" class="form-control"  />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Score:</label>
                        <div class="col-md-3">
                            <input type="text" id="Score" name="Score" class="form-control"  />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Date:</label>
                        <div class="col-md-3">
                            <input type="text" id="Date" name="Date" class="form-control input-datepicker" value="<?php echo date('Y-m-d h:i:s'); ?>" data-date-format="yyyy-mm-dd 00:00:00" placeholder="yyyy-mm-dd">
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

