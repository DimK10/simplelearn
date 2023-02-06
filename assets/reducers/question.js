import {createSlice} from "@reduxjs/toolkit";
import {revertAll} from "../actions/global";

const initialState = {
    loading: true,
    questions: [],
    question: null,
    hasError: false,
    error: ''
};

const questionSlice = createSlice({
    name: 'question',
    initialState,
    extraReducers: (builder) => builder.addCase(revertAll, () => initialState),
    reducers: {
        saveQuestion: (state, action) => {
          const { payload } = action;
          state.question = payload;
          state.loading = false;
          state.hasError = false;
          state.error = '';
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