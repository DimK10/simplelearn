import setAuthToken from "../utils/setAuthToken";
import axios from "axios";
import {setAlertAction} from "./alert";
import lessonSlice from "../reducers/lesson";


const {
    saveAnswerInLesson,
    lessonError
} = lessonSlice

export const saveAnswerAction = (question, answer) => async (dispatch) => {
    if (localStorage.jwt) {
        setAuthToken(localStorage.jwt);
    }

    const headers = {
        'Content-Type': 'application/json',
    };


    answer.id = null;

    const body = JSON.stringify({...answer, status: 'show'});

    try {

        const res = await axios.post(`/api/answer/save/${question.id}`, body, {
            headers: headers
        });

        answer = {...answer, ...res.data};

        await dispatch(saveAnswerInLesson({ questionId:question.id, answer}));

    } catch (err) {
        console.log(err)
        dispatch(lessonError(err.response.data.errorMessage));
        dispatch(setAlertAction("Something wrong happened"));
    }
}

export const editAnswerAction = (lesson, question) => async (dispatch) => {
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


        dispatch(editQuestionInLesson(res.data));

    } catch (err) {
        dispatch(questionError(err.response.data.errorMessage));
        dispatch(setAlertAction("Something wrong happened"));
    }
}

export const deleteAnswerAction = (questionId) => async (dispatch) => {

    if (localStorage.jwt) {
        setAuthToken(localStorage.jwt);
    }

    try {

        const res = await axios.delete(`/api/lesson/question/delete/${questionId}`);

        dispatch(removeQuestionInLesson(questionId));

        dispatch(setAlertAction(res.data));

    } catch (err) {
        dispatch(questionError(err.response.data.errorMessage));
        dispatch(setAlertAction("Something wrong happened"));
    }
}

export const changeStatusOfAnswer = (payload) => dispatch => {
    dispatch(changeStatus(payload));
}