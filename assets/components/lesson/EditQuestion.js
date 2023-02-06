import React, {Fragment, useEffect, useState} from 'react';
import PropTypes from 'prop-types';
import validateForm from "../../utils/validateForm";

const EditQuestion = ({question, onAEditQuestionClick, onRemoveQuestionComponentClickOnEdit}) => {

    const [editingQuestion, setEditingQuestion] = useState({...question});

    const [invalidQuestionText, setInvalidQuestionText] = useState(false);

    const onChange = (e) =>
        setEditingQuestion({...editingQuestion, [e.target.name]: e.target.value});

    useEffect(() => {
        console.log(editingQuestion);
    },[question]);


    return (
        <Fragment>
            <div className="card mb-4" key={editingQuestion.id}>
                <form>
                    <div className="card-header py-3">
                        <div className="row position-relative">
                            <h5 className="mb-0 text-center mb-5"><strong>Question
                                #{editingQuestion.rowNum}</strong></h5>
                            <div className="position-absolute question-modify-buttons">
                                <button type="button"
                                        className="btn btn-danger question-button float-end"
                                        onClick={() => onRemoveQuestionComponentClickOnEdit(editingQuestion)}
                                >
                                    <i className="fa-solid fa-xmark"></i>
                                </button>
                                <button type="submit"
                                        className="btn btn-success question-button float-end"
                                        onClick={(e) => {
                                            const validationErrors = validateForm(e, editingQuestion.id, editingQuestion, onAEditQuestionClick);
                                            setInvalidQuestionText(validationErrors);
                                        }}
                                >
                                    <i className="fa-solid fa-check"></i>
                                </button>

                            </div>

                        </div>
                        <div className="row">
                            <div className="form-outline">
                                <input type="text" id="question-title"
                                       className="form-control" name="title"
                                       onChange={(e) => onChange(e)} required={true} value={editingQuestion.title}/>
                                <label className="form-label" htmlFor="question-title">Edit
                                    Your Question</label>
                                {
                                    invalidQuestionText &&
                                    <div className="text-danger">Please provide a
                                        valid
                                        question.</div>
                                }
                            </div>
                        </div>

                        <div className="row text-center">
                            <div className="col">
                                <div
                                    className="custom-control custom-radio d-inline-block w-30">
                                    <input type="radio" className="custom-control-input"
                                           id="difficulty"
                                           name="difficulty"
                                           onChange={(e) => onChange(e)}
                                           required={true} value="easy" checked={editingQuestion.difficulty === 'easy'}/>
                                    <label className="custom-control-label"
                                           htmlFor="defaultGroupExample1">Easy</label>
                                </div>
                            </div>
                            <div className="col">
                                <div
                                    className="custom-control custom-radio d-inline-block">
                                    <input type="radio" className="custom-control-input"
                                           id="difficulty"
                                           name="difficulty" onChange={(e) => onChange(e)}
                                           required={true}
                                           value="medium"
                                           checked={editingQuestion.difficulty === 'medium'}
                                    />
                                    <label className="custom-control-label"
                                           htmlFor="defaultGroupExample2">Medium</label>
                                </div>
                            </div>
                            <div className="col">
                                <div
                                    className="custom-control custom-radio d-inline-block">
                                    <input type="radio" className="custom-control-input"
                                           id="difficulty"
                                           name="difficulty" onChange={(e) => onChange(e)}
                                           required={true}
                                           value="hard"
                                           checked={editingQuestion.difficulty === 'hard'}
                                    />
                                    <label className="custom-control-label"
                                           htmlFor="defaultGroupExample3">Hard</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </Fragment>
    );
};

EditQuestion.propTypes = {
    question: PropTypes.object.isRequired,
    onAEditQuestionClick: PropTypes.func.isRequired,
    onRemoveQuestionComponentClickOnEdit: PropTypes.func.isRequired
};

export default EditQuestion;