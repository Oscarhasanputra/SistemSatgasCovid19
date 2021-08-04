import axios from "axios"
import Vue from "vue"
class Request { 
    static messageHandling(response,error){
        return new Promise((res,rej)=>{
            Vue.swal({
                icon:error?"error":"success",
                title:error?"Oops...":"Berhasil",
                text:response.message,
                showCloseButton: false,
                showCancelButton: false,
                showConfirmButton:false,
                timer:1000
            }).then(()=>{
                res()
            })
        })
       
    }

    static get(url,data={}){
        return new Promise((res,rej)=>{
            
            axios.get(url,{params:data}).then(response=>{
                if(response.data.message)
                    this.messageHandling(response.data,false).then(()=>{
                        res(response)
                    })
                else
                res(response)
            }).catch(error=>{
                if(error.response.data && error.response.data.message)
                this.messageHandling(error.response.data,true).then(()=>{

                    rej(error)
                })
                else rej(error)
            })
        })
    }
    static post(url,data={}){
        return new Promise((res,rej)=>{
            axios.post(url,data,{headers:{ 'Content-Type': 'multipart/form-data'}}).then(response=>{
                if(response.data.message)
                this.messageHandling(response.data,false).then(()=>{
                    res(response)
                })
                else
                res(response)
            }).catch(error=>{

                if(error.response.data && error.response.data.message)
                this.messageHandling(error.response.data,true).then(()=>{

                    rej(error)
                })
                else rej(error)
            })
        })
    }
    static put(url,id,data={}){
        return new Promise((res,rej)=>{
            axios.put(`${url}/${id}`,data).then(response=>{
                if(response.data.message)
                this.messageHandling(response.data,false).then(()=>{
                    res(response)
                })
                else
                res(response)
            }).catch(error=>{
                if(error.response.data && error.response.data.message)
                this.messageHandling(error.response.data,true).then(()=>{

                    rej(error)
                })
                else rej(error)
            })
        })
    }
    static delete(url,id,data={}){
        return new Promise((res,rej)=>{
            axios.delete(`${url}/${id}`,{data:data}).then(response=>{
                if(response.data.message)
                this.messageHandling(response.data,false).then(()=>{
                    res(response)
                })
                else
                res(response)
            }).catch(error=>{
                if(error.response.data && error.response.data.message)
                this.messageHandling(error.response.data,true).then(()=>{

                    rej(error)
                })
                else rej(error)
            })
        })
    }
}
export default Request