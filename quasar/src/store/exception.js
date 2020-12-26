import {Notify} from "quasar";
import alert from "src/functions/alert";

function exeption(e) {
  if(e.response.status===422) {
    const errors = e.response.data.errors;
    let errormsgs = '';
    for (const property in errors) {
      errormsgs += `${errors[property]}<br>`;
      //errormsgs += `${property}: ${errors[property]}<br>`;
    }
    Notify.create({message: errormsgs, type: 'negative', html: true})
  }
  else{ //(e.response.status===500. 422){
    //Notify.create({message: e.response.data.message, type: 'negative', html: true})
    Notify.create({message: e.message, type: 'negative', html: true})
  }
}

export default exeption;
