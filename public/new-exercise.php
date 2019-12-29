<?php ob_start(); ?>

<!-- HTML -->
<div class="flex-container form-container">
    <form name="formExercise" class="flex-container main-wrap">
        <input type="hidden" name="_id" value="<?=isset($_POST['exerciseid']) ? $_POST['exerciseid'] : ''?>"/>
        <div class="full-row">Exercise Name</div>
        <div class="full-row"><input class="textfield100" type="text" name="_name" /></div>

        <div class="full-row">Exercise Description</div>
        <div class="full-row"><textarea rows="5" class="textfield100" type="text" name="_desc"></textarea></div>
        
        <div class="flex-container full-row flex-right">
            <button name="_btnSave" class="btn btn-save">Save</button>
        </div>
    </form>
</div>
<script type="module" src="./resources/js/page-new-exercise.js"></script>

<!-- HTML -->

<?php $content = ob_get_contents(); ?>
<?php ob_end_clean(); ?>
<?php include './layout.php'; ?>