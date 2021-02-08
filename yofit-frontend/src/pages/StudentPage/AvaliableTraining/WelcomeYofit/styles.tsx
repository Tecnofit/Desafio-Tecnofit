import React from 'react'
import styled from 'styled-components'

const Container = styled.div`
  display: flex;
  flex-direction: column;
  position: relative;
  background-color: #3057E4;
  color: white;
  padding: 1rem;
  align-items: center;
  font-size: 1.5rem;
  margin-bottom: 1.5rem;
`

const GymWelcomeYofitContainer: React.FC = (props) => {
  return <Container {...props}>{props.children}</Container>
}

export default GymWelcomeYofitContainer
