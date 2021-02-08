import React from 'react'
import Loading from '../Loading'
import GymButton from './styles'
import IButton from './types'

const Button: React.FC<IButton> = (props) => {
  if (props.loading) {
    const disabled = true
    props = { disabled, ...props }
  }

  return (
    <GymButton {...props}>
      {props.loading === 1 && <Loading />}
      {props.children}
    </GymButton>
  )
}

export default Button
