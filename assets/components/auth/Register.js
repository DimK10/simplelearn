import React, {Fragment} from 'react';
import NavBar from './../layout/NavBar';
import Alert from "../layout/Alert";

const Register = (props) => {
  return (
    <Fragment>
      <NavBar />
      <div className='bg-light min-vh-100 d-flex flex-row align-items-center'>
        <div className='container'>
          <Alert />
          <div className='row justify-content-center'>
            <div className='col-md-6'>
              <div className='card mb-4 mx-4'>
                <div className='card-body p-4'>
                  <h1>Register</h1>
                  <p className='text-medium-emphasis'>Create your account</p>
                  <div className='input-group mb-3'>
                    <span className='input-group-text'>
                      <i className="fa-solid fa-user"></i>
                    </span>
                    <input
                      className='form-control'
                      type='text'
                      placeholder='Username'
                    />
                  </div>
                  <div className='input-group mb-3'>
                    <span className='input-group-text'>
                      <i className="fa-solid fa-envelope-open"></i>
                    </span>
                    <input
                      className='form-control'
                      type='text'
                      placeholder='Email'
                    />
                  </div>
                  <div className='input-group mb-3'>
                    <span className='input-group-text'>
                      <i className="fa-solid fa-lock"></i>
                    </span>
                    <input
                      className='form-control'
                      type='password'
                      placeholder='Password'
                    />
                  </div>
                  <div className='input-group mb-3'>
                    <span className='input-group-text'>
                      <i className="fa-solid fa-lock"></i>
                    </span>
                    <input
                      className='form-control'
                      type='password'
                      placeholder='Repeat password'
                    />
                  </div>
                  <div className='input-group mb-4'>
                    <select
                      className="form-select" id="role-select">
                      <option value="" defaultValue={true}>What do you want to do?</option>
                      <option value="customer">I am a customer and I want to order rooms</option>
                      <option value="manager">I want to manage hotels and their rooms</option>
                    </select>
                  </div>
                  <button className='btn btn-block btn-success' type='button'>
                    Create Account
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </Fragment>
  );
};

Register.propTypes = {};

export default Register;
