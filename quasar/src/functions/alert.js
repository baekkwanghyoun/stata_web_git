// this.$alert('Pay is Successed');

import Swal from 'sweetalert2'

/**
 *success, error, warning, info, question
 * @param msg
 * @param success, error, warning, info, question
 */
const alert = function (msg, type='success') { // success, error, warning, info, question

  Swal.fire({
    title: type,
    text: msg,
    icon: type,
    confirmButtonText: 'OK'
  })
};

export default alert;
