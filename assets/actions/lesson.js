import lessonSlice from "../reducers/lesson";
import setAuthToken from "../utils/setAuthToken";
import axios from "axios";
import question from "../reducers/question";


const {
  getCountOfLessons,
  saveQuestionInLesson,
  getAllLessons,
  lessonError,
  setViewableLesson,
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