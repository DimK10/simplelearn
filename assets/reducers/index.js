import {combineReducers} from "redux";
import alertSlice from './alert';
import authSlice from './auth';



const alert = alertSlice.reducer;
const auth = authSlice.reducer;

export default combineReducers({
  alert,
  auth,
});