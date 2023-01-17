import React, {useEffect, useState} from 'react';
import PropTypes from "prop-types";
import AddQuestion from "./AddQuestion";
import {v4 as uuidv4} from 'uuid';

const LessonForm = ({lesson}) => {

    const [questionComponents, setQuestionComponents] = useState([]);

    const [difficultyComponent, setDifficultyComponent] = useState(false);

    const [formData, setFormData] = useState({
        questions: [],
    });

    const {
        questions
    } = formData;

    useEffect(() => {
        console.log(formData);
    }, [formData]);

    const formIsInvalid = (form) => form.checkValidity() === false;

    const onPlusBtnClick = (e) => {
        e.preventDefault();

        let questionComponent = {
            id: uuidv4()
        }

        setQuestionComponents([...questionComponents, questionComponent])
    }

    const onAddQuestionClick = (e, questionId, question) => {
        e.preventDefault();
        const form = e.target.form;

        // Check for basic form validity
        if (form.checkValidity() === false) {
            form.reportValidity();
            return;
        }
        // TODO SEND TO API

        // add to formData
        setFormData({
            ...formData,
            questions: [...questions, question]
        });

        // remove from questions
        onRemoveQuestionComponentClick(questionId);
    }

    const removeSavedQuestion = (questionId) => {
        setFormData({...formData, questions: [...questions.filter((question) => question.id !== questionId)]});
    }

    const onRemoveQuestionComponentClick = (questionId) => {
        setQuestionComponents([...questionComponents.filter((questionComponent) => questionComponent.id !== questionId)]);
    }


    const onRemoveSavedQuestionClick = (e) => {
        const questionId = e.currentTarget.getAttribute('data-index');

        // TODO SEND TO API REMOVE ANSWER

        removeSavedQuestion(questionId);
    }

    const toggleDifficultyClick = () => {
        setDifficultyComponent(!difficultyComponent);
    }

    return (
        <>
            <div className="container pt-4">
                <section className="mb-4">
                    <div className="card">
                        <span className="border border-5 border-danger rounded" onClick={toggleDifficultyClick}></span>
                        <div className="card-header py-3">
                            <div className="row">
                                <h5 className="mb-0 text-center mb-5"><strong>Question #1</strong></h5>
                            </div>
                            <div className="row">
                                <p className="lead text-center">
                                    What is the color of life?
                                </p>
                            </div>
                            {
                                difficultyComponent
                                &&
                                <div className="row text-center">
                                    <div className="col">
                                        <div className="custom-control custom-radio d-inline-block w-30">
                                            <input type="radio" className="custom-control-input" id="defaultGroupExample1"
                                                   name="groupOfDefaultRadios" />
                                            <label className="custom-control-label" htmlFor="defaultGroupExample1">Easy</label>
                                        </div>
                                    </div>
                                    <div className="col">
                                        <div className="custom-control custom-radio d-inline-block">
                                            <input type="radio" className="custom-control-input" id="defaultGroupExample2"
                                                   name="groupOfDefaultRadios" defaultChecked={true} />
                                            <label className="custom-control-label" htmlFor="defaultGroupExample2">Medium</label>
                                        </div>
                                    </div>
                                    <div className="col">
                                        <div className="custom-control custom-radio d-inline-block">
                                            <input type="radio" className="custom-control-input" id="defaultGroupExample3"
                                                   name="groupOfDefaultRadios" />
                                            <label className="custom-control-label" htmlFor="defaultGroupExample3">Hard</label>
                                        </div>
                                    </div>





                                </div>
                            }


                        </div>
                        <div className="card-body">
                            {
                                questions !== null
                                &&
                                questions.length > 0
                                    ?
                                    questions.map(question => (
                                        <div className="row mb-3" key={question.id}>
                                            <div className={`card ${question.checked && 'correct'}`}>
                                                <div
                                                    className="card-body d-flex justify-content-between align-items-center question-card-body">
                                                    <p className="card-text me-auto">{questions.indexOf(question) + 1}) {question.title}</p>
                                                    <button type="button" className="btn btn-warning m-1"
                                                            style={{height: 'min-content'}}
                                                    >
                                                        <i className="fa-solid fa-pen-to-square"
                                                           style={{display: 'inline', marginRight: '.3rem'}}></i>
                                                        <p style={{display: 'inline'}}>Edit</p>
                                                    </button>
                                                    <button type="button" className="btn btn-danger m-1"
                                                            style={{height: 'min-content'}} data-index={question.id}
                                                            onClick={(e) => onRemoveSavedQuestionClick(e)}>
                                                        <i className="fa-solid fa-trash"
                                                           style={{display: 'inline', marginRight: '.3rem'}}></i>
                                                        <p style={{display: 'inline'}}>Delete</p>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    ))
                                    :
                                    <h5 className="text-center">No questions Added! Press the plus button to add a new
                                        question</h5>
                            }
                            <div className="row">
                                {
                                    questionComponents.map((questionComponent) => {
                                        return <AddQuestion questionId={questionComponent.id}
                                                            key={questionComponent.id}
                                                            onAddQuestionClick={onAddQuestionClick}
                                                            onRemoveQuestionComponentClick={onRemoveQuestionComponentClick}
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