const mongoose = require('mongoose');

const TrainingExercisesSchema = new mongoose.Schema({
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
    sessions: {
        type: Number,
        required: true
    },
},
{
    timestamps: true
});

module.exports = mongoose.model('TrainingExercises', TrainingExercisesSchema)