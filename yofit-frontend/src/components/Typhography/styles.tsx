import React from 'react'
import styled from 'styled-components'

const Container = styled.span`
  font-size: 16px;
  color: #3057E4;
  text-transform: uppercase;
`

const Title: React.FC = (props) => {
  return <Container {...props}>{props.children}</Container>
}

export default Title
