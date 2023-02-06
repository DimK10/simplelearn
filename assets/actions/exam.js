import setAuthToken from "../utils/setAuthToken";
import examSlice from "../reducers/exam";
import axios from "axios";


const {
    prepareNewExam,
    examGetQuestions,
    examError
} = examSlice.actions;

export const prepareNewExamAction = (payload) => async dispatch => {
    dispatch(prepareNewExam(payload));
}

export const generateQuestions = (lessonId) => async dispatch => {
    if (localStorage.jwt)
        setAuthToken(localStorage.jwt);

    const config = {
        headers: {
            'Content-Type': 'application/json',
        },
    };

    try {
        const res = await axios.get(`/lesson/question/generate/${lessonId}`, config);

        dispatch(examGetQuestions(res.data));

    }catch (err){
        dispatch(examError(err.response.data.errorMessage))
    }
}