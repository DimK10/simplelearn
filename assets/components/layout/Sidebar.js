import React, {Fragment, useEffect} from 'react';
import {Link} from "react-router-dom";
import {useDispatch, useSelector} from "react-redux";
import {v4 as uuidv4} from 'uuid';
import {
    getAllLessonsByPageForStudent,
    getAllLessonsByPageForTutor
} from "../../actions/lesson";


Sidebar.propTypes = {};

function Sidebar(props) {

    const dispatch = useDispatch();

    const auth = useSelector(state => state.auth);

    const {loading, lessons} = useSelector(state => state.lesson);

    useEffect(() => {

        if (lessons.length === 0)
            dispatch(getAllLessonsByPageForStudent(0, 10));
    }, []);


    return (
        <Fragment>
            {/*<!-- Sidebar -->*/}
            <nav
                id="sidebarMenu"
                className="collapse d-lg-block sidebar collapse bg-white"
            >
                <div className="position-sticky">
                    <div className="list-group list-group-flush mx-3 mt-4">

                        {/* Dashboard link - open to all roles */}
                        <Link
                            className={`list-group-item list-group-item-action py-2 ripple ${
                                window.location.pathname === '/dashboard' ? 'active' : ''
                            }`} to='/dashboard'>
                            <i className="fas fa-tachometer-alt fa-fw me-3"></i
                            ><span>Main dashboard</span>
                        </Link>

                        {/* Teacher lessons page - open only to teacher role */}
                        {
                            auth.isAuthenticated
                            &&
                            auth.user !== null
                            &&
                            auth.user !== 'undefined'
                            &&
                            auth.user.hasOwnProperty('roles')
                            &&
                            auth.user.roles.includes('ROLE_ADMIN')
                            &&
                            <Link key={uuidv4()}
                                  className={`list-group-item list-group-item-action py-2 ripple ${
                                      window.location.pathname === '/my-lessons' ? 'active' : ''
                                  }`} to='/my-lessons'>
                                <i className="fa-solid fa-book-open fa-fw me-3"></i>
                                <span>My Lessons</span>
                            </Link>
                        }


                        {/* analytics page - open to all roles */}
                        <a
                            href="#"
                            className="list-group-item list-group-item-action py-2 ripple"
                        ><i className="fas fa-chart-line fa-fw me-3"></i
                        ><span>Analytics</span></a
                        >

                        {
                            auth.isAuthenticated
                            &&
                            auth.user !== null
                            &&
                            auth.user !== 'undefined'
                            &&
                            auth.user.hasOwnProperty('roles')
                            &&
                            auth.user.roles.includes('ROLE_STUDENT')
                            &&
                            lessons.map(lesson => (
                                <Link key={uuidv4()}
                                      className={`list-group-item list-group-item-action py-2 ripple ${
                                          window.location.pathname === `/${lesson.name}/exam` ? 'active' : ''
                                      }`} to={`/${lesson.name}/exam`}>
                                    <i className="fa-solid fa-book-open fa-fw me-3"></i>
                                    <span>Take {lesson.name} exam</span>
                                </Link>
                            ))
                        }
                    </div>
                </div>
            </nav>
            {/*<!-- Sidebar -->*/}
        </Fragment>
    );
}

export default Sidebar;