import React, {Fragment, useState} from 'react';
import {useDispatch, useSelector} from "react-redux";
import {Navigate} from "react-router-dom";
import NavBar from "../layout/NavBar";
import {login} from "../../actions/auth";
import Alert from "../layout/Alert";

const Login = () => {

  const isAuthenticated = useSelector(state => state.auth.isAuthenticated);

  const dispatch = useDispatch();

  const [formData, setFromData] = useState({
    username: "",
    password: ""
  });

  const {username, password} = formData;

  const onChange = e =>
    setFromData({...formData, [e.target.name]: e.target.value});

  const onSubmit = async e => {
    e.preventDefault();
    dispatch(login(username, password));
  };

  // Redirect if logged in
  if (isAuthenticated) {
    return <Navigate to='/dashboard'/>;
  }

  return (
    <Fragment>
      {
        !isAuthenticated ?

          (
            <Fragment>
              <NavBar/>
              <div className='bg-light min-vh-100 d-flex flex-row align-items-center'>
                <div className='container'>
                  <Alert />
                  <div className='row justify-content-center'>
                    <div className='card-group d-block d-md-flex row'>
                      <div className='card col-md-7 p-4 mb-0'>
                        <form onSubmit={(e) => onSubmit(e)}>
                          <div className='card-body'>
                            <h1>Login</h1>
                            <p className='text-medium-emphasis'>
                              Sign In to your account
                            </p>
                            <div className='input-group mb-3'>
                      <span className='input-group-text'>
                        <i className="fa-solid fa-user"></i>
                      </span>
                              <input
                                className='form-control'
                                type='text'
                                placeholder='Username'
                                name="username"
                                onChange={e => onChange(e)}
                                required
                              />
                            </div>
                            <div className='input-group mb-4'>
                      <span className='input-group-text'>
                        <i className="fa-solid fa-lock"></i>
                      </span>
                              <input
                                className='form-control'
                                type='password'
                                placeholder='Password'
                                name="password"
                                onChange={e => onChange(e)}
                              />
                            </div>
                            <div className='row'>
                              <div className='col-6'>
                                <input type='submit' className='btn btn-primary px-4'
                                       value='Login'/>
                              </div>
                              <div className='col-6 text-end'>
                                <button className='btn btn-link px-0' type='button'>
                                  Forgot password?
                                </button>
                              </div>
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </Fragment>)
          :
          (<Navigate to='/dashboard'/>)
      }
    </Fragment>
  )
    ;
};


export default Login;
