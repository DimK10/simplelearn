import React, {useEffect, useState} from 'react';
import PropTypes from "prop-types";
import AddAnswer from "./AddAnswer";
import {v4 as uuidv4} from 'uuid';
import AddQuestion from "./AddQuestion";
import EditQuestion from "./EditQuestion";

const LessonForm = ({lesson}) => {

    const [questionComponents, setQuestionComponents] = useState([]);

    const [answerComponents, setAnswerComponents] = useState([]);

    const [difficultyComponent, setDifficultyComponent] = useState(false);

    const [formData, setFormData] = useState({
        questions: localStorage.getItem("questions") !== null ? JSON.parse(localStorage.getItem("questions")) : [],
    });

    let {
        questions,
    } = formData;

    useEffect(() => {
        console.log(formData);
        localStorage.setItem("questions", JSON.stringify(questions));
    }, [formData]);


    /* Plus button operations */
    const onPlusAnswerBtnClick = (e, questionId) => {
        e.preventDefault();

        let answerComponent = {
            id: uuidv4(),
            questionId,
            status: 'add'
        }

        setAnswerComponents([...answerComponents, answerComponent]);
    }

    const onPlusQuestionBtnClick = (e) => {
        e.preventDefault();

        let questionComponent = {
            id: uuidv4(),
            status: 'add'
        }

        setQuestionComponents([...questionComponents, questionComponent]);
    }

    /* Add operations */
    const onAddQuestionClick = (e, questionId, question) => {

        // TODO SEND TO API


        question = {...question, status: 'show'};

        // add to formData
        setFormData({
            ...formData,
            questions: [...questions, question]
        });

        // localStorage.setItem("questions", JSON.stringify(questions));

        // remove from questions
        onRemoveQuestionComponentClick(questionId);
    }

    const onAddAnswerClick = (e, answerId, answer) => {

        // TODO SEND TO API

        // add to formData

        let questions = formData.questions.map(question => (question.id === answer.questionId ? {
            ...question,
            answers: [...question.answers, answer]
        } : question));

        setFormData({
            ...formData,
            questions: [...questions]
        })

        // remove from questions
        onRemoveAnswerComponentClick(answerId);
    }

    /* Edit operations */

    /* Edit button in show status component */
    const onEditQuestionBtnClick = (e, question) => {
        e.preventDefault();

        let questionComponent = {
            id: question.id,
            status: 'edit'
        }

        // change question status to edit

        questions = questions.map(questionEl => questionEl.id === question.id ? {
            ...questionEl,
            status: 'edit'
        } : questionEl);

        setFormData({
            ...formData,
            questions: [...questions]
        })

        setQuestionComponents([...questionComponents, questionComponent]);
    }

    const onAEditQuestionClick = (e, questionId, question) => {

        // TODO SEND TO API


        questions = questions.map(questionEl => (questionEl.id === question.id ? {
            ...question,
            status: 'show'
        } : questionEl));

        // add to formData
        setFormData({
            ...formData,
            questions
        });

        // localStorage.setItem("questions", JSON.stringify(questions));

        // remove from questions
        onRemoveQuestionComponentClick(questionId);
    }

    /* Remove operations */
    const removeSavedQuestion = (questionId) => {
        setFormData({
            ...formData,
            questions: [...questions.filter((question) => question.id !== questionId)]
        });
    }

    const removeSavedAnswer = (answerId, questionId) => {


        let questions = formData.questions.map(
            question => (
                question.id === questionId
                    ?
                    {
                        ...question,
                        answers: [...question.answers.filter(answer => answer.questionId !== questionId || answer.id !== answerId)]
                    }
                    :
                    question
            ));

        setFormData({
            ...formData,
            questions: [...questions]
        });

        // localStorage.setItem("questions", JSON.stringify(questions));
    }

    const onRemoveQuestionComponentClick = (questionId) => {
        setQuestionComponents([...questionComponents.filter((questionComponent) => questionComponent.id !== questionId)]);
    }

    const onRemoveQuestionComponentClickOnEdit = (question) => {

        questions = questions.map(questionEl => questionEl.id === question.id ? {
            ...questionEl,
            status: 'show'
        } : questionEl);

        setFormData({
            ...formData,
            questions: [...questions]
        })

        setQuestionComponents([...questionComponents.filter((questionComponent) => questionComponent.id !== question.id)]);
    }

    const onRemoveAnswerComponentClick = (answerId) => {
        setAnswerComponents([...answerComponents.filter((answerComponent) => answerComponent.id !== answerId)]);
    }


    const onRemoveSavedAQuestionClick = (e) => {
        const questionId = e.currentTarget.getAttribute('data-index');

        // TODO SEND TO API REMOVE QUESTION

        removeSavedQuestion(questionId);
    }

    const onRemoveSavedAnswerClick = (e, questionId) => {
        const answerId = e.currentTarget.getAttribute('data-index');

        // TODO SEND TO API REMOVE ANSWER

        removeSavedAnswer(answerId, questionId);
    }

    const toggleDifficultyClick = () => {
        setDifficultyComponent(!difficultyComponent);
    }


    return (
        <>
            <div className="container pt-4">
                <section className="mb-4">
                    {
                        /* show questions */
                        questions !== null
                        &&
                        questions.length > 0
                        &&
                        questions.map(question => (
                            question.status === 'show'
                            ?
                            <div className="card mb-4">
                                {
                                    question.difficulty === 'easy' &&
                                    <span key={question.id + 1}
                                          className="border border-5 border-success rounded"
                                          onClick={toggleDifficultyClick}></span>
                                }
                                {
                                    question.difficulty === 'medium' &&
                                    <span key={question.id + 1}
                                          className="border border-5 border-warning rounded"
                                          onClick={toggleDifficultyClick}></span>
                                }
                                {
                                    question.difficulty === 'hard' &&
                                    <span key={question.id + 1}
                                          className="border border-5 border-danger rounded"
                                          onClick={toggleDifficultyClick}></span>
                                }
                                <div className="card-header py-3">
                                    <div className="row position-relative">
                                        <h5 className="mb-0 text-center mb-5"><strong>Question
                                            #{questions.indexOf(question) + 1}</strong>
                                        </h5>
                                        <div
                                            className="position-absolute question-modify-buttons">
                                            <button type="button"
                                                    className="btn btn-danger question-button float-end"
                                                    data-index={question.id}
                                                    onClick={(e) => onRemoveSavedAQuestionClick(e)}>
                                                <i className="fa-solid fa-trash"></i>
                                            </button>
                                            <button type="button"
                                                    className="btn btn-warning question-button float-end"
                                                    onClick={(e) => onEditQuestionBtnClick(e, question)}>
                                                <i className="fa-solid fa-pen-to-square"></i>
                                            </button>

                                        </div>

                                    </div>
                                    <div className="row">
                                        <p className="lead text-center">
                                            {question.title}
                                        </p>
                                    </div>
                                    {
                                        /* difficulty radio */
                                        difficultyComponent
                                        &&
                                        <div className="row text-center">
                                            <div className="col">
                                                <div
                                                    className="custom-control custom-radio d-inline-block w-30">
                                                    <input type="radio"
                                                           className="custom-control-input"
                                                           id="defaultGroupExample1"
                                                           name="groupOfDefaultRadios"/>
                                                    <label
                                                        className="custom-control-label"
                                                        htmlFor="defaultGroupExample1">Easy</label>
                                                </div>
                                            </div>
                                            <div className="col">
                                                <div
                                                    className="custom-control custom-radio d-inline-block">
                                                    <input type="radio"
                                                           className="custom-control-input"
                                                           id="defaultGroupExample2"
                                                           name="groupOfDefaultRadios"
                                                           defaultChecked={true}/>
                                                    <label
                                                        className="custom-control-label"
                                                        htmlFor="defaultGroupExample2">Medium</label>
                                                </div>
                                            </div>
                                            <div className="col">
                                                <div
                                                    className="custom-control custom-radio d-inline-block">
                                                    <input type="radio"
                                                           className="custom-control-input"
                                                           id="defaultGroupExample3"
                                                           name="groupOfDefaultRadios"/>
                                                    <label
                                                        className="custom-control-label"
                                                        htmlFor="defaultGroupExample3">Hard</label>
                                                </div>
                                            </div>


                                        </div>
                                    }


                                </div>
                                <div className="card-body">
                                    {
                                        /* show answers of each question */
                                        question.answers !== null
                                        &&
                                        question.answers.length > 0
                                            ?
                                            question.answers.map(answer => (
                                                <div className="row mb-3" key={answer.id}>
                                                    <div
                                                        className={`card ${answer.checked && 'correct'}`}>
                                                        <div
                                                            className="card-body d-flex justify-content-between align-items-center question-card-body">
                                                            <p className="card-text me-auto">{question.answers.indexOf(answer) + 1}) {answer.title}</p>
                                                            <button type="button"
                                                                    className="btn btn-warning m-1"
                                                                    style={{height: 'min-content'}}
                                                            >
                                                                <i className="fa-solid fa-pen-to-square"
                                                                   style={{
                                                                       display: 'inline',
                                                                       marginRight: '.3rem'
                                                                   }}></i>
                                                                <p style={{display: 'inline'}}>Edit</p>
                                                            </button>
                                                            <button type="button"
                                                                    className="btn btn-danger m-1"
                                                                    style={{height: 'min-content'}}
                                                                    data-index={answer.id}
                                                                    onClick={(e) => onRemoveSavedAnswerClick(e, answer.questionId)}>
                                                                <i className="fa-solid fa-trash"
                                                                   style={{
                                                                       display: 'inline',
                                                                       marginRight: '.3rem'
                                                                   }}></i>
                                                                <p style={{display: 'inline'}}>Delete</p>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            ))
                                            :
                                            <h5 className="text-center">No answers Added!
                                                Press the plus button to add a
                                                new
                                                question</h5>
                                    }
                                    <div className="row">
                                        {
                                            /* show answers on create */
                                            answerComponents.map((answerComponent) => {
                                                return <AddAnswer
                                                    questionId={question.id}
                                                    answerId={answerComponent.id}
                                                    key={answerComponent.id}
                                                    onAddAnswerClick={onAddAnswerClick}
                                                    onRemoveAnswerComponentClick={onRemoveAnswerComponentClick}
                                                />
                                            })
                                        }
                                    </div>
                                    <div className="row">
                                        <button className="btn btn-primary"
                                                onClick={(e) => {
                                                    onPlusAnswerBtnClick(e, question.id)
                                                }}>
                                            <i className="fa-solid fa-plus"></i>
                                        </button>
                                    </div>
                                </div>

                            </div>
                                :
                            <EditQuestion onRemoveQuestionComponentClickOnEdit={onRemoveQuestionComponentClickOnEdit}
                                              onAEditQuestionClick={onAEditQuestionClick}
                                              question={questions.find(questionEl => questionEl.id === question.id)}/>
                        ))
                    }
                    {
                        questionComponents !== null
                        &&
                        questionComponents.length > 0
                        &&
                        questionComponents.map(questionComponent => (
                            /* check if add or edit mode */
                            questionComponent.status === 'add'
                            &&
                            <AddQuestion key={questionComponent.id}
                                         questionsLength={questions.length}
                                         questionId={questionComponent.id}
                                         onAddQuestionClick={onAddQuestionClick}
                                         onRemoveQuestionComponentClick={onRemoveQuestionComponentClick}
                            />


                        ))
                    }
                    <div className="row">
                        <button className="btn btn-primary" onClick={(e) => {
                            onPlusQuestionBtnClick(e)
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