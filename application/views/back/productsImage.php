<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div id="page-content">
    <div class="block full">
        <div class="block-title">
            <div class="block-options pull-right">
                <a href="javascript:void(0)" class="btn btn-alt btn-sm btn-default" data-toggle="tooltip" title="Settings"><i class="gi gi-cogwheel"></i></a>
            </div>
            <h2><strong>Resim Yükle</strong></h2>
        </div>
        <form action="<?php echo site_url();?>admin/AddProductImage/<?php echo $ProductId; ?>" class="dropzone"></form>
    </div>
    <div class="block full">
        <div class="block-title">
           <div><h2><strong>Resimler</strong></h2></div>
        </div>
        <div class="gallery gallery-widget" data-toggle="lightbox-gallery">
            <div class="row">
                <?php
                if(count($ImageList) == 0){ ?>
                    <div class="alert alert-danger text-center"> Henüz Resim Yüklenmedi Yukarıdan Yükleyebilirsiniz. </div>
                    <?php
                }
                foreach ($ImageList as $row){
                ?>
                <div class="col-xs-10 col-sm-4">
                    <div class="col-xs-12 col-sm-12" style="margin-bottom: 30px; border:solid; border-color: #0b0b0b; border-width: 1px;">
                        <a href="<?php echo base_url();?>admin/ImageMain/<?php echo $row->Id; ?>" title="Image Info">
                            <img src="<?php echo base_url();?>posters/orj/<?php echo $row->Image; ?>" alt="image">
                        </a>
                    </div>
                    <div class="col-xs-6 col-sm-6 d-flex justify-content-center">
                    <button href="javascript:void(0)" onclick="showDeleteModal('<?php echo $row->Id; ?>','<?php echo site_url(); ?>admin/DeleteProductImage/<?php echo $row->ProductId; ?>/<?php echo $row->Id; ?>');"
                            class="btn btn-primary btn-sm btn btn-danger" title="Delete Admin">Delete</button>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>