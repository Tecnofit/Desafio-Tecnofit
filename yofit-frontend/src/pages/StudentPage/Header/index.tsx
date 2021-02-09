import React from 'react'
import GymHeader from './styles'
import Logo from '../../../assets/logo.png'

const Header = () => {
  return (
    <GymHeader>
      <div style={{display: 'flex', alignItems: 'center'}}>
        <img src={Logo} width='30px' height='auto' style={{marginRight: '1rem'}} />
        
        <span style={{fontSize: '26px'}}>Yofit</span>
      </div>

      <div style={{display: 'flex', alignItems: 'center'}}>
        <span style={{marginRight: '1rem', fontSize: '24px'}}>Olá, Convidado</span>
        <div style={{width: '30px', height: '30px', background: '#EEEEEE', borderRadius: '50%', display:'flex', alignItems: 'center', justifyContent: 'center'}}>J</div>
      </div>
    </GymHeader>
  )
}

export default Header
