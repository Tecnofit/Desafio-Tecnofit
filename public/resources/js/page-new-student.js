import student from './lib/student.js'
import training from './lib/training.js'
import modal from './lib/modal/modal.js'

const id = document.formStudent._id
const name = document.formStudent._name
const birth = document.formStudent._birth
const email = document.formStudent._email
const height = document.formStudent._height
const weight = document.formStudent._weight
const profile = document.formStudent._profile
const activeTraining = document.formStudent._activetraining

const btnSave = document.formStudent._btnSave
btnSave.addEventListener('click', async e => {
    e.preventDefault()

    const response = await student.saveStudent({
        id: id.value,
        name: name.value,
        birth: birth.value,
        email: email.value,
        height: height.value,
        weight: weight.value,
        profile: profile[profile.selectedIndex].value,
        activeTraining: activeTraining[activeTraining.selectedIndex].value
    })

    modal.setTitle('Student')
        .setContent(response.msg)
        .render([modal._btnOk])
})

const init = async () => {
    const profilesJson = await student.getAllProfiles()
    const trainingJson = await training.getAllTrainings()
    
    createSelectProfiles(profilesJson)
    createSelectTrainings(trainingJson)

    if (id.value != '') {
        const studentData = await student.getStudentById(id.value)
        fill(studentData[0])
    }
}

const createSelectProfiles = async (profiles) => {
    const profileElem = document.formStudent._profile
    profiles.map(profile => {
        profileElem.innerHTML += "<option value='"+profile.id+"'>"+profile.profile_desc+"</option>"
    })
}

const createSelectTrainings = async (trainings) => {
    const trainingElem = document.formStudent._activetraining
    trainings.map(training => {
        trainingElem.innerHTML += "<option value='"+training.id+"'>"+training.training_name+"</option>"
    })
}

const fill = student => {
    name.value = student.student_name
    birth.value = student.birth_date
    email.value = student.email
    height.value = student.height
    weight.value = student.weight
    
    const selectedProfile = Object.keys(profile).reduce((idx, i) => {
        if (profile[i].value === student.fk_student_profile) {
            return i
        }
    }, "")

    const selectedActiveTraining = Object.keys(activeTraining).reduce((idx, i) => {
        if (activeTraining[i].value === student.fk_active_training) {
            idx = i
            return i
        }
        return idx
    }, "")
    
    profile.selectedIndex = selectedProfile
    activeTraining.selectedIndex = selectedActiveTraining
}

init()