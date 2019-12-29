import student from './lib/student.js'
import training from './lib/training.js'
import exercise from './lib/exercise.js'
import modal from './lib/modal/modal.js'

let arrExercisesCompleted = []
// Quantidade de exercícios que existem no treino, para completar o treino
// é necessário Pular ou Finalizar todos os exercícios do treino
let countExercises = 0
// Número de sessões do treino, quando todas as sessões forem realizadas o treino
// será desvinculado do usuário e será necessário ativar um outro treino para o mesmo
let totalSessions = 0
const idStudent = document.formWorkoutStudent.studentid.value
// Elemento DOM que irá exibir o nome do treino
const trainingName = document.querySelector('.training-name')
// Elemento DOM com todos os exercícios
const list = document.querySelector('.list')
const currentSession = document.querySelector('.session-n')

const init = async () => {
    const studentTraining = (await training.getTrainingByStudent(idStudent))[0]
    trainingName.innerText = 'None active training'
    if (studentTraining !== undefined) {
        const exercisesTraining = await exercise.getExercisesByTraining(studentTraining.id)
        const studentWorkout = await student.getStudentTraining(idStudent, studentTraining.id)
        const trainingData = await training.getTrainingById(studentTraining.id)
    
        totalSessions = trainingData[0].session_quantity
        countExercises = exercisesTraining.length
        currentSession.innerText = (studentWorkout[0].fk_student !== null ? (parseInt(studentWorkout[0].session_number) + 1) : 1)
            + '/' + totalSessions

        trainingName.innerText = studentTraining.training_name

        buildExercisesList(exercisesTraining, studentTraining.id)
        initBinds()
    }
}

const buildExercisesList = (exercises, idTraining) => {
    exercises.map(exercise => {
        list.innerHTML +=  ""
            + "<div class='flex-container card-list'>"
            + "    <h4>" + exercise.exercise_name + "</h4>"
            + "    <div class='full-row'>"
            + "        <p class='full-row'>Description: " + exercise.exercise_desc + "</p>"
            + "        <p class='full-row'>Series: " + exercise.series + "x</p>"
            + "        <p class='full-row'>Repetitions: " + exercise.repetition + "</p>"
            + "    <div class='flex-container actions'>"
            + "        <img class='icon-workout icon-checked-" + exercise.exercise_training + "' alt='checked' src='resources/images/checked.png'>"
            + "        <img class='icon-workout icon-skip-" + exercise.exercise_training + "' alt='checked' src='resources/images/skip.png'>"

            + "            <button data-exercise='" + exercise.exercise_training + "' class='btn-half btn-skip btn-skip-" + exercise.exercise_training + "'>Skip</button>"
            + "            <button data-exercise='" + exercise.exercise_training + "' class='btn-half btn-save btn-finish btn-finish-" + exercise.exercise_training + "'>Finished</button>"
            + "            <input type='hidden' class   ='_idtraining_" + exercise.exercise_training + "' value='" + idTraining + "'>"


            + "    </div>"
            + "    </div>"
            + "</div>"
    })
}

const initBinds = () => {
    const btnsSkip = document.getElementsByClassName('btn-skip')
    const btnsFinish = document.getElementsByClassName('btn-finish')
    const btnConclude = document.querySelector('.conclude-training')

    Object.keys(btnsSkip).map(i => {
        btnsSkip[i].addEventListener('click', e => {
            e.preventDefault()
            const exerciseId = e.target.dataset.exercise
            doExercise(exerciseId, false)

            e.target.style.display = 'none'
            document.querySelector('.btn-finish-' + exerciseId).style.display = 'none'
            document.querySelector('.btn-skip-' + exerciseId).style.display = 'none'
            document.querySelector('.icon-skip-' + exerciseId).style.display = 'block'
        })
    })

    Object.keys(btnsFinish).map(i => {
        btnsFinish[i].addEventListener('click', e => {
            e.preventDefault()
            const exerciseId = e.target.dataset.exercise
            doExercise(exerciseId, true)

            document.querySelector('.btn-finish-' + exerciseId).style.display = 'none'
            document.querySelector('.btn-skip-' + exerciseId).style.display = 'none'
            document.querySelector('.icon-checked-' + exerciseId).style.display = 'block'
        })
    })

    btnConclude.addEventListener('click', async e => {
        e.preventDefault()
        const response = await student.completeTraining(arrExercisesCompleted)
        let msg = response.msg
        if (response.success) {
            msg += "<br> O monstro está saindo da jaula"
        }

        modal.setTitle('Training Progress')
            .setContent(msg)
            .render([modal._btnOk])
    })
}

const doExercise = (exerciseId, isFinished) => {
    const persist = {
        studentid: idStudent,
        exercise_training: exerciseId,
        finished: isFinished ? 1 : 0,
        session: parseInt(currentSession.innerText),
        totalSessions: totalSessions
    }

    arrExercisesCompleted.push(persist)

    countExercises -= 1
    if (countExercises === 0) {
        document.querySelector('.conclude-training').disabled = false
        document.querySelector('.conclude-training').classList.add('btn-save')
    }
}

init()  