import React, {Fragment, useEffect, useReducer, useState} from 'react';
import Pagination from "../layout/Pagination";
import {connect, useDispatch, useSelector} from "react-redux";
import {useNavigate} from "react-router-dom";


function MyLessonsTable() {

    const dispatch = useDispatch();

    const navigate = useNavigate();

    const [pageSize, setPageSize] = useState(10);

    const [pages, setPages] = useState(1);

    const [currentPage, setCurrentPage] = useState(1);

    const {user, loading} = useSelector(state => state.auth);

    const {loading: hotelsLoading, count, hotels} = useSelector(state => state.lesson);

    useEffect(() => {
        setPages(Math.floor(count / 10));
    }, [count]);

    useEffect(() => {
        // dispatch(getAllHotelsByPage(currentPage - 1, pageSize, 'id', user?.id));
    }, [pages]);


    const handleSelectChange = (e) => {
        setCurrentPage(1);
        setPageSize(e.target.value);
        setPages(Math.floor((count / e.target.value) + (count % e.target.value > 0 ? 1 : 0)));
    }

    const changePage = (e) => {
        e.preventDefault();

        if (!loading) {

            setCurrentPage(parseInt(e.target.textContent));
            let selectedPage = e.target.textContent - 1;
            // dispatch(getAllHotelsByPage(selectedPage, pageSize, 'id', user?.id));
        }
    }


    const moveToNextPage = (e) => {
        e.preventDefault();

        if (!loading) {

            setCurrentPage(prevState => prevState + 1);
            // dispatch(getAllHotelsByPage(currentPage, pageSize, 'id', user?.id));
        }
    }

    const moveToPreviousPage = (e) => {
        e.preventDefault();

        if (!loading) {

            // This will be used to set the page as zero indexed number (due to how pagination is configured in backend)
            let page = currentPage - 2;
            setCurrentPage(prevState => prevState - 1);
            // dispatch( getAllHotelsByPage(page, pageSize, 'id', user?.id));
        }
    }

    const onRowClick = (lesson) => {
        navigate(`/my-lessons/${lesson.id}`);
    }

    return (
        <Fragment>
            <div className="row">
                <div className="col">
                    <h4 className="mb-4 mr-auto">List of your Lessons</h4>
                </div>
                <div className="col-auto">
                    <label htmlFor="rows-select" style={{marginRight: ".5rem"}}>Number of
                        records:</label>
                    <select
                        className="custom-select" id="rows-select"
                        onChange={(e) => handleSelectChange(e)}>
                        <option value="10" defaultValue={true}>10</option>
                        <option value="20">20</option>
                        <option value="30">30</option>
                    </select>
                </div>
            </div>

            <div className="row">
                <table className="table table-hover table-responsive">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Description</th>
                        <th scope="col" className="d-none d-md-table-cell">Number of Enrolled Students</th>
                        <th scope="col">Edit/Delete</th>
                    </tr>
                    </thead>
                    <tbody>
                    {

                        hotels.map((hotel) => (
                            <Fragment>
                                <tr style={{ cursor: 'pointer' }} onClick={e => onRowClick(lesson)}>
                                    <th
                                        scope="row">{pageSize * (currentPage - 1) + lessons.indexOf(lesson) + 1}</th>
                                    <td>{lesson.name}</td>
                                    <td>{lesson.name}</td>
                                    <td className="d-none d-md-table-cell">{lesson.enrolledStudents.length}</td>
                                    <td className="flex-row">
                                        <button type="button" className="btn btn-success"
                                                style={{color: '#fff', marginRight: '0.3rem'}}
                                                title="Edit this hotel"
                                        >
                                            {/* icon here*/}
                                        </button>
                                        <button type="button" className="btn btn-danger"
                                                style={{color: '#fff'}}
                                                title="Delete this hotel">
                                            {/* icon here */}
                                        </button>
                                    </td>
                                </tr>
                            </Fragment>
                        ))
                    }
                    </tbody>
                </table>
                <Pagination pages={pages} changePage={changePage} moveToNextPage={moveToNextPage}
                            moveToPreviousPage={moveToPreviousPage} currentPage={currentPage}/>
            </div>
        </Fragment>
    );
}

export default MyLessonsTable;