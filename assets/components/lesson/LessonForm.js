import React, {useState} from 'react';
import PropTypes from "prop-types";
import AddQuestion from "./AddQuestion";
import {v4 as uuidv4} from 'uuid';

const LessonForm = ({lesson}) => {

    const [questionComponents, setQuestionComponents] = useState([]);

    const [formData, setFormData] = useState({
        questions: [],
    });

    const {
        questions
    } = formData;

    const onPlusBtnClick = (e) => {
        e.preventDefault();

        let questionComponent = {
            id: uuidv4()
        }

        setQuestionComponents([...questionComponents, questionComponent])
    }

    const onRemoveQuestionClick = (questionId) => {
        setQuestionComponents([...questionComponents.filter((questionComponent) => questionComponent.id !== questionId)]);
    }

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
                            <div className="row">
                                {
                                    questionComponents.map((questionComponent) => {
                                        return <AddQuestion questionId={questionComponent.id}
                                                            key={questionComponent.id}
                                                            onRemoveQuestionClick={onRemoveQuestionClick}
                                        />
                                    })
                                }
                            </div>
                            <div className="row">
                                <button className="btn btn-primary" onClick={(e) => {
                                    onPlusBtnClick(e)
                                }}>
                                    <i className="fa-solid fa-plus"></i>
                                </button>
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