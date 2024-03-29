import React, {useEffect, useState} from 'react';
import PropTypes from "prop-types";
import AddAnswer from "./AddAnswer";
import {v4 as uuidv4} from 'uuid';
import AddQuestion from "./AddQuestion";
import EditQuestion from "./EditQuestion";
import EditAnswer from "./EditAnswer";
import {useDispatch, useSelector} from "react-redux";
import {
    changeStatusOfQuestionAction,
    deleteQuestionAction,
    editQuestionAction,
    saveQuestionAction
} from "../../actions/question";
import {
    changeStatusOfAnswerAction,
    deleteAnswerAction,
    editAnswerAction,
    saveAnswerAction
} from "../../actions/answer";

const LessonForm = () => {

    const dispatch = useDispatch();

    let {lesson} = useSelector(state => state.lesson);

    const [questionComponents, setQuestionComponents] = useState([]);

    const [answerComponents, setAnswerComponents] = useState([]);

    const [difficultyComponent, setDifficultyComponent] = useState(false);

    const {
        questions
    } = lesson;

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
    const onAddQuestionClick = async (e, questionId, question) => {

        await dispatch(saveQuestionAction(lesson, question));

        question = {...question, status: 'show'};

        // remove from questions
        await onRemoveQuestionComponentClick(questionId);
    }

    const onAddAnswerClick = async (e, questionId, answer) => {

        await dispatch(saveAnswerAction(questionId, answer))

        // add to formData
        answer = {...answer, status: 'show'};

        // remove from questions
        onRemoveAnswerComponentClick(answer.id);
    }

    /* Edit operations */

    /* Edit button for question in show status component */
    const onEditQuestionBtnClick = (e, question) => {
        e.preventDefault();

        let questionComponent = {
            id: question.id,
            status: 'edit'
        }

        dispatch(changeStatusOfQuestionAction(questionComponent));

        // change question status to edit


        setQuestionComponents([...questionComponents, questionComponent]);
    }

    const onAEditQuestionClick = async (e, questionId, question) => {


        await dispatch(editQuestionAction(lesson, question));

        // remove from questions
        onRemoveQuestionComponentClick(questionId);
    }

    const onEditAnswerBtnClick = async (e, questionId, answer) => {
        e.preventDefault();
        console.log(questionId)

        let answerComponent = {
            id: answer.id,
            questionId,
            status: 'edit'
        }

        dispatch(changeStatusOfAnswerAction(answerComponent));


        setAnswerComponents([...answerComponents, answerComponent]);
    }

    const onEditAnswerClick = async (e, questionId, answer) => {

        await dispatch(editAnswerAction(questionId, answer));

        // remove from questions
        onRemoveAnswerComponentClick(answer.id);
    }

    /* Remove operations */
    const onRemoveQuestionComponentClick = (questionId) => {
        setQuestionComponents([...questionComponents.filter((questionComponent) => questionComponent.id !== questionId)]);
    }

    const onRemoveQuestionComponentClickOnEdit = (question) => {
        setQuestionComponents([...questionComponents.filter((questionComponent) => questionComponent.id !== question.id)]);
    }

    const onRemoveAnswerComponentClick = (answerId) => {
        setAnswerComponents([...answerComponents.filter((answerComponent) => answerComponent.id !== answerId)]);
    }

    const onRemoveAnswerComponentClickOnEdit = (answer) => {
        setQuestionComponents([...questionComponents.filter((questionComponent) => questionComponent.id !== question.id)]);
    }


    const onRemoveSavedAQuestionClick = async (rowNum) => {

        const question = lesson.questions.find(el => el.rowNum === parseInt(rowNum));

        await dispatch(deleteQuestionAction(question.id));
    }

    const onRemoveSavedAnswerClick = async (questionId, rowNum) => {
        const question = lesson.questions.find(el => el.id === parseInt(questionId));

        const answer = question.answers.find(el => el.rowNum === parseInt(rowNum));

        await dispatch(deleteAnswerAction(questionId, answer.id));
    }

    /* fast radio buttons to change difficulty without full edit of question */
    const toggleDifficultyClick = () => {
        setDifficultyComponent(!difficultyComponent);
    }


    const changeDifficultyRadio = (e, question) => {
        const difficulty = e.target.value;
        //
        // questions = questions.map(questionEl => questionEl.id === question.id ? {
        //     ...questionEl,
        //     difficulty
        // } : questionEl);
        //
        // setFormData({
        //     ...formData,
        //     questions: [...questions]
        // })
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
                                <div className="card mb-4" key={uuidv4()}>
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
                                                        onClick={(e) => onRemoveSavedAQuestionClick(question.rowNum)}>
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
                                            <div className="row text-center"
                                                 key={uuidv4()}>
                                                <div className="col">
                                                    <div
                                                        className="custom-control custom-radio d-inline-block w-30">
                                                        <input type="radio"
                                                               className="custom-control-input"
                                                               id="defaultGroupExample1"
                                                               name="difficulty"
                                                               checked={question.difficulty === 'easy'}
                                                               value="easy"
                                                               onClick={(e) => changeDifficultyRadio(e, question)}
                                                        />
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
                                                               name="difficulty"
                                                               checked={question.difficulty === 'medium'}
                                                               value="medium"
                                                               onClick={(e) => changeDifficultyRadio(e, question)}
                                                        />
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
                                                               name="difficulty"
                                                               checked={question.difficulty === 'hard'}
                                                               value="hard"
                                                               onClick={(e) => changeDifficultyRadio(e, question)}
                                                        />
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
                                                    answer.status === 'show'
                                                        ?
                                                        <div className="row mb-3"
                                                             key={answer.id}>
                                                            <div
                                                                className={`card ${answer.correct && 'correct'}`}>
                                                                <div
                                                                    className="card-body d-flex justify-content-between align-items-center question-card-body">
                                                                    <p className="card-text me-auto">{question.answers.indexOf(answer) + 1}) {answer.text}</p>
                                                                    <button type="button"
                                                                            className="btn btn-warning m-1"
                                                                            style={{height: 'min-content'}}
                                                                            onClick={(e) => onEditAnswerBtnClick(e, question.id, answer)}
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
                                                                            onClick={(e) => onRemoveSavedAnswerClick(question.id, answer.rowNum)}>
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
                                                        :
                                                        <EditAnswer
                                                            onRemoveAnswerComponentClickOnEdit={onRemoveAnswerComponentClickOnEdit}
                                                            answer={answer}
                                                            questionId={question.id}
                                                            onAEditAnswerClick={onEditAnswerClick}
                                                        />
                                                ))
                                                :
                                                <h5 className="text-center">No answers
                                                    Added!
                                                    Press the plus button to add a
                                                    new
                                                    question</h5>
                                        }
                                        <div className="row">
                                            {
                                                /* show answers on create */
                                                answerComponents.map((answerComponent) => (
                                                    answerComponent.status === 'add'
                                                    &&
                                                    <AddAnswer
                                                        questionId={question.id}
                                                        answerId={answerComponent.id}
                                                        answersLength={question.answers.length}
                                                        key={answerComponent.id}
                                                        onAddAnswerClick={onAddAnswerClick}
                                                        onRemoveAnswerComponentClick={onRemoveAnswerComponentClick}
                                                    />
                                                ))
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
                                <EditQuestion
                                    onRemoveQuestionComponentClickOnEdit={onRemoveQuestionComponentClickOnEdit}
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
                                         lessonId={lesson.id}
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

export default LessonForm;