import React from 'react'
import Title from './styles'

const Typhography: React.FC = (props) => {
  return (
    <Title> {props.children} </Title>
  )
}

export default Typhography
