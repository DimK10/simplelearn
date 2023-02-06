import setAuthToken from "../utils/setAuthToken";
import axios from "axios";
import {setAlertAction} from "./alert";
import lessonSlice from "../reducers/lesson";


const {
    saveAnswerInLesson,
    editAnswerInLesson,
    removeAnswerInLesson,
    changeStatusOfAnswer,
    lessonError
} = lessonSlice.actions

export const saveAnswerAction = (questionId, answer) => async (dispatch) => {
    if (localStorage.jwt) {
        setAuthToken(localStorage.jwt);
    }

    const headers = {
        'Content-Type': 'application/json',
    };


    answer = {...answer, id: null};

    const body = JSON.stringify({...answer, status: 'show'});

    try {

        const res = await axios.post(`/api/answer/save/${questionId}`, body, {
            headers: headers
        });

        answer = {...answer, ...res.data};

        await dispatch(saveAnswerInLesson({ questionId, answer}));

        dispatch(setAlertAction("The answer was saved successfully!", "success", 3000));

    } catch (err) {
        console.log(err)
        dispatch(lessonError(err.response.data.errorMessage));
        dispatch(setAlertAction("Something wrong happened"));
    }
}

export const editAnswerAction = (questionId, answer) => async (dispatch) => {
    if (localStorage.jwt) {
        setAuthToken(localStorage.jwt);
    }

    const headers = {
        'Content-Type': 'application/json',
    };

    const body = JSON.stringify({...answer, status: 'show'});

    try {

        const res = await axios.put(`/api/answer/edit/${questionId}`, body, {
            headers: headers
        });


        await dispatch(editAnswerInLesson({questionId, answer: res.data}));

        dispatch(setAlertAction("The answer was updated successfully!", "success", 3000));
    } catch (err) {
        dispatch(lessonError(err));
        dispatch(setAlertAction("Something wrong happened", "danger"));
    }
}

export const deleteAnswerAction = (questionId,answerId) => async (dispatch) => {

    if (localStorage.jwt) {
        setAuthToken(localStorage.jwt);
    }

    try {

        const res = await axios.delete(`/api/answer/delete/${answerId}`);

        await dispatch(removeAnswerInLesson({questionId, answerId}));

        dispatch(setAlertAction(res.data, "success", 3000));

    } catch (err) {
        console.log(err);
        dispatch(lessonError(err));
        dispatch(setAlertAction("Something wrong happened", 'danger'));
    }
}

export const changeStatusOfAnswerAction = (payload) => dispatch => {
    dispatch(changeStatusOfAnswer(payload));
}