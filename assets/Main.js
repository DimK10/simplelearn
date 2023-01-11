import React, {Fragment, useEffect} from 'react';
import {StrictMode} from "react";
import {createRoot} from "react-dom/client";
import {BrowserRouter as Router, Routes, Route} from "react-router-dom";
import HelloPage from "./components/HelloPage";
import setAuthToken from "./utils/setAuthToken";
import store from "./store";
import {loadUser} from "./actions/auth";
import Login from "./components/auth/Login";
import {Provider} from "react-redux";
import Register from "./components/auth/Register";
import Logout from "./components/auth/Logout";
import SecuredPage from "./components/auth/SecuredPage";
import Dashboard from "./components/dashboard/Dashboard";

if (localStorage.token) {
  setAuthToken(localStorage.token);
}

function Main() {

  useEffect(() => {
    store.dispatch(loadUser());
  }, []);

  return (
    <Fragment>
      <Provider store={store}>
        <Router>
          <Routes>
            <Route exact path="/" element={<Login/>}/>
            <Route path='/sign-in' element={<Login/>}/>
            <Route path='/sign-up' element={<Register/>}/>
            <Route path='/logout' element={<Logout/>}/>

            <Route path='/dashboard' element={
              <SecuredPage>
                <Dashboard/>
              </SecuredPage>}/>
          </Routes>
        </Router>
      </Provider>
    </Fragment>
  );
}

export default Main;

if (document.getElementById('app')) {
  const rootElement = document.getElementById("app");
  const root = createRoot(rootElement);

  root.render(
    <StrictMode>
      <Main/>
    </StrictMode>
  );
}