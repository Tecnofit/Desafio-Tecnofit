<?php ob_start(); ?>

<!-- HTML -->

<div class="flex-container main-wrap">
    <div data-card="new-exercise" class="flex-container card">
        <div class="flex-container title-card card-exercises">Exercises</div>
        <div class="flex-container small-card" data-view="new-exercise">
            NEW
        </div>
        <div class="flex-container small-card" data-view="list-exercises">
            LIST
        </div>
    </div>

    <div class="flex-container card">
        <div class="flex-container title-card card-trainings">Trainings</div>
        <div class="flex-container small-card" data-view="new-training">
            NEW
        </div>
        <div class="flex-container small-card" data-view="list-trainings">
            LIST
        </div>
    </div>

    <div data-card="new-student" class="flex-container card">
        <div class="flex-container title-card card-students">Students</div>
        <div class="flex-container small-card" data-view="new-student">
            NEW
        </div>
        <div class="flex-container small-card" data-view="list-students">
            LIST
        </div>
    </div>
</div>

<script>
    const cards = document.getElementsByClassName('small-card')
    for (let i = 0; i < cards.length; i++) {
        cards[i].addEventListener('click',  e => {
            window.location.href = cards[i].dataset.view + '.php'
        })
    }
</script>

<!-- HTML -->

<?php $content = ob_get_contents(); ?>
<?php ob_end_clean(); ?>
<?php include './layout.php'; ?>