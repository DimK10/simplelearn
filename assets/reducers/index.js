import {combineReducers} from "redux";
import alertSlice from './alert';
import authSlice from './auth';
import lessonSlice from "./lesson";
import questionSlice from "./question";
import examSlice from './exam';


const alert = alertSlice.reducer;
const auth = authSlice.reducer;
const lesson = lessonSlice.reducer;
const question = questionSlice.reducer;
const exam = examSlice.reducer;

export default combineReducers({
    alert,
    auth,
    lesson,
    exam
    // question
});