import React, {Fragment} from 'react';

const AddQuestion = (props) => {
    return (
        <Fragment>
            <div className="card mb-4">
                <div className="card-body question-card-body">
                    <form>
                        <div className="row w-100">
                            <div className="col-sm-5 col-md-6">
                                <div className="form-outline">
                                    <input type="text" id="form5Example1" className="form-control"/>
                                    <label className="form-label" htmlFor="form5Example1">Enter Your Answer</label>
                                </div>
                            </div>
                            <div className="col-sm-3 col-md-2 answer-checkbox">
                                <div className="form-check d-flex text-center">
                                    <input className="form-check-input me-2" type="checkbox" value="" id="form5Example3"
                                           defaultChecked={true}/>
                                    <label className="form-check-label" htmlFor="form5Example3">
                                        Correct
                                    </label>
                                </div>
                            </div>
                            <div className="col-sm-2 col-md-2">
                                <button type="submit" className="btn btn-success w-100">
                                    <i className="fa-solid fa-check"></i>
                                </button>
                            </div>
                            <div className="col-sm-2 col-md-2">
                                <button type="submit" className="btn btn-danger w-100">
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

export default AddQuestion;