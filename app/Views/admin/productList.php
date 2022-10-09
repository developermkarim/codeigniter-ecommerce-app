<div class="right_box">
<a href="<?= base_url('admin/product') ;?>"><button class="btn btn-info mb-4">add Product</button></a> 
<table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>S/L</th>
                <th>Product Name</th>
                <th> Description</th>
                <th> Price</th>
                <th> Quantity</th>
                <th>Feature</th>
                <th>Created at</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($allProducts as $key => $value):?>
            <tr>
                <td><?= ++$key ;?></td>
                <td><?= $value['product_name'];?></td>
                <td><?= strlen($value['product_desc']) > 50 ? substr($value['product_desc'],0,50) . "..." : $value['product_desc'] ;?></td>
                <td><?= $value['selling_price'];?></td>
                <td><?= $value['qty'];?></td>
                <td> <img src="<?= base_url()?>/uploads/<?= $value['image'];?>" width="50" height="50" alt=""></td>
                <td><?php $time = strtotime($value['created_at']); echo date('Y-m-d H:i:s A',$time)?></td>
            </tr>
            
            <?php endforeach;?>
           
        </tbody>
       
    </table>
</div>



<?php
$this->section('script')?>
<script>
    $(document).ready(function () {
    $('#example').DataTable();
});
</script>
<?php $this->endSection();?>
