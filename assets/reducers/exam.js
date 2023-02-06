import {createSlice} from "@reduxjs/toolkit";
import {revertAll} from "../actions/global";


const initialState = {
    exams: [],
    exam: {
        timeStarted: null,
        timeEnded: null,
        questionsSelected: [],
        student: null,
        answersGivenByStudent: []
    },
    error: ''
};

const examSlice = createSlice({
    name: 'exam',
    initialState,
    extraReducers: (builder) => builder.addCase(revertAll, () => initialState),
    reducers: {
        prepareNewExam: (state, action) => {
            const {payload} = action;

            // const {
            //     timeStarted,
            //     timeEnded,
            //     questionsSelected,
            //     student
            // } = payload;

            state.exam = false;
            // state.exam = {
            //     timeStarted,
            //     timeEnded,
            //     questionsSelected,
            //     student
            // }
            state.exam = {...payload}
            state.error = ''
        },
        examGetQuestions: (state, action) => {
            const {payload} = action;
            state.loading = false;
            state.questionsSelected = [...payload]
            state.error = ''
        },
        examError: (state, action) => {
            const {payload} = action;
            state.error = payload;
            state.loading = false;
        }
    }
})

export default examSlice;