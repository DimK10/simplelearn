import setAuthToken from "../utils/setAuthToken";
import axios from "axios";
import questionSlice from "../reducers/question";
import alertSlice from "../reducers/alert";
import question from "../reducers/question";


const {
    saveQuestion,
    questionError
} = questionSlice.actions;

const {
    setAlert
} = alertSlice.actions;


export const saveQuestionAction = (lesson, question) => async (dispatch) => {
    if (localStorage.jwt) {
        setAuthToken(localStorage.jwt);
    }

    const headers = {
        'Content-Type': 'application/json',
    };


    question.id = null;

    question.answers =
        [...question.answers.map(answer => {
            answer.id = null;
            return answer;
        })];


    const body = JSON.stringify({...question, status: 'show'});

    try {

        const res = await axios.post(`/api/lesson/question/save/${lesson.id}`, body, {
            headers: headers
        });

        question = {...question, ...res.data};

        await dispatch(saveQuestion(question));

    } catch (err) {
        dispatch(questionError(err.response.data.errorMessage));
        dispatch(setAlert("Something wrong happened"));
    }
}

export const editQuestionAction = (lesson, question) => async (dispatch) => {
    if (localStorage.jwt) {
        setAuthToken(localStorage.jwt);
    }

    const headers = {
        'Content-Type': 'application/json',
    };

    const body = JSON.stringify({...question, status: 'show'});

    try {

        const res = await axios.put(`/api/lesson/question/edit/${lesson.id}`, body, {
            headers: headers
        });

        question = {...question, ...res.data};

    } catch (err) {
        dispatch(questionError(err.response.data.errorMessage));
        dispatch(setAlert("Something wrong happened"));
    }
}

export const deleteQuestionAction = (questionId) => async (dispatch) => {

    if (localStorage.jwt) {
        setAuthToken(localStorage.jwt);
    }

    try {

        const res = await axios.delete(`/api/lesson/question/delete/${questionId}`);

        dispatch(setAlert(res.data));

    } catch (err) {
        dispatch(questionError(err.response.data.errorMessage));
        dispatch(setAlert("Something wrong happened"));
    }
}