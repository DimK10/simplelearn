import React from 'react';
import PropTypes from "prop-types";

const LessonCard = ({lessons}) => {

  return (
    <>
      <div className="container">
        <div className="row">
          {
            lessons !== null
            &&
            lessons.length !== 0
            &&
            lessons.map(lesson => (

              <div className="col-sm-12 col-md-6 col-lg-4 col-xl-3 mb-5" key={lesson.id}>
                <div className="card" style={{ height: '300px' }}>
                  <div className="text-center d-flex" style={{height: '7rem'}}>
                    <i className="fa-solid fa-book-open m-auto"
                       style={{fontSize: '5em'}}></i>
                  </div>
                  <div className="card-body text-center d-flex flex-column justify-content-around">
                    <h5 className="card-title">{lesson.name}</h5>
                    <p className="card-text">Show info for {lesson.name} lesson</p>
                    <button type="button" className="btn btn-primary">Check Lesson</button>
                  </div>
                </div>
              </div>
            ))
          }
        </div>
      </div>
    </>
  )
}

LessonCard.propTypes = {
  lessons: PropTypes.array
};

export default LessonCard;