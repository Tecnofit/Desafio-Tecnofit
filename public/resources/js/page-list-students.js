import student from './lib/student.js'
import modal from './lib/modal/modal.js'

let students = undefined

const init = async () => {
    students = await student.getAllStudents()
    createStudentsList()
    _bindEvents()
}

const createStudentsList = filteredList => {
    const listElem = document.querySelector('.students-list')
    let studentsList = students

    listElem.innerHTML = ''
    
    if (filteredList !== undefined) {
        studentsList = filteredList
    }

    if (students.length === 0) {
        listElem.innerHTML += "<div class='flex-container card-list'>There's no student registered</div><a href='/'>HOME</a>"
        return
    }

    studentsList.map(student => {
        listElem.innerHTML += "<div class='flex-container card-list'>"
            + "    <h4>" + student.student_name + "</h4>"
            + "    <div class='full-row'>"
            + "        <p class='full-row'>Email: " + student.email + "</p>"
            + "        <p class='full-row'>Profile: " + student.profile_desc + "</p>"
            + "        <p class='full-row'>Active training: " + (student.training_name ? student.training_name : 'None') + "</p>"
            + "    </div>"
            + "    <div class='flex-container actions'>"
            + "        <form action='new-student.php' name='formEditStudent' method='post' class='form-edit-student'>"
            + "            <img data-studentid='" + student.id + "' class='clickable update-student'src='resources/images/pencil.png' alt='Edit'>"
            + "            <input type='hidden' name='studentid' value='" + student.id + "'>"
            + "        </form>"
            + "        <img data-studentid='" + student.id + "' class='delete-student' src='resources/images/trash.png' alt='Delete'>"
            + "        <form action='workout-student.php' name='formWorkoutStudent' method='post' class='form-workout-student'>"
            + "            <img data-studentid='" + student.id + "' class='clickable workout-student' src='resources/images/gym.png' alt='Workout'>"
            + "            <input type='hidden' name='studentid' value='" + student.id + "'>"
            + "        </form>"
            + "    </div>"
            + "</div>"
    })
}

const _bindEvents = () => {
    const deleteStudentElem = document.getElementsByClassName('delete-student')
    const updateStudentElem = document.getElementsByClassName('update-student')
    const workoutStudentElem = document.getElementsByClassName('workout-student')
    const filterElem = document.querySelector('.filter')
    
    Object.keys(deleteStudentElem).map(i => {
        deleteStudentElem[i].addEventListener('click', e => {
            modal.setTitle('Student')
                .setContent('Do you really want to delete this register?')
                .render([modal._btnCancel, modal._btnConfirm])
            
            modal.setCallbackConfirmButton(async () => {
                const response = await student.deleteStudent(e.target.dataset.studentid)
                modal.setContent(response.msg).render([modal._btnOk])
            })
        })
    })

    Object.keys(updateStudentElem).map(i => {
        updateStudentElem[i].addEventListener('click', e => {
            document.getElementsByClassName('form-edit-student')[i].submit()
        })
    })

    Object.keys(workoutStudentElem).map(i => {
        workoutStudentElem[i].addEventListener('click', e => {
            document.getElementsByClassName('form-workout-student')[i].submit()
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
    const filteredList = students.filter((student, idx) => student.student_name.toLowerCase().indexOf(term.toLowerCase()) !== -1 )

    createStudentsList(filteredList)
    _bindEvents()
}

init()