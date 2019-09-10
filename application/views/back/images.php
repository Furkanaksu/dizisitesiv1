<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div id="page-content">
    <div class="block full">
        <div class="block-title">
            <h2><strong>Images</strong></h2>
        </div>
        <div class="table-responsive">
            <table id="general-datatable" class="table table-striped table-vcenter table-bordered">
                <thead>
                <tr>
                    <th class="text-center">Id</th>
                    <th class="text-center">Name</th>
                    <th class="text-center">Category</th>
                    <th class="text-center">Category2</th>
                    <th class="text-center">Score</th>
                    <th class="text-center">Date</th>
                    <th class="text-center">Buttons</th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach ($Products as $row){
                    ?>
                    <tr>
                        <td class="text-center"><?php echo $row->Id; ?></td>
                        <td class="text-center"><?php echo $row->Name; ?></td>
                        <td class="text-center"><?php echo $row->Category; ?></td>
                        <td class="text-center"><?php echo $row->Category2; ?></td>
                        <td class="text-center"><?php echo $row->Score; ?></td>
                        <td class="text-center"><?php echo $row->Date; ?></td>
                        <td class="text-center">
                            <a href="<?php echo site_url(); ?>admin/ProductsImage/<?php echo $row->Id; ?>" class="btn btn-primary btn-sm btn btn-warning" title="Update Admin">Resim Ekle</a>
                        </td>

                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-md-12" style="text-align: center;">
        <?php if($TotalPage > 1) { ?>
            <div class="pagination">
                <a class="pagination__prev" href="<?php echo base_url(); ?><?php echo ''; ?>" title="Previous Page">&laquo;</a>
                <ol>
                    <?php for($i = 1; $i<=$TotalPage; $i++) { ?>
                        <?php $selectedClass = ''; if($CurrentPage == $i ){ $selectedClass = 'class="pagination__current"';} ?>
                        <li <?php echo $selectedClass; ?>>
                            <a href="<?php echo base_url(); ?>admin/Products/<?php echo $i; ?>"><?php echo $i; ?></a>
                        </li>
                    <?php } ?>
                </ol>
                <a class="pagination__next" href="<?php echo base_url(); ?><?php echo $i; ?>">&raquo;</a>
            </div>
        <?php } ?>
    </div>
</div>

