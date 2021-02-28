<template>
    <span>
        <span v-for="index in 5" class="fa-stack" style="width:1em">
            <i v-if="rating < 0.5" class="far fa-star-o fa-stack-1x"></i>
            <i v-if="rating >= 0.5 && index - 0.5 <= rating" class="fas fa-star-half fa-stack-1x"></i>
            <i v-if="rating >= index" class="fas fa-star fa-stack-1x"></i>
            <i v-else class="far fa-star fa-stack-1x"></i>
        </span>
    </span>
</template>

<script>
export default {
    name: "Rating",

    props: {
        rating: {
            type: Number,
            required: true
        }
    },
}
</script>

<style scoped>

</style>
