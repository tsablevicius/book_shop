<template>
    <div>

        <div v-if="!loading" class="md:mt-4 mt-6">
            <h2 class="text-2xl text-gray-900 font-medium title-font mb-2">Reviews</h2>
            <div v-for="review in reviews" :key="review.id" class="border-2 my-2">
                <div class="flex justify-between px-2 py-2">
                    <div class="text-base text-gray-900 font-medium title-font">
                        <span>{{ review.author_name }}</span>
                    </div>
                    <rating v-if="review.rating" :rating="review.rating"/>
                </div>

                <div class="px-2 py-2">
                    {{ review.comment }}
                </div>
            </div>
        </div>

        <div v-if="logged === 1" class="w-full md:mt-4 mt-6">
            <h2 class="text-lg text-gray-900 font-medium title-font mt-4">Add review</h2>

            <input id="rating" type="number"
                   class="mt-4 form-input w-full border border-gray-500 @error('rating') border-red-500 @enderror"
                   name="rating"
                   v-model="newRating"
                   min="1"
                   max="5"
                   placeholder="Rating">

            <label for="comment" class="mt-4 text-base">Comment</label>

            <textarea
                class="mt-1 w-full"
                v-model="comment"
                name="comment"
                id="comment"
                rows="10"/>


            <div class="flex justify-end">
                <button @click.prevent="submit"
                        class="mt-4 px-4 py-2 h-10 bg-gray-200 hover:bg-indigo-700 hover:text-white border border-indigo-700 text-indigo-700 uppercase">
                    <span>Submit</span>
                </button>
            </div>
        </div>
    </div>
</template>

<script>
import Rating from "./Rating";

export default {
    name: "Review",
    components: {Rating},
    props: {
        id: {
            type: Number,
            required: true,
        },
        logged: {
            type: Number,
            required: true,
        }
    },

    data() {
        return {
            loading: false,
            comment: null,
            newRating: null,
            reviews: [],
            errors: [],
        };
    },

    mounted() {
        this.fetchReviews();
        console.log('isLogged: ', this.logged);
    },

    methods: {
        fetchReviews() {
            this.loadind = true;
            axios.get(`/api/v1/books/${this.id}/reviews`)
                .then((res) => {
                    this.reviews = res.data.data.reviews
                    this.loading = false;
                }).catch((err) => {
                   this.errors = err.data;
            });
        },

        submit() {
            axios.post(`/api/v1/books/reviews/create`, {
                book_id: this.id,
                rating: this.newRating,
                comment: this.comment
            }).then(() => {
                this.comment = null;
                this.newRating = null;
                this.fetchReviews();
            }).catch((err) => {
                this.errors = err.data;
            })
        }
    }
}
</script>
