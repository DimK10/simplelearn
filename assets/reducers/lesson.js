import {createSlice} from "@reduxjs/toolkit";


const lessonSlice = createSlice({
    name: 'lesson',
    initialState: {
        loading: true,
        count: 0,
        lessons: [],
        lesson: {},
        error: ''
    },
    reducers: {
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