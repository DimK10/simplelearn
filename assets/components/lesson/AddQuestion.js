import React, {Fragment, useState} from 'react';
import PropTypes from "prop-types";

const AddQuestion = ({questionId, onAddQuestionClick, onRemoveQuestionComponentClick}) => {

    const [question, setQuestion] = useState({
        id: questionId,
        title: '',
        checked: false
    });

    const onChange = (e) =>
        setQuestion({...question, [e.target.name]: e.target.value});

    const onCheckboxChange = (e) =>
        setQuestion({...question, [e.target.name]: e.target.checked});

    return (
        <Fragment>
            <div className="card mb-4">
                <div className="card-body question-card-body">
                    <form>
                        <div className="row w-100">
                            <div className="col-sm-5 col-md-6">
                                <div className="form-outline">
                                    <input type="text" id="form5Example1" className="form-control" name="title"
                                           onChange={(e) => onChange(e)} required={true}/>
                                    <label className="form-label" htmlFor="form5Example1">Enter Your Answer</label>
                                </div>
                            </div>
                            <div className="col-sm-3 col-md-2 answer-checkbox">
                                <div className="form-check d-flex text-center">
                                    <input className="form-check-input me-2" type="checkbox" name="checked"
                                           id="form5Example3"
                                           defaultChecked={false} onChange={(e) => onCheckboxChange(e)}
                                    />
                                    <label className="form-check-label" htmlFor="form5Example3">
                                        Correct
                                    </label>
                                </div>
                            </div>
                            <div className="col-sm-2 col-md-2">
                                <button type="submit" className="btn btn-success w-100"
                                        onClick={(e) => onAddQuestionClick(e, questionId, question)}>
                                    <i className="fa-solid fa-check"></i>
                                </button>
                            </div>
                            <div className="col-sm-2 col-md-2">
                                <button type="button" className="btn btn-danger w-100"
                                        onClick={() => onRemoveQuestionComponentClick(questionId)}>
                                    <i className="fa-solid fa-x"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </Fragment>
    )
};

AddQuestion.proptypes = {
    questionId: PropTypes.string.isRequired,
    onAddQuestionClick: PropTypes.func.isRequired,
    onRemoveQuestionComponentClick: PropTypes.func.isRequired
}

export default AddQuestion;