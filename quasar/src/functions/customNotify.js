import {Notify} from "quasar";

const msg = function (msg, type='positive') {
  Notify.create({
    message: msg,
    color: type,//negative, warning, info
    position:'top-right',
    progress: true,
    icon: 'announcement',
    classes: 'glossy'
  })
};


export default msg;
