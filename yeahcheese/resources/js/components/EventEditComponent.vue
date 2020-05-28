<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div>
                    <label>イベント名</label><br>
                    <input type="text" name="name" v-model="name"/>
                </div>
                <div>
                    <label>公開開始日</label><br>
                    <input type="date" name="start_at" v-model="start_at"/>
                </div>
                <div>
                    <label>公開終了日</label><br>
                    <input type="date" name="end_at" v-model="end_at"/>
                </div>
                <p>{{ message }}</p>
                <div>
                    <button @click="updateEvent">更新する</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        },
        props: {
            event: {
                type: Object,
                required: true
            }
        },
        data() {
            return {
                id: 0,
                name: '',
                start_at: '',
                end_at: '',
                message: ''
            };
        },
        mounted() {
            this.id = this.event.id;
            this.name = this.event.name;
            this.start_at = this.event.start_at;
            this.end_at = this.event.end_at
        },
        methods: {
            updateEvent() {    
                axios
                    .put("/api/events/"+this.id, {
                        name: this.name,
                        start_at: this.start_at,
                        end_at: this.end_at
                    })
                    .then(response => {
                        this.name = response.data.name;
                        this.start_at = response.data.start_at;
                        this.end_at = response.data.end_at;
                    })
                    .catch(err => {
                        this.message = err.response.data.errors;
                    });
            }
        }
    }
</script>
