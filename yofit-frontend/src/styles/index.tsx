import { createGlobalStyle } from 'styled-components'

const GlobalStyles = createGlobalStyle`
  * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
  }

  html {
    font-size: 16px;
    font-family: "Raleway", Arial, Helvetica, sans-serif;
    text-rendering: optimizeLegibility;
  }

  body {
    height: 100%;
    width: 100%;
    font-size: 1rem;
  }
`

export default GlobalStyles
