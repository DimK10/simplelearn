import {combineReducers} from "redux";
import alertSlice from './alert';
import authSlice from './auth';
import lessonSlice from "./lesson";
import questionSlice from "./question";



const alert = alertSlice.reducer;
const auth = authSlice.reducer;
const lesson = lessonSlice.reducer;
const question = questionSlice.reducer;

export default combineReducers({
  alert,
  auth,
  lesson,
  // question
});