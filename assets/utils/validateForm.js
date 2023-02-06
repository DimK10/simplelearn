/**
 * This utility method is used for pseudo validation of question and answer forms
 * @param e the onClick event
 * @param id questionId or answerId, for the relationship between questions and answers
 * @param object An object that is instanceof question or answer
 * @param callback the method that needs to be executed if no validation errors
 * @returns {boolean} Returns true, if there is a validation error
 */
const validateForm = (e, id, object, callback) => {
    e.preventDefault();
    // console.log(e)
    // const form = e.target.form;
    // console.log(form.checkValidity())

    // Check for basic form validity
    if (object.title === '') {
        return true;
    }

    callback(e, id, object);

    return false;
}

export default validateForm;