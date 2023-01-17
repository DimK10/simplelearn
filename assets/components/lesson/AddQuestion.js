import React, {Fragment, useState} from 'react';
import AddAnswer from "./AddAnswer";
import PropTypes from "prop-types";

const AddQuestion = ({questionId, questionsLength, onAddQuestionClick, onRemoveQuestionComponentClick}) => {

    const [question, setQuestion] = useState({
        id: questionId,
        title: '',
        difficulty: 'easy'
    });

    const onChange = (e) =>
        setQuestion({...question, [e.target.name]: e.target.value});

    return (
        <Fragment>
            <div className="card mb-4">
                <div className="card-header py-3">
                    <div className="row position-relative">
                        <h5 className="mb-0 text-center mb-5"><strong>Question #{questionsLength}</strong></h5>
                        <div className="position-absolute question-modify-buttons">
                            <button type="button" className="btn btn-danger question-button float-end"
                                    onClick={() => onRemoveQuestionComponentClick(questionId)}
                            >
                                <i className="fa-solid fa-trash"></i>
                            </button>
                            <button type="button" className="btn btn-success question-button float-end"
                                    onClick={(e) => onAddQuestionClick(e, questionId, question)}
                            >
                                <i className="fa-solid fa-check"></i>
                            </button>

                        </div>

                    </div>
                    <div className="row">
                        <div className="form-outline">
                            <input type="text" id="question-title" className="form-control" name="title"
                                   onChange={(e) => onChange(e)} required={true}/>
                            <label className="form-label" htmlFor="question-title">Enter Your Question</label>
                        </div>
                    </div>

                    <div className="row text-center">
                        <div className="col">
                            <div className="custom-control custom-radio d-inline-block w-30">
                                <input type="radio" className="custom-control-input"
                                       id="difficulty"
                                       name="difficulty" defaultChecked={true} onChange={(e) => onChange(e)}
                                       required={true} value="easy"/>
                                <label className="custom-control-label"
                                       htmlFor="defaultGroupExample1">Easy</label>
                            </div>
                        </div>
                        <div className="col">
                            <div className="custom-control custom-radio d-inline-block">
                                <input type="radio" className="custom-control-input"
                                       id="difficulty"
                                       name="difficulty" onChange={(e) => onChange(e)} required={true} value="medium"/>
                                <label className="custom-control-label"
                                       htmlFor="defaultGroupExample2">Medium</label>
                            </div>
                        </div>
                        <div className="col">
                            <div className="custom-control custom-radio d-inline-block">
                                <input type="radio" className="custom-control-input"
                                       id="difficulty"
                                       name="difficulty" onChange={(e) => onChange(e)} required={true} value="hard"/>
                                <label className="custom-control-label"
                                       htmlFor="defaultGroupExample3">Hard</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </Fragment>
    )
};

AddQuestion.propTypes = {
    questionId: PropTypes.string.isRequired,
    questionsLength: PropTypes.number.isRequired,
    onAddQuestionClick: PropTypes.func.isRequired,
    onRemoveQuestionComponentClick: PropTypes.func.isRequired
}

export default AddQuestion;