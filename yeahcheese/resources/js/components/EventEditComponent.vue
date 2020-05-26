<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div>
                    <label>イベント名</label><br>
                    <input type="text" name="name" />
                </div>
                <div>
                    <label>公開開始日</label><br>
                    <input type="date" name="start_at"  />
                </div>
                <div>
                    <label>公開終了日</label><br>
                    <input type="date" name="end_at"  />
                </div>
                <div>
                    <input type="submit" value="更新する" />
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
