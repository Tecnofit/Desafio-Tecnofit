import React from 'react'

import { Route, Switch, BrowserRouter } from 'react-router-dom'

import StudentPage from './pages/StudentPage'
import AdminPage from './pages/AdminPage'

function Routes() {
  return (
    <BrowserRouter>
      <Switch>
        <Route exact path="/" component={StudentPage} />
      </Switch>

      <Switch>
        <Route exact path="/management" component={AdminPage} />
      </Switch>
    </BrowserRouter>
  )
}

export default Routes
