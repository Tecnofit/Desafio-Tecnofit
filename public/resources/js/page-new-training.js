import training from './lib/training.js'
import exercise from './lib/exercise.js'
import student from './lib/student.js'
import modal from './lib/modal/modal.js'

const id = document.formTraining._id
const name = document.formTraining._name
const level = document.formTraining._level
const desc = document.formTraining._desc
const sessions = document.formTraining._sessions
const resting = document.formTraining._resting
const sugestedFor = document.formTraining._sugested_for
const checksElems = document.getElementsByClassName('check-exercises')
const btnSave = document.formTraining._btnSave
btnSave.addEventListener('click', async e => {
    e.preventDefault()
    
    const exercises = Object.keys(checksElems).reduce((arr, i) => {
        if (checksElems[i].checked) {
            const idExercise = checksElems[i].dataset.exercise
            const series = document.getElementsByName('_serie_' + idExercise)[0].value
            const repetitions = document.getElementsByName('_repetition_' + idExercise)[0].value
            arr.push({
                exercise: idExercise,
                series,
                repetitions
            })
        }
        return arr
    }, [])

    const persist = {
        id: id.value,
        name: name.value,
        level: level.value,
        desc: desc.value,
        sessions: sessions.value,
        resting: resting.value,
        sugestedFor: sugestedFor.value,
        exercises
    }

    const response = await training.saveTraining(persist)
    modal.setTitle('Training')
        .setContent(response.msg)
        .render([modal._btnOk])
})

const init = async () => {
    const trainingsLvlJson = await training.getAllLevels()
    const exercisesListJson = await exercise.getAllExercises()
    const studentProfilesJson = await student.getAllProfiles()

    trainingsLvlJson.map(level => {
        document.formTraining._level.innerHTML += "<option value='"+level.id+"'>"+level.level_desc+"</option>"
    })

    studentProfilesJson.map(profile => {
        document.formTraining._sugested_for.innerHTML += "<option value='"+profile.id+"'>"+profile.profile_desc+"</option>"
    })

    createExercisesList(exercisesListJson)
    
    if (id.value !== '') {
        let trainingData = await training.getTrainingById(id.value)

        fill(trainingData[0])
    }
}

const createExercisesList = async exercises => {
    const exercisesSelectionElem = document.querySelector('.exercises-selection')

    if (id.value !== '') {
        exercisesSelectionElem.innerHTML += "<h5>You can't change the exercises of the training</h5>"
        return
    }

    exercises.map(exercise => {
        exercisesSelectionElem.innerHTML += "<div class='flex-container exercise'>"
            + "<div class='half-row'><input data-exercise='" + exercise.id + "' type='checkbox' name='_check[]' class='check-exercises' value='" + exercise.id + "' /></div>"
            + "    <div class='half-row'>" + exercise.exercise_name + "</div>"
            + "    <div class='half-row'><input class='textfield50' type='text' id='_serie_" + exercise.id + "' name='_serie_" + exercise.id + "' placeholder='Series' /></div>"
            + "    <div class='half-row'><input class='textfield100' type='text' id='_repetition_" + exercise.id + "' name='_repetition_" + exercise.id + "' placeholder='Repetition' /></div>"
            + "</div>"
    })
}

const fill = training => {
    name.value = training.training_name
    level.value = training.fk_level
    desc.value = training.training_desc
    sessions.value = training.session_quantity
    resting.value = training.resting_interval
    sugestedFor.value = training.fk_profile_sugestion

    const activeExercises = _getIdsExercises(training.exercises)
    Object.keys(checksElems).map(i => {
        if (activeExercises.includes(checksElems[i].dataset.exercise)) {
            checksElems[i].checked = true
            document.getElementById('_serie_' + checksElems[i].dataset.exercise).value = 13
            document.getElementById('_repetition_' + checksElems[i].dataset.exercise).value = 15
        }
    })

    
}

const _getIdsExercises = exercises => {
    return exercises.reduce((arr, elem) => {
        arr.push(elem.fk_exercise)
        return arr
    }, [])
}

init()