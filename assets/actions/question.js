import setAuthToken from "../utils/setAuthToken";
import axios from "axios";
import questionSlice from "../reducers/question";
import alertSlice from "../reducers/alert";


const {
    saveAllQuestions,
    questionError
} = questionSlice.actions;

const {
    setAlert
} = alertSlice.actions;


export const saveAllQuestionsAction = (lesson, questions) => async (dispatch) => {

    if (localStorage.jwt) {
        setAuthToken(localStorage.jwt);
    }

    const config = {
        headers: {
            'Content-Type': 'application/json',
        },
    };

    const body = JSON.stringify({questions});


    try {

        const res = await axios.post(`/api/lesson/questions/save/${lesson.id}`, body, config);


        dispatch(saveAllQuestions(res.data));
        dispatch(setAlert(`The questions for the ${lesson.name} lesson have been saved successfully!`));


    } catch (err) {
        dispatch(questionError(err.response.data.errorMessage));
        dispatch(setAlert("Something wrong happened"));
    }
}