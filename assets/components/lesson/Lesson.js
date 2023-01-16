import React from 'react';
import PropTypes from "prop-types";
import LessonForm from "./LessonForm";
import {useSelector} from "react-redux";
import HeaderNav from "../layout/HeaderNav";

const Lesson = () => {

  const { lesson } = useSelector(state => state.lesson);

  return (
      <>
        <HeaderNav/>
        <main style={{marginTop: '58px'}}>
          <div className="container pt-4">
            <section className="mb-4">
              <div className="card">
                <div className="card-header py-3">
                  <h5 className="mb-0 text-center mb-5"><strong>{lesson.name} Lesson</strong>
                  </h5>
                </div>
                <div className="card-body">
                  <LessonForm lesson={lesson}/>
                </div>
              </div>
            </section>
          </div>
        </main>
      </>
  )
};


export default Lesson;