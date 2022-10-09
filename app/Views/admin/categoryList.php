<div class="right_box">
<a href="<?= base_url('admin/category') ;?>"><button class="btn btn-info mb-4">add Category</button></a> 
<table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>S/L</th>
                <th>Category Name</th>
               <th>Created at</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($allCategories as $key => $value):?>
            <tr>
                <td><?= ++$key ;?></td>
                <td><?= $value['cat_name'];?></td>
               <!--  <td> <img src="<?= base_url()?>/uploads/<?= $value['image'];?>" alt=""></td> -->
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

<?php $this->endSection(); ?>