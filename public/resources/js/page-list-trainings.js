import training from './lib/training.js'
import modal from './lib/modal/modal.js'

let trainings = undefined

const init = async () => {
    trainings = await training.getAllTrainings()
    createTrainingsList()
    _bindEvents()
}

const createTrainingsList = filteredList => {
    const listElem = document.querySelector('.training-list')
    let trainingsList = trainings

    listElem.innerHTML = ''
    
    if (filteredList !== undefined) {
        trainingsList = filteredList
    }

    if (trainings.length === 0) {
        listElem.innerHTML += "<div class='flex-container card-list'>There's no training registered</div><a href='/'>HOME</a>"
        return
    }

    trainingsList.map(training => {
        listElem.innerHTML += "<div class='flex-container card-list'>"
            + "    <h4>" + training.training_name + " - " + training.level_desc + "</h4>"
            + "    <div class='full-row'>"
            + "        <p class='full-row'>Description: " + training.training_desc + "</p>"
            + "        <p class='full-row'>Number of sessions: " + training.session_quantity + "</p>"
            + (training.profile_desc ? "        <p class='full-row'>Training sugested for: " + training.profile_desc + "</p>" : "")
            + "        <p class='full-row'>Created: " + training.created_at + "</p>"
            + "    </div>"
            + "    <div class='flex-container actions'>"
            + "        <form action='new-training.php' name='formEditTraining' method='post' class='form-edit-training'>"
            + "            <img data-trainingid='" + training.id + "' class='clickable update-training' src='resources/images/pencil.png' alt='Edit'>"
            + "            <input type='hidden' name='trainingid' value='" + training.id + "'>"
            + "        </form>"
            + "        <img  data-trainingid='" + training.id + "' class='clickable delete-training' src='resources/images/trash.png' alt='Delete'>"
            + "    </div>"
            + "</div>"
    })
}

const _bindEvents = () => {
    const deleteTrainingElem = document.getElementsByClassName('delete-training')
    const updateTrainingElem = document.getElementsByClassName('update-training')
    const filterElem = document.querySelector('.filter')

    Object.keys(deleteTrainingElem).map(i => {
        deleteTrainingElem[i].addEventListener('click', e => {
            modal.setTitle('Training')
                .setContent("Do you really want to delete this training?")
                .render([modal._btnCancel, modal._btnConfirm])

            modal.setCallbackConfirmButton(async () => {
                const response = await training.deleteTraining(e.target.dataset.trainingid)
                modal.setTitle('Training')
                    .setContent(response.msg)
                    .render([modal._btnOk])
            })
        
        })
    })
    
    Object.keys(updateTrainingElem).map(i => {
        updateTrainingElem[i].addEventListener('click', e => {
            document.getElementsByClassName('form-edit-training')[i].submit()
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
    const filteredList = trainings.filter((training, idx) => training.training_name.toLowerCase().indexOf(term.toLowerCase()) !== -1)

    createTrainingsList(filteredList)
    _bindEvents()
}

init()