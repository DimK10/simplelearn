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
            <section className="mb-4">
                <div className="card">
                    <div className="card-header py-3">
                        <h5 className="mb-0 text-center"><strong>Main Dashboard</strong></h5>
                    </div>
                    <div className="card-body">
                        {/*<canvas className="my-4 w-100" id="myChart" height="380"></canvas>*/}
                    </div>
                </div>
            </section>
        </div>
      </main>
      {/*<!--Main layout-->*/}
    </Fragment>
  );
};

Dashboard.propTypes = {};


export default Dashboard;
