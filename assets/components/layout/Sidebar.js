import React, {Fragment} from 'react';
import {Link} from "react-router-dom";


Sidebar.propTypes = {};

function Sidebar(props) {
    return (
        <Fragment>
            {/*<!-- Sidebar -->*/}
            <nav
                id="sidebarMenu"
                className="collapse d-lg-block sidebar collapse bg-white"
            >
                <div className="position-sticky">
                    <div className="list-group list-group-flush mx-3 mt-4">

                        <Link className={`list-group-item list-group-item-action py-2 ripple ${
                            window.location.pathname === '/dashboard' ? 'active' : ''
                        }`} to='/dashboard'>
                            <i className="fas fa-tachometer-alt fa-fw me-3"></i
                            ><span>Main dashboard</span>
                        </Link>

                        <Link className={`list-group-item list-group-item-action py-2 ripple ${
                            window.location.pathname === '/my-lessons' ? 'active' : ''
                        }`} to='/my-lessons'>
                            <i className="fa-solid fa-book-open fa-fw me-3"></i>
                            <span>My Lessons</span>
                        </Link>

                        <Link className={`list-group-item list-group-item-action py-2 ripple ${
                            window.location.pathname === '/my-questions' ? 'active' : ''
                        }`} to='/my-questions'>
                            <i className="fa-solid fa-clipboard-question fa-fw me-3"></i>
                            <span>My Questions</span>
                        </Link>
                        <a
                            href="#"
                            className="list-group-item list-group-item-action py-2 ripple"
                        ><i className="fas fa-chart-line fa-fw me-3"></i
                        ><span>Analytics</span></a
                        >
                    </div>
                </div>
            </nav>
            {/*<!-- Sidebar -->*/}
        </Fragment>
    );
}

export default Sidebar;