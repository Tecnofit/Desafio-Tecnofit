import React from 'react'
import GymWelcomeYofitContainer from './styles'

const WelcomeYofit = () => {
  return (
    <GymWelcomeYofitContainer>
        <span style={{position: 'absolute', top: 5, right: 15}}>X</span>
        <p>Seja bem vindo ao <strong>Yofit</strong></p>
        <p>A gestão dos seus treinos do seu jeito, com a sua cara</p>
    </GymWelcomeYofitContainer>
  )
}

export default WelcomeYofit
