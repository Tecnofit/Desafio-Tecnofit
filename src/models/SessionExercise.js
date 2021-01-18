const mongoose = require('mongoose');

const SessionExerciseSchema = new mongoose.Schema({
    trainingId: 
    {
        type: mongoose.Schema.Types.ObjectId,
        ref:'Training'
    },
    exerciseId:
    {
        type: mongoose.Schema.Types.ObjectId,
        ref:'Exercise'
    },
    status: {
        type: String,
        enum : [ 'done','skip' ],
        required: true
    },
    date: {
        type: Date, 
        default: Date.now
    },
});

module.exports = mongoose.model('SessionExercise', SessionExerciseSchema)