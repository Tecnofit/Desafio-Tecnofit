import React from 'react'
import GymContainer from './styles'
import WelcomeYofit from './WelcomeYofit'
import MasonryCard from './MasonryCard'
import Typhography from '../../../components/Typhography'

const AvaliableTraining = () => {
  return (
    <GymContainer>
        <WelcomeYofit />
        
        <div style={{marginBottom: '1rem'}}>
          <Typhography>Treinos Disponíveis</Typhography>
        </div>
        
        <MasonryCard />
    </GymContainer>
  )
}

export default AvaliableTraining
