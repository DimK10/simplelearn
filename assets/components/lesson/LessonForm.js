import React from 'react';
import PropTypes from "prop-types";

const LessonForm = ({ lesson }) => {
  return (
      <>
      Lesson form
      </>
  )
};

LessonForm.prototypes = {
  lesson: PropTypes.object.isRequired
}

export default LessonForm;