const app = new Vue({
    el: '#app',

    data(){
        return{
            contact: {
                name: 'Gerardo Lucero',
                email: 'gera_conecta@hotmail.com',
                message: 'Hola Mundo',
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
                }
            }).catch(error => {
                console.log(error)
            })
        }
    }
})