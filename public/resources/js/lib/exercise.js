const saveExercise = async exercise => {
    const formData = new FormData()
    formData.append('id', exercise.id)
    formData.append('name', exercise.name)
    formData.append('desc', exercise.desc)
    const response = await fetch('api.php/save-exercise', {
        'method': 'post',
        'body': formData
    })

    return response.json()
}

const getAllExercises = async () => {
    const responseExercises = await fetch('api.php/get-all-exercises', {
        'method' : 'get'
    })

    return responseExercises.json()
}

const deleteExercise = async id => {
    const response = await fetch('api.php/delete-exercise/exerciseid/' + id, {
        'method': 'delete'
    })

    return response.json()
}

const getExerciseById = async id => {
    const responseStudents = await fetch('api.php/get-exercise-by/id/' + id, {
        'method' : 'get'
    })

    return responseStudents.json()
}

const getExercisesByTraining = async trainingId => {
    const responseStudents = await fetch('api.php/get-exercises-by-training/trainingid/' + trainingId, {
        'method' : 'get'
    })

    return responseStudents.json()
}

export default { saveExercise, getAllExercises, deleteExercise, getExerciseById, getExercisesByTraining }