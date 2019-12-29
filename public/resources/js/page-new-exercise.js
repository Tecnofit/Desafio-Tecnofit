import exercise from './lib/exercise.js'
import modal from './lib/modal/modal.js'

const id = document.formExercise._id
const name = document.formExercise._name
const desc = document.formExercise._desc
const btnSave = document.formExercise._btnSave

const init = async () => {
    if (id.value != '') {
        const exerciseData = await exercise.getExerciseById(id.value)
        fill(exerciseData[0])
    }
}

btnSave.addEventListener('click',  async e => {
    e.preventDefault()

    const response = await exercise.saveExercise({
        id: id.value,
        name: name.value,
        desc: desc.value
    })

    modal.setTitle('Exercise')
        .setContent(response.msg)
        .render([modal._btnOk])
})

const fill = exercise => {
    id.value = exercise.id
    name.value = exercise.exercise_name
    desc.value = exercise.exercise_desc
}

init()