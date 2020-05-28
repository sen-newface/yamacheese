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
                <p class="text-info" v-for="(message, index) in messages" :key="index">{{ message }}</p>
                <div>
                    <button @click="updateEvent">更新する</button>
                </div>
                <p><input ref="imageFile" type="file" accept="image/jpeg" required /></p>
                <div>
                    <button @click="uploadPhoto">アップロードする</button>
                </div>
                <li v-for="photo in photos" :key="photo.id">
                    <img style="max-width: 200px;" :src="'/storage/app/'+photo.path" />
                </li>
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
                messages: [],
                photos: [],
                view: true,
            };
        },
        mounted() {
            this.id = this.event.id;
            this.name = this.event.name;
            this.start_at = this.event.start_at;
            this.end_at = this.event.end_at
            this.getPhotos();
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
                        this.messages.splice(0);
                        this.messages.push('イベントが更新されました');
                    })
                    .catch(err => {
                        this.messages = _.flatten(_.values(err.response.data.errors));
                    });
            },
            uploadPhoto() {
                let params = new FormData();
                params.append('file', this.$refs.imageFile.files[0]);
                axios
                    .post("/api/events/"+this.id+"/edit", params)
                    .then(response => {
                        this.photos.push(response.data);
                        this.$refs.imageFile.value = '';
                        this.messages.splice(0);
                        this.messages.push('アップロードが成功しました');
                    })
                    .catch(err => {
                        this.messages = _.flatten(_.values(err.response.data.errors));
                    });
            },
            getPhotos() {
                axios
                    .get("/api/events/"+this.id+"/edit")
                    .then(response => {
                        this.photos = response.data;
                    })
            }
        }
    }
</script>
