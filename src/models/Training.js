const mongoose = require('mongoose');

const TrainingSchema = new mongoose.Schema({
    user_id: {
        type: String,
        required: true
    },
    name: {
        type: String,
        required: true
    },
    status: {
        type: String,
        enum : [ 'active','inactive' ],
        default: 'inactive'
    }
},
{
    timestamps: true
});

module.exports = mongoose.model('Training', TrainingSchema)