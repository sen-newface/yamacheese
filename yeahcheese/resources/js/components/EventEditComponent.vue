<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div>
                    <label>イベント名</label><br>
                    <input type="text" name="name" :value="name"/>
                </div>
                <div>
                    <label>公開開始日</label><br>
                    <input type="date" name="start_at" :value="start_at"/>
                </div>
                <div>
                    <label>公開終了日</label><br>
                    <input type="date" name="end_at" :value="end_at"/>
                </div>
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
            name: {
                type: String,
                required: true
            },
            start_at: {
                type: String,
                required: true
            },
            end_at: {
                type: String,
                required: true
            },
            id: {
                type: String
            }
        },
        methods: {
            updateEvent() {
                let data = new FormData();
                data.append("name", this.name);
                data.append("start_at", this.start_at);
                data.append("end_at", this.end_at);
                data.append("id", this.id);
    
                axios
                    .put("/api/events/"+this.id, data)
                    .then(response => {
                        this.name = "";
                        this.start_at = "";
                        this.end_at = "";
                    })
                    .catch(err => {
                        this.message = err.response.data.errors;
                    });
            }
        }
    }
</script>
