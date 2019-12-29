import exercise from './lib/exercise.js'
import modal from './lib/modal/modal.js'

let exercises = undefined

const init = async () => {
    exercises = await exercise.getAllExercises()
    createExercisesList(exercises)
    _bindEvents()
}

const createExercisesList = filteredList => {
    const listElem = document.querySelector('.exercises-list')
    let exercisesList = exercises
    
    listElem.innerHTML = ''
    
    if (filteredList !== undefined) {
        exercisesList = filteredList
    }

    if (exercises.length === 0) {
        listElem.innerHTML += "<div class='flex-container card-list'>There's no exercise registered</div><a href='/'>HOME</a>"
        return
    }

    exercisesList.map(exercise => {
        listElem.innerHTML += "<div class='flex-container card-list'>"
            + "    <h4>" + exercise.exercise_name + "</h4>"
            + "    <div class='full-row'>"
            + "        <p class='full-row'>Description: " + exercise.exercise_desc + "</p>"
            + "        <p class='full-row'>Create: " + exercise.created_at + "</p>"
            + "    </div>"
            + "    <div class='flex-container actions'>"
            + "        <form action='new-exercise.php' name='formEditExercise' method='post' class='form-edit-exercise'>"
            + "            <img data-exerciseid='" + exercise.id + "' class='clickable update-exercise' src='resources/images/pencil.png' alt='Edit'>"
            + "            <input type='hidden' name='exerciseid' value='" + exercise.id + "'>"
            + "        </form>"
            + "        <img data-exerciseid='" + exercise.id + "' class='clickable delete-exercise' src='resources/images/trash.png' alt='Delete'>"
            + "    </div>"
            + "</div>"
    })
}

const _bindEvents = () => {
    const deleteExerciseElem = document.getElementsByClassName('delete-exercise')
    const updateExerciseElem = document.getElementsByClassName('update-exercise')
    const filterElem = document.querySelector('.filter')

    Object.keys(deleteExerciseElem).map(i => {
        deleteExerciseElem[i].addEventListener('click', e => {
            modal.setTitle('Exercise')
                .setContent("Do you really want to delete this exercise?")
                .render([modal._btnCancel, modal._btnConfirm])

            modal.setCallbackConfirmButton(async () => {
                const response = await exercise.deleteExercise(e.target.dataset.exerciseid)
                modal.setTitle('Exercise')
                    .setContent(response.msg)
                    .render([modal._btnOk])
            })
        })
    })

    Object.keys(updateExerciseElem).map(i => {
        updateExerciseElem[i].addEventListener('click', e => {
            document.getElementsByClassName('form-edit-exercise')[i].submit()
        })
    })

    filterElem.addEventListener('keydown', e => {
        if (e.keyCode === 13) {
            const term = e.target.value
            _filter(term)
        }
    })
}

const _filter = term => {
    const filteredList = exercises.filter((exercise, idx) => exercise.exercise_name.toLowerCase().indexOf(term.toLowerCase()) !== -1)

    createExercisesList(filteredList)
    _bindEvents()
}

init()