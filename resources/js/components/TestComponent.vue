<template>
    <div>
        <button :type="type" value="testing" class="my-test-button" v-text="content">Example Content</button>
        received from api:
        <p v-text="testData.test"></p>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Test Again Component mounted.')
            axios.get('api/test-vue', {})
                .then(response => {
                    this.testData = response.data;
                });
        },
        data: function() {
            return {
                testData: null
            }
        },
        props: [
            "content",
            "type"
        ]
    }
</script>

<style>
    .my-test-button {
        background-color: #333;
        color:#fff;
        padding: 10px 20px;
        font-weight: bold;
    }
</style>