import {createSlice} from "@reduxjs/toolkit";

const questionSlice = createSlice({
    name: 'question',
    initialState: {
        loading: true,
        questions: [],
        question: null,
        hasError: false,
        error: ''
    },
    reducers: {
        saveQuestion: (state, action) => {
            const { payload } = action;
            state.loading = false;
            state.question = payload;
            state.error = ''
            state.hasError = false;
        },
        saveAllQuestions: (state, action) => {
            const { payload } = action;
            state.loading = false;
            state.questions = payload;
            state.error = ''
            state.hasError = false;
        },
        questionError: (state, action) => {
            const { payload } = action;
            state.error = payload;
            state.hasError = true;
            state.loading = false;
        },
    }
})

export default questionSlice;