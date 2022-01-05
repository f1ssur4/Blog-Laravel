<?php if (session()->has('error_create_post')): ?>
<div class="alert alert-danger" role="alert">
    <?php
    foreach (session()->get('error_create_post') as $error) {
        echo $error[0] . '<br>';
    }
    session()->forget('error_create_post');
    ?>
</div>
<?php endif; ?>
<a href="/admin"><h3>back</h3></a>
