import {createSlice} from "@reduxjs/toolkit";
import {revertAll} from "../actions/global";

const initialState = {
    loading: true,
    count: 0,
    lessons: [],
    lesson: {},
    error: ''
};

const lessonSlice = createSlice({
    name: 'lesson',
    initialState,
    extraReducers: (builder) => builder.addCase(revertAll, () => initialState),
    reducers: {
        saveQuestionInLesson: (state, action) => {
            const {payload} = action;
            state.lesson.questions = [...state.lesson.questions, payload];
        },
        getAllLessons: (state, action) => {
            const {payload} = action;
            state.loading = false;
            state.lessons = payload;
            state.error = '';
        },
        getCountOfLessons: (state, action) => {
            const {payload} = action;
            state.count = payload;
            state.error = ''
        },
        lessonError: (state, action) => {
            const { payload } = action;
            state.error = payload;
            state.loading = false;
        },
        setViewableLesson: (state, action) => {
          const { payload } = action;
          state.lesson = payload;
        }
    }
})

export default lessonSlice;