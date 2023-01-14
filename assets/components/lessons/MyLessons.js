import React, {useEffect, useState} from 'react';
import HeaderNav from "../layout/HeaderNav";
import {useDispatch, useSelector} from "react-redux";
import {getAllLessonsByPageForTutor} from "../../actions/lesson";
import LessonCard from "./LessonCard";

const MyLessons = () => {

  const dispatch = useDispatch();
  const {lessons} = useSelector(state => state.lesson);

  useEffect(() => {
    dispatch(getAllLessonsByPageForTutor(0, 10));
  }, [])

  return (
    <>
      <HeaderNav/>
      <main style={{marginTop: '58px'}}>
        <div className="container pt-4">
          <section className="mb-4">
            <div className="card">
              <div className="card-header py-3">
                <h5 className="mb-0 text-center mb-5"><strong>My Lessons Page</strong>
                </h5>
              </div>
              <div className="card-body">
                <LessonCard lessons={lessons}/>
                {/*<canvas className="my-4 w-100" id="myChart" height="380"></canvas>*/}
              </div>
            </div>
          </section>
        </div>
      </main>
    </>
  );
}

export default MyLessons;