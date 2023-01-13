import React, {useEffect, useState} from 'react';
import HeaderNav from "../layout/HeaderNav";
import {useDispatch} from "react-redux";
import {getAllLessonsByPageForTutor} from "../../actions/lesson";

const MyLessons = () =>{

    const dispatch = useDispatch();
    const lessons = useState(state => state.lesson);

    useEffect(() => {
        dispatch(getAllLessonsByPageForTutor(0, 10))
        console.log(lessons);
    }, [])

    return (
        <>
            <HeaderNav/>
            <main style={{marginTop: '58px'}}>
                <div className="container pt-4">
                    <section className="mb-4">
                        <div className="card">
                            <div className="card-header py-3">
                                <h5 className="mb-0 text-center"><strong>My Lessons Page</strong></h5>
                            </div>
                            <div className="card-body">
                                {/*<canvas className="my-4 w-100" id="myChart" height="380"></canvas>*/}
                            </div>
                        </div>
                    </section>
                </div>
            </main>
        </>
    );
}

export default MyLessons;