import React, {Fragment, useState} from 'react';
import PropTypes from 'prop-types';
import validateForm from "../../utils/validateForm";

const EditAnswer = ({answer, questionId, onAEditAnswerClick, onRemoveAnswerComponentClickOnEdit}) => {

    const [editingAnswer, setEditingAnswer] = useState({...answer});

    const [invalidAnswerText, setInvalidAnswerText] = useState(false);

    const onChange = (e) =>
        setEditingAnswer({...editingAnswer, [e.target.name]: e.target.value});

    const onCheckboxChange = (e) =>
        setEditingAnswer({...editingAnswer, [e.target.name]: e.target.checked});

    return (
        <Fragment>
            <div className="card mb-4" key={editingAnswer.id}>
                <div className="card-body answer-card-body">
                    <form>
                        <div className="row w-100">
                            <div className="col-sm-5 col-md-6">
                                <div className="form-outline">
                                    <input type="text" id="form5Example1" className="form-control" name="text"
                                           onChange={(e) => onChange(e)}
                                           required={true}
                                           value={editingAnswer.text}
                                    />
                                    <label className="form-label" htmlFor="form5Example1">Enter Your Answer</label>
                                    {
                                        invalidAnswerText &&
                                        <div className="text-danger">Please provide a
                                            valid
                                            answer.</div>
                                    }
                                </div>
                            </div>
                            <div className="col-sm-3 col-md-2 answer-checkbox">
                                <div className="form-check d-flex text-center">
                                    <input className="form-check-input me-2" type="checkbox" name="correct"
                                           id="form5Example3"
                                           checked={editingAnswer.correct}
                                           onChange={(e) => onCheckboxChange(e)}
                                    />
                                    <label className="form-check-label" htmlFor="form5Example3">
                                        Correct
                                    </label>
                                </div>
                            </div>
                            <div className="col-sm-2 col-md-2">
                                <button type="submit" className="btn btn-success w-100"
                                        onClick={(e) => {
                                            const validationErrors = validateForm(e, questionId, editingAnswer, onAEditAnswerClick);
                                            setInvalidAnswerText(validationErrors);
                                        }}>
                                    <i className="fa-solid fa-check"></i>
                                </button>
                            </div>
                            <div className="col-sm-2 col-md-2">
                                <button type="button" className="btn btn-danger w-100"
                                        onClick={() => onRemoveAnswerComponentClickOnEdit(editingAnswer)}>
                                    <i className="fa-solid fa-x"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </Fragment>
    );
};

EditAnswer.propTypes = {
    answer: PropTypes.object.isRequired,
    questionId: PropTypes.number.isRequired,
    onAEditAnswerClick: PropTypes.func.isRequired,
    onRemoveAnswerComponentClickOnEdit: PropTypes.func.isRequired
};

export default EditAnswer;