const User = require('../models/User');
const Training = require('../models/Training');

module.exports = {
    create: async (req, res) => {
        try{

            let rtn = await User.create({
                name: req.body.name,
                email: req.body.email
            })

            return res.json(rtn)

        }catch (err){
            return res.status(400).json({
                error: 'Error on create user.',
                message: err.message
            });
        }
    },
    find: async (req, res) => {
        try{

            if(!req.params.email){
                return res.status(400).send({
                    error: 'E-mail is required',
                    message: err.message
                });
            }

            let user = await User.findOne({'email': req.params.email});
            let training = await Training.find({'user_id': user._id, 'status': 'active'});

            if(!user){
                return res.status(400).json({
                    error: 'User don\'t exists'
                });
            }
            
            return res.status(200).json({
                user,
                training
            });
        } catch (err) {
            return res.status(400).send({
                error: 'Find failed.',
                message: err.message
            });
        }
    },
    update: async (req, res) => {
        try{

            if(!req.params.email){
                return res.status(400).send({
                    error: 'Email is required'
                });
            }

            let email = req.params.email;

            let dbUser = await User.findOne({
                'email': new Object(email)
            });

            if(!dbUser){
                return res.status(400).json({
                    error: 'User don\'t exists'
                });
            }

            let data = { 
                name: (typeof req.body.name !== 'undefined' && req.body.name != dbUser.name) ? req.body.name : dbUser.name, 
                email: (typeof req.body.email !== 'undefined' && req.body.email != dbUser.email) ? req.body.email : dbUser.email,
            };

            await User.updateOne({'_id': dbUser._id} , data);

            return res.json(data);
        } catch (err) {
            return res.status(400).send({
                error: 'Update failed.',
                message: err.message
            });
        }
    },
    delete: async (req, res) => {
        try{

            let email = req.params.email;

            let dbUser = await User.findOne({
                'email': new Object(email)
            });

            const user = await User.remove({ 
                '_id': dbUser._id
            });

            return res.send('User ' + id.email + ' deleted!');
        } catch (err) {
            return res.status(400).send({
                error: 'Delete failed.',
                message: err.message
            });
        }
    },
}