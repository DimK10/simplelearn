import React from 'react';
import PropTypes from "prop-types";

const LessonForm = ({lesson}) => {
    return (
        <>
            <div className="container pt-4">
                <section className="mb-4">
                    <div className="card">
                        <div className="card-header py-3">
                            <h5 className="mb-0 text-center mb-5"><strong>Question #1</strong>
                            </h5>
                            <p className="lead text-center">
                                What is the color of life?
                            </p>
                        </div>
                        <div className="card-body">
                            <div className="row mb-3">
                                <div className="card">
                                    <div
                                        className="card-body d-flex justify-content-between align-items-center question-card-body">
                                        <p className="card-text me-auto">1) Black my brother</p>
                                        <button type="button" className="btn btn-warning m-1"
                                                style={{height: 'min-content'}}
                                        >
                                            <i className="fa-solid fa-pen-to-square"
                                               style={{display: 'inline', marginRight: '.3rem'}}></i>
                                            <p style={{display: 'inline'}}>Edit</p>
                                        </button>
                                        <button type="button" className="btn btn-danger m-1"
                                                style={{height: 'min-content'}}>
                                            <i className="fa-solid fa-trash"
                                               style={{display: 'inline', marginRight: '.3rem'}}></i>
                                            <p style={{display: 'inline'}}>Delete</p>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div className="row mb-3">
                                <div className="card" id="correct">
                                    <div
                                        className="card-body d-flex justify-content-between align-items-center question-card-body">
                                        <p className="card-text me-auto">2) Sanguine my brother</p>
                                        <button type="button" className="btn btn-warning m-1"
                                                style={{height: 'min-content'}}
                                        >
                                            <i className="fa-solid fa-pen-to-square"
                                               style={{display: 'inline', marginRight: '.3rem'}}></i>
                                            <p style={{display: 'inline'}}>Edit</p>
                                        </button>
                                        <button type="button" className="btn btn-danger m-1"
                                                style={{height: 'min-content'}}>
                                            <i className="fa-solid fa-trash"
                                               style={{display: 'inline', marginRight: '.3rem'}}></i>
                                            <p style={{display: 'inline'}}>Delete</p>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div className="row mb-3">
                                <div className="card">
                                    <div
                                        className="card-body d-flex justify-content-between align-items-center question-card-body">
                                        <p className="card-text me-auto">3) Red my brother</p>
                                        <button type="button" className="btn btn-warning m-1"
                                                style={{height: 'min-content'}}
                                        >
                                            <i className="fa-solid fa-pen-to-square"
                                               style={{display: 'inline', marginRight: '.3rem'}}></i>
                                            <p style={{display: 'inline'}}>Edit</p>
                                        </button>
                                        <button type="button" className="btn btn-danger m-1"
                                                style={{height: 'min-content'}}>
                                            <i className="fa-solid fa-trash"
                                               style={{display: 'inline', marginRight: '.3rem'}}></i>
                                            <p style={{display: 'inline'}}>Delete</p>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </>
    )
};

LessonForm.prototypes = {
    lesson: PropTypes.object.isRequired
}

export default LessonForm;