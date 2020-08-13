const app = new Vue({
    el: '#app',

    data(){
        return{
            contact: {
                name: '',
                email: '',
                message: '',
                optionSelect: 'Corea',
            },
            countries: ['Mexico', 'EU', 'Corea', 'China', 'Japon', 'Taiwan'],
            send: false,
        }
    },

    methods: {
        sendForm(){
            let URL = '../Controller.php'
            
            axios.post(URL, this.contact).then(response => {
                if (response.status == 200) {
                    this.send = true
                    this.contact = {
                        name: '',
                        email: '',
                        message: '',
                        optionSelect: 'Corea',
                    }
                }
            }).catch(error => {
                console.log(error)
            })
        }
    }
})