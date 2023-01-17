import React, {useEffect, useState} from 'react';
import PropTypes from "prop-types";
import AddAnswer from "./AddAnswer";
import {v4 as uuidv4} from 'uuid';

const LessonForm = ({lesson}) => {

    const [questionComponents, setQuestionComponents] = useState([]);

    const [answerComponents, setAnswerComponents] = useState([]);

    const [difficultyComponent, setDifficultyComponent] = useState(false);

    const [formData, setFormData] = useState({
        questions: [],
        answers: []
    });

    const {
        questions,
        answers
    } = formData;

    useEffect(() => {
        console.log(formData);
    }, [formData]);

    const formIsInvalid = (form) => form.checkValidity() === false;

    const onPlusAnswerBtnClick = (e) => {
        e.preventDefault();

        let answerComponent = {
            id: uuidv4()
        }

        setAnswerComponents([...answerComponents, answerComponent])
    }

    const onPlusQuestionBtnClick = (e) => {
        e.preventDefault();

        let answerComponent = {
            id: uuidv4()
        }

        setAnswerComponents([...answerComponents, answerComponent])
    }

    const onAddAnswerClick = (e, answerId, answer) => {
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
            answers: [...answers, answer]
        });

        // remove from questions
        onRemoveAnswerComponentClick(answerId);
    }

    const removeSavedAnswer = (answerId) => {
        setFormData({...formData, answers: [...answers.filter((answer) => answer.id !== answerId)]});
    }

    const onRemoveAnswerComponentClick = (answerId) => {
        setAnswerComponents([...answerComponents.filter((answerComponent) => answerComponent.id !== answerId)]);
    }


    const onRemoveSavedAnswerClick = (e) => {
        const answerId = e.currentTarget.getAttribute('data-index');

        // TODO SEND TO API REMOVE ANSWER

        removeSavedAnswer(answerId);
    }

    const toggleDifficultyClick = () => {
        setDifficultyComponent(!difficultyComponent);
    }

    return (
        <>
            <div className="container pt-4">
                <section className="mb-4">
                    <div className="card mb-4">
                        <span className="border border-5 border-danger rounded" onClick={toggleDifficultyClick}></span>
                        <div className="card-header py-3">
                            <div className="row position-relative">
                                <h5 className="mb-0 text-center mb-5"><strong>Question #1</strong></h5>
                                <div className="position-absolute question-modify-buttons">
                                    <button type="button" className="btn btn-danger question-button float-end">
                                        <i className="fa-solid fa-trash"></i>
                                    </button>
                                    <button type="button" className="btn btn-warning question-button float-end">
                                        <i className="fa-solid fa-pen-to-square"></i>
                                    </button>

                                </div>

                            </div>
                            <div className="row">
                                <p className="lead text-center">
                                    What is the color of life?
                                </p>
                            </div>
                            {
                                /* difficulty radio */
                                difficultyComponent
                                &&
                                <div className="row text-center">
                                    <div className="col">
                                        <div className="custom-control custom-radio d-inline-block w-30">
                                            <input type="radio" className="custom-control-input"
                                                   id="defaultGroupExample1"
                                                   name="groupOfDefaultRadios"/>
                                            <label className="custom-control-label"
                                                   htmlFor="defaultGroupExample1">Easy</label>
                                        </div>
                                    </div>
                                    <div className="col">
                                        <div className="custom-control custom-radio d-inline-block">
                                            <input type="radio" className="custom-control-input"
                                                   id="defaultGroupExample2"
                                                   name="groupOfDefaultRadios" defaultChecked={true}/>
                                            <label className="custom-control-label"
                                                   htmlFor="defaultGroupExample2">Medium</label>
                                        </div>
                                    </div>
                                    <div className="col">
                                        <div className="custom-control custom-radio d-inline-block">
                                            <input type="radio" className="custom-control-input"
                                                   id="defaultGroupExample3"
                                                   name="groupOfDefaultRadios"/>
                                            <label className="custom-control-label"
                                                   htmlFor="defaultGroupExample3">Hard</label>
                                        </div>
                                    </div>


                                </div>
                            }


                        </div>
                        <div className="card-body">
                            {
                                answers !== null
                                &&
                                answers.length > 0
                                    ?
                                    answers.map(answer => (
                                        <div className="row mb-3" key={answer.id}>
                                            <div className={`card ${answer.checked && 'correct'}`}>
                                                <div
                                                    className="card-body d-flex justify-content-between align-items-center question-card-body">
                                                    <p className="card-text me-auto">{answers.indexOf(answer) + 1}) {answer.title}</p>
                                                    <button type="button" className="btn btn-warning m-1"
                                                            style={{height: 'min-content'}}
                                                    >
                                                        <i className="fa-solid fa-pen-to-square"
                                                           style={{display: 'inline', marginRight: '.3rem'}}></i>
                                                        <p style={{display: 'inline'}}>Edit</p>
                                                    </button>
                                                    <button type="button" className="btn btn-danger m-1"
                                                            style={{height: 'min-content'}} data-index={answer.id}
                                                            onClick={(e) => onRemoveSavedAnswerClick(e)}>
                                                        <i className="fa-solid fa-trash"
                                                           style={{display: 'inline', marginRight: '.3rem'}}></i>
                                                        <p style={{display: 'inline'}}>Delete</p>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    ))
                                    :
                                    <h5 className="text-center">No answers Added! Press the plus button to add a new
                                        question</h5>
                            }
                            <div className="row">
                                {
                                    answerComponents.map((answerComponent) => {
                                        return <AddAnswer answerId={answerComponent.id}
                                                          key={answerComponent.id}
                                                          onAddAnswerClick={onAddAnswerClick}
                                                          onRemoveAnswerComponentClick={onRemoveAnswerComponentClick}
                                        />
                                    })
                                }
                            </div>
                            <div className="row">
                                <button className="btn btn-primary" onClick={(e) => {
                                    onPlusAnswerBtnClick(e)
                                }}>
                                    <i className="fa-solid fa-plus"></i>
                                </button>
                            </div>
                        </div>

                    </div>
                    <div className="row">
                        <button className="btn btn-primary" onClick={(e) => {
                            onPlusAnswerBtnClick(e)
                        }}>
                            <i className="fa-solid fa-plus"></i>
                        </button>
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