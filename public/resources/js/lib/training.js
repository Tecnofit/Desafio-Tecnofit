const getAllTrainings = async () => {
    const responseTraining = await fetch('api.php/get-all-training', {
        'method': 'get',
    })

    return responseTraining.json()
}


const getAllLevels = async () => {
    const trainingLvl = await fetch('api.php/get-all-traininglvl', {
        'method': 'get'
    })
    return trainingLvl.json()
}

const saveTraining = async training => {
    const formData = new FormData()
    formData.append('id', training.id)
    formData.append('name', training.name)
    formData.append('level', training.level)
    formData.append('desc', training.desc)
    formData.append('sessions', training.sessions)
    formData.append('resting', training.resting)
    formData.append('exercises', JSON.stringify(training.exercises))
    formData.append('sugested_for', training.sugestedFor)

    const response = await fetch('api.php/save-training', {
        'method': 'post',
        'body': formData
    })
    return response.json()
}

const deleteTraining = async id => {
    const response = await fetch('api.php/delete-training/trainingid/' + id, {
        'method': 'delete'
    })

    return response.json()
}

const getTrainingById = async id => {
    const response = await fetch('api.php/get-training-by/id/' + id, {
        'method' : 'get'
    })

    return response.json()
}

const getTrainingByStudent = async studentId => {
    const response = await fetch('api.php/get-training-by-student/studentid/' + studentId, {
        'method' : 'get'
    })

    return response.json()
}

export default { getAllTrainings, getAllLevels, saveTraining, deleteTraining, getTrainingById, getTrainingByStudent }