import {Notify} from "quasar";
import Swal from 'sweetalert2'
import alert from "src/functions/alert";

function exeption(e) {
    //debugger
    if(e.response.status===422) {
        const errors = e.response.data.errors;
        let errormsgs = '';
        for (const property in errors) {
            errormsgs += `${errors[property]}<br>`;
            //errormsgs += `${property}: ${errors[property]}<br>`;
        }
        //Notify.create({message: errormsgs, type: 'negative', html: true})
        Swal.fire({
            title: 'Error',
            html: errormsgs,
            icon: 'error',
            // confirmButtonText: '저장하기',
        })
    }
    else{ //(e.response.status===500. 422){
        //Notify.create({message: e.message, type: 'negative', html: true})

        Swal.fire({
            title: 'Error',
            text: e.message,
            icon: 'error',
            // confirmButtonText: '저장하기',
        })


    }
}

export default exeption;
