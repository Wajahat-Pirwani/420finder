<template>
    <div class="retailer-review-dialog">
        <div class="backdrop" @click="hideModal"></div>
        <div class="review-modal-content">
            <div class="close-btn">
                <span class="close-btn-icon" @click="hideModal" style="cursor: pointer">
                    <svg width="15px" height="20px" viewBox="0 0 14 14" data-testid="close-modal"><g fill="#999999" stroke="none" transform="translate(-821.000000, -525.000000)"><g transform="translate(515.000000, 509.000000)"><polygon points="320 17.41 318.59 16 313 21.59 307.41 16 306 17.41 311.59 23 306 28.59 307.41 30 313 24.41 318.59 30 320 28.59 314.41 23"></polygon></g></g></svg>
                </span>
            </div>

            <div class="review-modal-content-body">
                <h3>Please log in to review</h3>
                <div class="review-modal-content-action">
                    <button @click="hideModal">
                        Cancel
                    </button>
                    <a href="/signin">
                        Login
                    </a>
                </div>
            </div>

        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {

        }
    },
    methods: {
        hideModal() {
            this.$emit('hide-modal', true);
        }
    }
}
</script>
