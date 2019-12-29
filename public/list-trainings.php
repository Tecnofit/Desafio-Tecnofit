<?php ob_start(); ?>

<!-- HTML -->

<div class="flex-container main-wrap">
    <div class='full-row'>
        <label>Filter</label>
    </div>
    <div class='full-row'>
        <input class='filter textfield100' type='text' name='_filter'>
    </div>
</div>
<div class="flex-container main-wrap training-list">
</div>

<script type="module" src="./resources/js/page-list-trainings.js"></script>

<!-- HTML -->

<?php $content = ob_get_contents(); ?>
<?php ob_end_clean(); ?>
<?php include './layout.php'; ?>