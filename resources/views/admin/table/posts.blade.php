

<h3>Create post</h3>
<form action="/admin/create" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-3 row">
        <label for="staticTitle" class="col-sm-2 col-form-label">Title</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="staticTitle" name="title">
        </div>
    </div>
    <div class="mb-3">
        <label for="formFile" class="form-label">Download your image</label>
        <input class="form-control" type="file" id="formFile" name="image">
    </div>
    <div class="mb-3">
        <label for="exampleFormControlTextarea1" class="form-label">About what</label>
        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="content"></textarea>
    </div>
    <button class="button_create" onclick="function ()">Create</button>
</form>

<h3 style="margin-top: 50px">Not Published</h3>

<div class="content">
    <table class="tablee_n_pub">
        <thead>
        <tr>
            <th scope="col">Title</th>
            <th scope="col" style="padding-left: 20px">Content</th>
            <th scope="col">Status</th>
            <th scope="col" style="padding-left: 20px">Create Date</th>
            <th scope="col"></th>
            <th scope="col"></th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        <?php  foreach ($posts_0 as $post): ?>
        <tr>
            <th scope="row"><?php echo $post->title ?></th>
            <td><textarea><?php echo $post->content ?></textarea></td>
            <td  style="width: 50px"><?php echo $post->status ?></td>
            <td><?php echo $post->date_create ?></td>
            <td><button class="button_publish" value="<?php echo $post->id ?>">Publish</button></td>
            <td><button class="button_delete" value="<?php echo $post->id ?>" id="button_delete" onclick="function ()">Delete</button></td>
        </tr>
        <?php endforeach;?>

        </tbody>
    </table>



    <h3 style="margin-top: 50px">Published</h3>
    <table class="tablee_pub">
        <thead>
        <tr>
            <th scope="col">Title</th>
            <th scope="col" style="padding-left: 20px">Content</th>
            <th scope="col">Status</th>
            <th scope="col" style="padding-left: 20px">Create Date</th>
            <th scope="col"></th>
            <th scope="col"></th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        <?php  foreach ($posts_1 as $post): ?>
        <tr>
            <th scope="row"><?php echo $post->title ?></th>
            <td><textarea><?php echo $post->content ?></textarea></td>
            <td  style="width: 50px"><?php echo $post->status ?></td>
            <td><?php echo $post->date_create ?></td>
            <td><button class="button_delete" value="<?php echo $post->id ?>" id="button_delete" onclick="function ()">Delete</button></td>
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

    .button_create{
        width: 60px;
        height: 30px;
        border-radius: 3px;
        border-color: lawngreen;
        background-color: lawngreen;
    }
</style>

<script>
    $(document).ready(function(){
        $('.button_create').click(function(){
                let create = 1;
                //post the field with ajaxHelper
                $.ajax({
                    type: 'GET',
                    url: '/admin/create',
                    dataType: 'text',
                    data: {create},
                    success: function(response){
                        $('.session_result').html(response);
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

