<?php if (session()->has('success_review')): ?>
<div class="alert alert-success" role="alert">
    <?php
        echo session()->get('success_review');
    session()->forget('success_review');
    ?>
</div>
<?php endif; ?>
