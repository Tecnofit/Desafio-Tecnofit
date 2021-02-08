import React from 'react'
import styled from 'styled-components'

const Container = styled.div`
  display: flex;
  flex-direction: column;
  padding: 0 1.5rem;
  margin-top: 1.5rem;
`

const GymContainer: React.FC = (props) => {
  return <Container {...props}>{props.children}</Container>
}

export default GymContainer
