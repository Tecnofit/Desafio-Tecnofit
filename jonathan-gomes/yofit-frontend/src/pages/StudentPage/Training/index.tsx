import React from 'react'
import Typhography from '../../../components/Typhography'
import GymContainer from './styles'

const Training = () => {
  return (
    <GymContainer>
        <Typhography> Treino </Typhography>
        
        <span className='training'> Perna </span>

        <hr className='divider' style={{marginTop: '1rem', marginBottom: '1rem'}} />

        <div style={{display: 'flex', justifyContent: 'space-between', alignItems: 'center'}}>
          <Typhography> Excercício </Typhography>
          
          <div>
            <span>{'< voltar'}</span>
            {' '}
            <span>{'próximo >'}</span>
          </div>
        </div>

        <span className='activity'>Agachamento lateral de membros superiores</span>

        <hr className='divider' style={{marginTop: '1rem', marginBottom: '1rem'}} />

        <div className='actions'>
            <input type="radio" name="status" value="NOT_STARTED" checked />
            Não iniciei

            <input type="radio" name="status" value="IN_PROGRESS" />
            Fazendo

            <input type="radio" name="status" value="COMPLETED" />
            Ok

            <input type="radio" name="status" value="SKIPPED" />
            Pulo
        </div>

        <hr className='divider' style={{marginTop: '1rem', marginBottom: '1rem'}} />

    </GymContainer>
  )
}

export default Training
