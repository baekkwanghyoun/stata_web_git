import  numeral from 'numeral'

const cur = function (val) {
  return numeral(val).format('$0,0.00');

};
export default cur;
