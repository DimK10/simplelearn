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
        // question
        saveQuestionInLesson: (state, action) => {
            const {payload} = action;
            state.lesson.questions = [...state.lesson.questions, payload];
        },
        editQuestionInLesson: (state, action) => {
            const {payload} = action;
            state.lesson.questions = [
                ...state.lesson.questions
                    .map(questionEl => (questionEl.id === payload.id ? {
                        ...payload
                    } : questionEl))];
        },
        removeQuestionInLesson: (state, action) => {
            const {payload} = action;
            state.lesson.questions =
                [...state.lesson.questions.filter((question) => question.id !== payload)]
        },
        changeStatus: (state, action) => {
            const {payload} = action;

            const {
                id,
                status
            } = payload;

            // find question to change status
            state.lesson.questions = [
                ...state.lesson.questions
                    .map(questionEl => (questionEl.id === id ? {
                        ...questionEl,
                        status
                    } : questionEl))];
        },

        //answer
        saveAnswerInLesson: (state, action) => {
            const {payload} = action;

            const {
                questionId,
                answer
            } = payload;

            // find question
            let question = state.lesson.questions.find(el => el.id === questionId);

            // add answer to question
            question.answers = [...question.answers, answer];

            // change question in lesson
            state.lesson.questions = [
                ...state.lesson.questions
                    .map(questionEl => (questionEl.id === questionId ? {
                        ...question
                    } : questionEl))];
        },



        // lessons
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
            const {payload} = action;
            state.error = payload;
            state.loading = false;
        },
        setViewableLesson: (state, action) => {
            const {payload} = action;
            state.lesson = payload;
        }
    }
})

export default lessonSlice;