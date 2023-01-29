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
        questionError: (state, action) => {
            const { payload } = action;
            state.error = payload;
            state.hasError = true;
            state.loading = false;
        },
    }
})

export default questionSlice;