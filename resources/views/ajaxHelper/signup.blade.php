<?php if (session()->has('success_create_user')): ?>
<div class="alert alert-success" role="alert">
    <?php
    echo session()->get('success_create_user');
    session()->forget('success_create_user');
    ?>
    <a href="/">Go to Main Page</a>
</div>
<?php endif; ?>

<?php if (session()->has('error_create_user')): ?>
<div class="alert alert-danger" role="alert">
    <?php
    foreach (session()->get('error_create_user') as $error) {
        echo $error[0] . '<br>';
    }
    session()->forget('error_create_user');

    ?>
</div>
<?php endif; ?>

<?php if (session()->has('error_add_user')): ?>
<div class="alert alert-danger" role="alert">
    <?php
    echo session()->get('error_add_user');
    session()->forget('error_add_user');
    ?>
</div>
<?php endif; ?>



