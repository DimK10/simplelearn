import React, {Fragment} from 'react';

import HeaderNav from "../layout/HeaderNav";
import {Link, useNavigate} from "react-router-dom";
import {useSelector} from "react-redux";

const Dashboard = props => {

  const {user, loading} = useSelector(state => state.auth);

  let navigate = useNavigate();

  const onCardClick = (url) => {
    navigate(url);
  }

  return (
    <Fragment>
      <HeaderNav/>
      {/*<!--Main layout-->*/}

      <main style={{marginTop: '58px'}}>
        <div className="container pt-4">
          Dashboard Page
        </div>
      </main>
      {/*<!--Main layout-->*/}
    </Fragment>
  );
};

Dashboard.propTypes = {};


export default Dashboard;
