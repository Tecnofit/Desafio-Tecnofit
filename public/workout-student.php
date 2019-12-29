<?php ob_start(); ?>

<!-- HTML -->

<form name="formWorkoutStudent" class="flex-container main-wrap">
    <input type="hidden" name="studentid" value="<?=isset($_POST['studentid']) ? $_POST['studentid'] : ''?>">
    <h3 class='training-name'></h3>
    <p class='full-row'>Session: <span class='session-n'></span></p>
    <input type="hidden" name="_session_n" >
    <div class='flex-container list'></div>
    
    <div class="flex-container full-row flex-right">
        <button name="_btnSave" class="conclude-training btn" disabled>Save</button>
    </div>
</form>
<script type="module" src="./resources/js/page-workout-student.js"></script>

<!-- HTML -->

<?php $content = ob_get_contents(); ?>
<?php ob_end_clean(); ?>
<?php include './layout.php'; ?>