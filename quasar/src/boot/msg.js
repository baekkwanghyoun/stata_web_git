import  msg from '../functions/customNotify';

export default  ({ Vue }) => {
  Vue.prototype.$msg = msg;
};
