import axios from 'axios';

// TODO: Não foi possível fazer o login page a tempo

const uuidGuest = "9cc2b708-68ce-4086-a754-6337a8e68932";
const uuidAdmin = "d758b7f4-3e81-49b2-a334-3d8b3698384f";

const api = axios.create({
    baseURL: 'http://localhost:4000/api/v1/'
});

export async function getListTrainingsAvaliableByUserId() {
    const response = await api.get(`student-training/${uuidGuest}/available-trainings`);
    return !response.data ? [] : response.data;
}

export async function getEnabledTrainingByUserId() {
    const response = await api.get(`student-training/${uuidGuest}/enabled-training`);
    return !response.data ? [] : response.data;
}

export async function postStudentTraining(trainingUuid: string) {
    const response = await api.post('student-training', {
       'user_uuid': uuidGuest,
       'training_uuid': trainingUuid,
       'status': 'ENABLED'
    });

    return !response.data ? [] : response.data;
}

export async function postStudentTrainingProgress(studentTrainingUuid: string, activityUuid: string) {
    const response = await api.post('student-training-progress', {
       'student_training_uuid': studentTrainingUuid,
       'activity_uuid': activityUuid,
       'status': 'NOT_STARTED'
    });

    return !response.data ? [] : response.data;
}

export async function patchChangeStatusStudentTrainingProgress(studentTrainingUuid: string, activityUuid: string, status: string) {
    const response = await api.patch(`student-training-progress/${studentTrainingUuid}/student-training/${activityUuid}/activity/change-status`, {
        'status': status
    });
    return !response.data ? [] : response.data;
}

export async function getOtherTrainings() {
    const response = await api.get(`student-training/${uuidGuest}/other-trainings`);
    return !response.data ? [] : response.data;
}

export async function patchChangeStatusStudentTraining(studentTrainingUuid: string) {
    const response = await api.patch(`student-training/${studentTrainingUuid}/change-status`, {
        'status': 'ENABLED'
    });
    return !response.data ? [] : response.data;
}