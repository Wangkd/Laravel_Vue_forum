<template>
    <nav aria-label="Page navigation" v-if="showPaginator">
        <ul class="pagination">
            <li class="page-item" v-show="preUrl">
                <a class="page-link" href="#" aria-label="Previous" @click.prevent="page--">
                    <span aria-hidden="true">&laquo;Previous</span>
                    <span class="sr-only">Previous</span>
                </a>
            </li>

            <li class="page-item" v-show="nextUrl">
                <a class="page-link"  href="#" aria-label="Next" @click.prevent="page++">
                    <span aria-hidden="true">Next&raquo;</span>
                    <span class="sr-only">Next</span>
                </a>
            </li>
        </ul>
    </nav>
</template>

<script>
    export default {
        props: ['dataSet'],

        data() {
            return {
                page: 1,
                preUrl: null,
                nextUrl: null
            }
        },

        computed: {
            showPaginator() {
                return !! this.preUrl || !! this.nextUrl;
            }
        },

        watch: {
            dataSet() {
                this.page = this.dataSet.current_page;
                this.preUrl = this.dataSet.prev_page_url;
                this.nextUrl = this.dataSet.next_page_url;
            },
            page() {
                this.broadcast();
            }
        },

        methods: {
            broadcast() {
                this.$emit('updated', this.page);
            }
        }
    }
</script>
