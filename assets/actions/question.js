import setAuthToken from "../utils/setAuthToken";
import axios from "axios";
import questionSlice from "../reducers/question";
import alertSlice from "../reducers/alert";
import question from "../reducers/question";


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

    const headers = {
            'Content-Type': 'application/json',
        };

    // Remove id's in questions and their answers
    questions = [...questions.map(question => {
        question.id = null;
        delete question.rowNum;

        question.answers =
            [...question.answers.map(answer => {
                answer.id = null;
                delete answer.rowNum;
                return answer;
            })]

        return question;
    })]

    const body = JSON.stringify({questions});
    console.log(body);


    try {

        const res = await axios.post(`/api/lesson/questions/save/${lesson.id}`, body, {
            headers: headers
        });


        dispatch(saveAllQuestions(res.data));
        dispatch(setAlert(`The questions for the ${lesson.name} lesson have been saved successfully!`));


    } catch (err) {
        dispatch(questionError(err.response.data.errorMessage));
        dispatch(setAlert("Something wrong happened"));
    }
}