<script>
import replies from "../replies.vue";
import SubscriptionButton from "../SubscriptionButton.vue";
export default {
    props: ['initialRepliesCount'],

    components: {replies, SubscriptionButton},

    data() {
        return {
            repliesCount: this.initialRepliesCount
        }
    }
}
</script>
