import React, {useEffect} from 'react';
import PropTypes from 'prop-types';
import {useParams} from "react-router-dom";
import {useDispatch, useSelector} from "react-redux";
import {getLessonByName, startLoadingAction} from "../../actions/lesson";
import HeaderNav from "../layout/HeaderNav";
import Alert from "../layout/Alert";
import {v4 as uuidv4} from 'uuid';
import Loading from "../layout/Loading";


function Exam(props) {

    const {lessonName} = useParams();

    const dispatch = useDispatch();

    const {loading, lesson} = useSelector(state => state.lesson);

    useEffect(() => {
        dispatch(getLessonByName(lessonName));
    }, []);


    return (
        <>
            {/* fixme please for the love of God, try to remove the unavailability on data loading */}
            <HeaderNav/>
            {
                loading === true
                &&
                lesson.questions.length === 0
                    ?
                    <main key={uuidv4()} style={{marginTop: '58px'}}>
                        <div className="container pt-4">
                            <Loading key={uuidv4()}/>
                        </div>
                    </main>
                    :
                    (
                        /* check if lesson does actually have questions to it, else show unavailable exam */
                        loading === false
                        &&
                        lesson.questions.length > 0
                            ?
                            <main key={uuidv4()} style={{marginTop: '58px'}}>
                                <div className="container pt-4">
                                    <Alert/>
                                    <section className="mb-4">
                                        <div className="card">
                                            <div className="card-header py-3">
                                                <div className="row">
                                                    <div className="col">
                                                        <h5 className="mb-0 me-auto text-center mb-5">
                                                            <strong>Take {lesson.name} Lesson
                                                                Exam
                                                                Now</strong>
                                                        </h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                </div>
                            </main>
                            :
                            <main key={uuidv4()} style={{marginTop: '58px'}}>
                                <div className="container pt-4">
                                    <Alert/>
                                    <section className="mb-4">
                                        <div className="card">
                                            <div className="card-header py-3">
                                                <div className="row">
                                                    <div className="col">
                                                        <h5 className="mb-0 me-auto text-center mb-5">
                                                            <strong>This exam is
                                                                unavailable at
                                                                the moment. Please try
                                                                again
                                                                later</strong>
                                                        </h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                </div>
                            </main>
                    )
            }


        </>
    );
}


Exam.propTypes = {};

export default Exam;