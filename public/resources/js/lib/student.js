const saveStudent = async student => {
    const formData = new FormData()
    formData.append('id', student.id)
    formData.append('name', student.name)
    formData.append('email', student.email)
    formData.append('birth', student.birth)
    formData.append('height', student.height)
    formData.append('weight', student.weight)
    formData.append('profile', student.profile)
    formData.append('activetraining', student.activeTraining)

    const response = await fetch('api.php/save-student', {
        'method': 'post',
        'body': formData
    })
    return response.json()
}

const getAllProfiles = async () => {
    const responseProfiles = await fetch('api.php/get-all-profiles', {
        'method' : 'get'
    })

    return responseProfiles.json()
}

const getAllStudents = async () => {
    const responseStudents = await fetch('api.php/get-all-students', {
        'method' : 'get'
    })

    return responseStudents.json()
}

const deleteStudent = async id => {
    const response = await fetch('api.php/delete-student/studentid/' + id, {
        'method': 'delete'
    })

    return response.json()
}


const updateStudent = async id => {
    const student = await _getStudentById(id)
    return student
}

const getStudentById = async id => {
    const responseStudents = await fetch('api.php/get-students-by/id/' + id, {
        'method' : 'get'
    })

    return responseStudents.json()
}

const getStudentTraining = async (idStudent, training) => {
    const responseStudents = await fetch('api.php/get-students-training/studentid/' + idStudent + '/trainingid/' + training, {
        'method' : 'get'
    })

    return responseStudents.json()
}

const completeTraining = async exercisesCompleted => {

    const formData = new FormData()
    formData.append('exercises_completed', JSON.stringify(exercisesCompleted))

    const response = await fetch('api.php/complete-training', {
        'method' : 'post',
        'body' : formData
    })

    return response.json()
}

export default { 
    getAllProfiles,
    saveStudent,
    getAllStudents,
    deleteStudent,
    updateStudent,
    getStudentById,
    getStudentTraining,
    completeTraining
}