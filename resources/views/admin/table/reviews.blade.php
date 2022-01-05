
<h3 style="margin-top: 50px">Not Published</h3>
<h5>editing is possible only one by one: from top to bottom</h5>

<div class="content">
    <table class="tablee_n_pub">
        <thead>
        <tr>
            <th scope="col">Username</th>
            <th scope="col" style="padding-left: 20px">Email</th>
            <th scope="col">Content</th>
            <th scope="col" style="padding-left: 20px">Status</th>
            <th scope="col">Date Create</th>
            <th scope="col"></th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        <?php  foreach ($reviews_0 as $review): ?>
        <tr>
            <th scope="row"><?php echo $review->username ?></th>
            <td><?php echo $review->email ?></td>
            <td><textarea class="content_review"><?php echo $review->content ?></textarea></td>
            <td  style="width: 50px"><?php echo $review->status ?></td>
            <td><?php echo $review->date_create ?></td>
            <td><button class="button_publish" value="<?php echo $review->id ?>">Publish</button></td>
            <td><button class="button_save" value="<?php echo $review->id ?>">Save</button></td>
            <td><button class="button_delete" value="<?php echo $review->id ?>" id="button_delete" onclick="function ()">Delete</button></td>
        </tr>
        <?php endforeach;?>

        </tbody>
    </table>



    <h3 style="margin-top: 50px">Published</h3>
    <table class="tablee_pub">
        <thead>
        <tr>
            <th scope="col">Username</th>
            <th scope="col" style="padding-left: 20px">Email</th>
            <th scope="col">Content</th>
            <th scope="col" style="padding-left: 20px">Status</th>
            <th scope="col">Date Create</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        <?php  foreach ($reviews_1 as $review): ?>
        <tr>
            <th scope="row"><?php echo $review->username ?></th>
            <td><?php echo $review->email ?></td>
            <td><textarea><?php echo $review->content ?></textarea></td>
            <td  style="width: 50px"><?php echo $review->status ?></td>
            <td><?php echo $review->date_create ?></td>
            <td><button class="button_delete" value="<?php echo $review->id ?>" id="button_delete" onclick="function ()">Delete</button></td>
        </tr>
        <?php endforeach;?>

        </tbody>
    </table>
</div>
<style>
    tbody {
        font-size: 80%;
    }
    .tablee_n_pub {
        width: 50%;
        margin: 0 auto;
    }
    .tablee_pub {
        width: 100%;
        margin: 0 auto;
    }
    td {
        border: 1px solid green;
        padding: 3px;
        text-align:center;
    }

    .button_delete {
        width: 60px;
        height: 30px;
        border-radius: 3px;
        border-color: red;
        background-color: red;
    }

    .button_save{
        width: 60px;
        height: 30px;
        border-radius: 3px;
        border-color: lawngreen;
        background-color: lawngreen;
    }
</style>

<script>
    $(document).ready(function(){
        $('.button_save').click(function(){
                let id = $(this).val();
                let content = $('.content_review').val();
                //post the field with ajaxHelper
                $.ajax({
                    type: 'GET',
                    url: '/admin/save',
                    dataType: 'text',
                    data: {id, content},
                    success: function(response){
                        $('.content').html(response);
                    }
                });
            }
        )});

</script>

<script>
    $(document).ready(function(){
        $('.button_publish').click(function(){
                let id = $(this).val();
                //post the field with ajaxHelper
                $.ajax({
                    type: 'GET',
                    url: '/admin/publish',
                    dataType: 'text',
                    data: {id},
                    success: function(response){
                        $('.content').html(response);
                    }
                });
            }
        )});

</script>
<script>
    $(document).ready(function(){
        $('.button_delete').click(function(){
                let id = $(this).val();
                //post the field with ajaxHelper
                $.ajax({
                    type: 'GET',
                    url: '/admin/delete',
                    dataType: 'text',
                    data: {id},
                    success: function(response){
                        $('.content').html(response);
                    }
                });
            }
        )});

</script>


