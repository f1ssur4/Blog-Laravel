<?php foreach($posts as $post): ?>
<?php $id = $post->id; ?>
<div class="card" style="width: 18rem; margin-top: 30px; border: #781919; border-radius: 100px">
    <img src=/storage/myImage/<?php echo $post->image ?> class="card-img-top" style="width: 150px; height: 70px">
    <div class="card-body" style="width: 500px">
        <h3 class="card-title"><a href="/post/{{$id}}"><?php echo $post->title?></a></h3>
        <p class="card-text" style=" width: 300px; height: 100px; overflow: hidden; text-overflow: ellipsis;"><?php echo $post->content?><a href="/post/{{$id}}" class="mybutton" style="color: #058edc;">detailed...</a></p>
        <div><h6 class="counter">viewed: <?php echo $post->count_views?></h6></div></td>
        <div><h6 class="counter">publication date: <?php echo $post->date_create?></h6></div></td>
    </div>
        <hr style="width: 500px">
<?php endforeach;?>
{{$posts->links()}}

