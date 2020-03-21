<template>
    <div>
        <!--<textarea class="form-control"  rows="20" readonly="">{{messages.join('\n')}}</textarea>-->
        <ul class="list-group">
            <li v-for="{name, content} in messages">{{ name }}:{{ content }}</li>
        </ul>

        <hr>
        <input v-model="text">
        <button @click="postMessage" :disabled="!contentExists">submit</button>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                text: '',
                roomId: '',
                messages: []
            }
        },
        computed: {
            contentExists() {
                return this.text.length > 0;
            }
        },
        methods: {
            postMessage() {
                axios.post('/post', {message: this.text}).then(({data}) => {
                    //this.messages.push(data);
                    this.text = '';
                });
            }
        },
        created() {
            var roomId = 1;
            axios.get('/getAll?roomId='+roomId).then(({data}) => {
                this.messages = data;
            });

            /*Echo.private(`chat.${roomId}`)
                .listen('MessageSent', (e) => {
                    console.log('event recive');
                    this.messages.push(e.message);
                    console.log(e.message);
                });*/
            Echo.join('chat.${roomId}')
                .here((users) => {
                        console.log(users);
                    })
                
        },
        mounted() {
            var roomId = 1;
            Echo.join(`chat.${roomId}`).listen('.message.sent', (e) => {
                        console.log("event recive");
                        console.log(e);
                        this.messages.push(e.message);
                    });
            }
    }
</script>