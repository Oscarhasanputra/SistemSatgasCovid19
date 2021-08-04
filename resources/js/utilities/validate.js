import Vue from "vue";

export const isValidated=()=>{
    const elements=$(".required")
    for(let i=0; i<elements.length;i++){
        const elem=elements[i]
        const value=elem.value;
        const message=$(elem).data("message");
        if(value==null || value==""){
            Vue.swal({
                title:"Form Kosong",
                text:message??`Field ${elem.name} tidak boleh kosong, Silahkan Isi Kembali`,
                icon:"error",

            })
            return false;
            
        }

    }
//    console.log()
    return true;
}