import {combineReducers} from "redux";
import alertSlice from './alert';
import authSlice from './auth';
import lessonSlice from "./lesson";



const alert = alertSlice.reducer;
const auth = authSlice.reducer;
const lesson = lessonSlice.reducer;

export default combineReducers({
  alert,
  auth,
  lesson
});