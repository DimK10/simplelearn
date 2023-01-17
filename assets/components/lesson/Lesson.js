import React from 'react';
import PropTypes from "prop-types";
import LessonForm from "./LessonForm";
import {useSelector} from "react-redux";
import HeaderNav from "../layout/HeaderNav";

const Lesson = () => {

    const {lesson} = useSelector(state => state.lesson);

    return (
        <>
            <HeaderNav/>
            <main style={{marginTop: '58px'}}>
                <div className="container pt-4">
                    <section className="mb-4">
                        <div className="card">
                            <div className="card-header py-3">
                                <div className="row">
                                    <div className="col">
                                        <h5 className="mb-0 me-auto text-center mb-5">
                                            <strong>{lesson.name} Lesson</strong>
                                        </h5>
                                        <div className="text-center">
                                            <p className="">Click on the top border color to change the difficulty</p>
                                            <span
                                                className="border border-end-0 border-start-0 border-bottom-0 border-5 border-success rounded"
                                                style={{ marginRight: '.5rem' }}
                                            >Easy</span>
                                            <span
                                                className="border border-end-0 border-start-0 border-bottom-0  border-5 border-warning"
                                                style={{ marginRight: '.5rem' }}
                                            >Medium</span>
                                            <span
                                                className="border border-end-0 border-start-0 border-bottom-0  border-5 border-danger rounded"
                                                style={{ marginRight: '.5rem' }}
                                            >Hard</span>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div className="card-body">
                                <LessonForm lesson={lesson}/>
                            </div>
                        </div>
                    </section>
                </div>
            </main>
        </>
    )
};


export default Lesson;