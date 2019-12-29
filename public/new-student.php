<?php ob_start(); ?>

<!-- HTML -->
<div class="flex-container form-container">
    <form name="formStudent" class="flex-container main-wrap">
        <input type="hidden" name="_id" value="<?=isset($_POST['studentid']) ? $_POST['studentid'] : ''?>"/>
        <div class="full-row">Name</div>
        <div class="full-row"><input class="textfield100" type="text" name="_name" /></div>

        <div class="full-row">E-mail</div>
        <div class="full-row"><input class="textfield100" type="text" name="_email" /></div>

        <div class="full-row">Birth Date</div>
        <div class="full-row"><input class="textfield100" type="text" name="_birth" /></div>

        <div class="half-row">Height</div>
        <div class="half-row">Weight</div>
        
        <div class="half-row"><input class="textfield50" type="text" name="_height" /></div>
        <div class="half-row"><input class="textfield50" type="text" name="_weight" /></div>

        <div class="full-row">Profile</div>
        <div class="full-row">
            <select class="textfield100" name="_profile">
            </select>
        </div>

        <div class="full-row">Active Training</div>
        <div class="full-row">
            <select class="textfield100" name="_activetraining">
                <option value="">Select a training</option>
            </select>
        </div>

        <div class="flex-container full-row flex-right">
            <button name="_btnSave" class="btn btn-save">Save</button>
        </div>
    </form>
</div>
<script type="module" src="./resources/js/page-new-student.js"></script>
<!-- HTML -->

<?php $content = ob_get_contents(); ?>
<?php ob_end_clean(); ?>
<?php include './layout.php'; ?>