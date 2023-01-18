import React, {Fragment, useState} from 'react';
import PropTypes from "prop-types";

const AddAnswer = ({answerId, onAddAnswerClick, onRemoveAnswerComponentClick}) => {

    const [answer, setAnswer] = useState({
        id: answerId,
        title: '',
        checked: false
    });

    const onChange = (e) =>
        setAnswer({...answer, [e.target.name]: e.target.value});

    const onCheckboxChange = (e) =>
        setAnswer({...answer, [e.target.name]: e.target.checked});

    const validateForm = (e, id, object, callback) => {
        const form = e.target.form;

        // Check for basic form validity
        if (form.checkValidity() === false) {
            form.reportValidity();
            return;
        }

        callback(e, id, object);
    }

    return (
        <Fragment>
            <div className="card mb-4">
                <div className="card-body answer-card-body">
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
                                        onClick={(e) => validateForm(e, answerId, answer, onAddAnswerClick)}>
                                    <i className="fa-solid fa-check"></i>
                                </button>
                            </div>
                            <div className="col-sm-2 col-md-2">
                                <button type="button" className="btn btn-danger w-100"
                                        onClick={() => onRemoveAnswerComponentClick(answerId)}>
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

AddAnswer.proptypes = {
    answerId: PropTypes.string.isRequired,
    onAddAnswerClick: PropTypes.func.isRequired,
    onRemoveAnswerComponentClick: PropTypes.func.isRequired
}

export default AddAnswer;