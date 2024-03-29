import setAuthToken from "../utils/setAuthToken";
import axios from "axios";
import questionSlice from "../reducers/question";
import alertSlice from "../reducers/alert";
import question from "../reducers/question";
import lessonSlice from "../reducers/lesson";
import {setAlertAction} from "./alert";


const {
    saveQuestion,
    questionError
} = questionSlice.actions;

const {
    saveQuestionInLesson,
    editQuestionInLesson,
    removeQuestionInLesson,
    changeStatusOfQuestion
} = lessonSlice.actions;


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

        await dispatch(saveQuestionInLesson(question));

    } catch (err) {
        console.log(err)
        dispatch(questionError(err.response.data.errorMessage));
        dispatch(setAlertAction("Something wrong happened"));
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


        await dispatch(editQuestionInLesson(res.data));

        dispatch(setAlertAction("The question was updated successfully!", "success", 3000));
    } catch (err) {
        dispatch(questionError(err.response.data.errorMessage));
        dispatch(setAlertAction("Something wrong happened"));
    }
}

export const deleteQuestionAction = (questionId) => async (dispatch) => {

    if (localStorage.jwt) {
        setAuthToken(localStorage.jwt);
    }

    try {

        const res = await axios.delete(`/api/lesson/question/delete/${questionId}`);

        dispatch(removeQuestionInLesson(questionId));

        dispatch(setAlertAction(res.data, "success", 3000));

    } catch (err) {
        dispatch(questionError(err.response.data.errorMessage));
        dispatch(setAlertAction("Something wrong happened"));
    }
}

export const changeStatusOfQuestionAction = (payload) => dispatch => {
    dispatch(changeStatusOfQuestion(payload));
}