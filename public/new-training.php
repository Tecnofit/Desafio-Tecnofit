<?php ob_start(); ?>

<!-- HTML -->

<div class="flex-container form-container">
    <form name="formTraining" class="flex-container main-wrap">
        <input type="hidden" name="_id" value="<?=isset($_POST['trainingid']) ? $_POST['trainingid'] : ''?>"/>
        <div class="full-row">Training Name</div>
        <div class="full-row"><input class="textfield100" type="text" name="_name" /></div>

        <div class="full-row">Training Level</div>
        <div class="full-row">
            <select class="textfield100" name="_level">
            </select>
        </div>

        <div class="full-row">Training Description</div>
        <div class="full-row"><textarea rows="5" class="textfield100" type="text" name="_desc"></textarea></div>
        
        <div class="half-row">Session quantity</div>
        <div class="half-row">Resting interval</div>
        <div class="half-row"><input class="textfield50" type="text" name="_sessions" /></div>
        <div class="half-row"><input class="textfield50" type="text" name="_resting" placeholder="00:20" /></div>

        <section class="full-row flex-container exercises-selection">
        </section>

        <div class="full-row">Sugested for</div>
        <div class="full-row">
            <select class="textfield100" name="_sugested_for">
            </select>
        </div>
        
        <div class="flex-container full-row flex-right">
            <button name="_btnSave" class="btn btn-save">Save</button>
        </div>
    </form>
</div>
<script type="module" src="./resources/js/page-new-training.js"></script>

<!-- HTML -->

<?php $content = ob_get_contents(); ?>
<?php ob_end_clean(); ?>
<?php include './layout.php'; ?>