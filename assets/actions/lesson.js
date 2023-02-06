import lessonSlice from "../reducers/lesson";
import setAuthToken from "../utils/setAuthToken";
import axios from "axios";
import question from "../reducers/question";


const {
    getCountOfLessons,
    saveQuestionInLesson,
    getAllLessons,
    getLesson,
    lessonError,
    setViewableLesson,
    startLoading,
} = lessonSlice.actions;


export const getAllLessonsByPageForTutor = (pageNo, pageSize) => async (dispatch) => {
    if (localStorage.jwt) {
        setAuthToken(localStorage.jwt);
    }

    try {
        ///lessons/tutor/{pageNo}/{numOfRecords}
        const res = await axios.get(`/api/lessons/tutor/${pageNo}/${pageSize}`);
        dispatch(getAllLessons(res.data))
    } catch (err) {
        dispatch(lessonError(err.response.data.errorMessage))
    }
}

export const getAllLessonsByPageForStudent = (pageNo, pageSize) => async (dispatch) => {
    if (localStorage.jwt) {
        setAuthToken(localStorage.jwt);
    }

    try {
        ///lessons/tutor/{pageNo}/{numOfRecords}
        const res = await axios.get(`/api/lessons/student/${pageNo}/${pageSize}`);
        dispatch(getAllLessons(res.data))
    } catch (err) {
        dispatch(lessonError(err.response.data.errorMessage))
    }
}

export const getLessonByName = (lessonName) => async (dispatch) => {
    if (localStorage.jwt) {
        setAuthToken(localStorage.jwt);
    }

    dispatch(startLoadingAction());

    try {
        const res = await axios.get(`/api/lesson/name/${lessonName}`);
        dispatch(getLesson(res.data))
    } catch (err) {
        dispatch(lessonError(err.response.data.errorMessage))
    }
}

export const getCountOfLessonsAction = (userId) => async (dispatch) => {
    if (localStorage.jwt) {
        setAuthToken(localStorage.jwt);
    }

    try {
        const res = await axios.get(`/api/lessons/count/${userId}`);
        dispatch(getAllLessons(res.data))
    } catch (err) {
        dispatch(lessonError(err.response.data.errorMessage))
    }
}

export const setViewableLessonAction = (lesson) => (dispatch) => {
    dispatch(setViewableLesson(lesson));
}

export const startLoadingAction = () => async dispatch => {
    dispatch(startLoading());
}