import {createSlice} from "@reduxjs/toolkit";

const questionSlice = createSlice({
    name: 'question',
    initialState: {
        loading: true,
        questions: [],
        error: ''
    },
    reducers: {
        saveAllQuestions: (state, action) => {
            const { payload } = action;
            state.loading = false;
            state.questions = payload;
            state.error = ''
        },
        questionError: (state, action) => {
            const { payload } = action;
            state.error = payload;
            state.loading = false;
        },
    }
})

export default questionSlice;