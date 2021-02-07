import React from 'react'
import Button from '../../../components/Button'
import Typhography from '../../../components/Typhography'

const OtherTrainings = () => {
  return (
    <>
      <Typhography> Demais treinos </Typhography>
      
      <div style={{'display': 'flex', flexDirection: 'column', marginTop: '1rem', overflowY: 'auto', maxHeight: '200px'}}>
          <div style={{border: '1px solid #EEEEEE', padding: '.5rem 10px', display: 'flex', justifyContent: 'space-between', alignItems: 'center'}}>
            <span>Braço</span>
            
            <span style={{width: '100'}}>
              <Button primary>Fazer</Button>
            </span>
          </div>

          <div style={{border: '1px solid #EEEEEE', padding: '.5rem 10px', display: 'flex', justifyContent: 'space-between', alignItems: 'center'}}>
            <span>Caminhada</span>
            
            <span style={{width: '100'}}>
              <Button primary>Fazer</Button>
            </span>
          </div>

          <div style={{border: '1px solid #EEEEEE', padding: '.5rem 10px', display: 'flex', justifyContent: 'space-between', alignItems: 'center'}}>
            <span>Perna</span>
            
            <span style={{width: '100'}}>
              <Button primary>Fazer</Button>
            </span>
          </div>
      </div>
    </>
  )
}

export default OtherTrainings
