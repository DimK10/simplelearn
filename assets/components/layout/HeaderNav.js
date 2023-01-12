import React, {Fragment} from 'react';
import Breadcrumb from "./Breadcrumb";
import {Link} from "react-router-dom";
import Alert from "./Alert";
import Sidebar from "./Sidebar";

const HeaderNav = props => {

  return (
    <Fragment>
      {/*<!--Main Navigation-->*/}
      <header>
        <Sidebar/>
        {/*<!-- Navbar -->*/}
        <nav
          id="main-navbar"
          className="navbar navbar-expand-lg navbar-light bg-white fixed-top"
        >
          {/*<!-- Container wrapper -->*/}
          <div className="container-fluid">
            {/*<!-- Toggle button -->*/}
            <button
              className="navbar-toggler"
              type="button"
              data-mdb-toggle="collapse"
              data-mdb-target="#sidebarMenu"
              aria-controls="sidebarMenu"
              aria-expanded="false"
              aria-label="Toggle navigation"
            >
              <i className="fas fa-bars"></i>
            </button>

            {/*<!-- Brand -->*/}
            <a className="navbar-brand" href="#">
              <h2 style={{fontWeight: '900'}}>Simplelearn</h2>
            </a>
            {/*<!-- Search form -->*/}
            {/*<form className="d-none d-md-flex input-group w-auto my-auto">*/}
            {/*  <input*/}
            {/*    autoComplete="off"*/}
            {/*    type="search"*/}
            {/*    className="form-control rounded"*/}
            {/*    placeholder='Search (ctrl + "/" to focus)'*/}
            {/*    style={{minWidth: '225px'}}*/}
            {/*  />*/}
            {/*  <span className="input-group-text border-0"*/}
            {/*  ><i className="fas fa-search"></i*/}
            {/*  ></span>*/}
            {/*</form>*/}

            {/*<!-- Right links -->*/}
            <ul className="navbar-nav ms-auto d-flex flex-row">
              {/*<!-- Icon dropdown -->*/}
              <li className="nav-item dropdown">
                <a
                  className="nav-link me-3 me-lg-0 dropdown-toggle hidden-arrow"
                  href="#"
                  id="navbarDropdown"
                  role="button"
                  data-mdb-toggle="dropdown"
                  aria-expanded="false"
                >
                  <i className="united kingdom flag m-0"></i>
                </a>
                <ul
                  className="dropdown-menu dropdown-menu-end"
                  aria-labelledby="navbarDropdown"
                >
                  <li>
                    <a className="dropdown-item" href="#"
                    ><i className="united kingdom flag"></i>English
                      <i className="fa fa-check text-success ms-2"></i
                      ></a>
                  </li>
                  <li>
                    <hr className="dropdown-divider"/>
                  </li>
                  <li>
                    <a className="dropdown-item" href="#"
                    ><i className="poland flag"></i>Polski</a
                    >
                  </li>
                  <li>
                    <a className="dropdown-item" href="#"
                    ><i className="china flag"></i>中文</a
                    >
                  </li>
                  <li>
                    <a className="dropdown-item" href="#"
                    ><i className="japan flag"></i>日本語</a
                    >
                  </li>
                  <li>
                    <a className="dropdown-item" href="#"
                    ><i className="germany flag"></i>Deutsch</a
                    >
                  </li>
                  <li>
                    <a className="dropdown-item" href="#"
                    ><i className="france flag"></i>Français</a
                    >
                  </li>
                  <li>
                    <a className="dropdown-item" href="#"
                    ><i className="spain flag"></i>Español</a
                    >
                  </li>
                  <li>
                    <a className="dropdown-item" href="#"
                    ><i className="russia flag"></i>Русский</a
                    >
                  </li>
                  <li>
                    <a className="dropdown-item" href="#"
                    ><i className="portugal flag"></i>Português</a
                    >
                  </li>
                </ul>
              </li>

              {/*<!-- Avatar -->*/}
              <li className="nav-item dropdown">
                <a
                  className="nav-link dropdown-toggle hidden-arrow d-flex align-items-center"
                  href="#"
                  id="navbarDropdownMenuLink"
                  role="button"
                  data-mdb-toggle="dropdown"
                  aria-expanded="false"
                >
                  <i className="fa-solid fa-user"></i>
                </a>
                <ul
                  className="dropdown-menu dropdown-menu-end"
                  aria-labelledby="navbarDropdownMenuLink"
                >
                  {/*<li><a className="dropdown-item" href="#">My profile</a></li>*/}
                  {/*<li><a className="dropdown-item" href="#">Settings</a></li>*/}
                  <li>
                    <Link className="dropdown-item" to='/logout'>
                      Logout
                    </Link>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
          {/*<!-- Container wrapper -->*/}
        </nav>
        {/*<!-- Navbar -->*/}
      </header>

      {/*<!--Main Navigation-->*/}

    </Fragment>
  );
};

HeaderNav.propTypes = {};

export default HeaderNav;
